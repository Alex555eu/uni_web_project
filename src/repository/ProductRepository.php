<?php

require_once __DIR__.'/Repository.php';

class ProductRepository extends Repository {

    public function getAllProducts() {
        $conn = $this->database->getConnection();

        $stmt = $conn->prepare(
            "SELECT p.id as product_id, 
                        p.name as product_name, 
                        p.description as product_description, 
                        p.price as product_price, 
                        p.image as product_image, 
                        pc.id as product_category_id, 
                        pc.name as product_category_name,
                        pc.description as product_category_description,
                        pi.id as product_inventory_id,
                        pi.quantity as product_inventory_quantity,
                        s.id as store_id,
                        s.postal_code as postal_code,
                        s.city,
                        s.address
                    FROM public.product as p
                        JOIN public.product_category_assignment as pca ON p.id = pca.product_id
                        JOIN public.product_category as pc ON pca.product_category_id = pc.id
                        JOIN public.product_inventory as pi ON p.inventory_id = pi.id
                        JOIN public.store as s ON pi.store_id = s.id
                    WHERE p.disabled = '0';"
        );
        $stmt->execute();

        $product = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll

        if($product == false) {
            return null;
        }

        $listOfProds = array();
        foreach ($product as $el) {
            $productCategory = new ProductCategory($el['product_category_id'], $el['product_category_name'], $el['product_category_description']);
            $store = new Store($el['store_id'], $el['postal_code'], $el['city'], $el['address']);
            $productInventory = new ProductInventory($el['product_inventory_id'], $el['product_inventory_quantity'], $store);
            $listOfProds[] = new Product($el['product_id'], $el['product_name'], $el['product_description'], $el['product_price'], $el['product_image'], $productCategory, $productInventory);
        }

        return $listOfProds;
    }

    public function getProducts(int $product_category_id, int $store_id, string $product_name) {
        $conn = $this->database->getConnection();
        $stmt = $conn->prepare(
            "SELECT p.id, 
                        p.name, 
                        p.description, 
                        p.price, 
                        p.image
                    FROM public.product as p
                        JOIN public.product_category_assignment as pca ON p.id = pca.product_id
                        JOIN public.product_category as pc ON pca.product_category_id = pc.id
                        JOIN public.product_inventory as pi ON p.inventory_id = pi.id
                        JOIN public.store as s ON pi.store_id = s.id
                    WHERE p.disabled = '0'
                    AND (pc.id = :product_category_id or :product_category_id = -1)
                    AND (s.id = :store_id or :store_id = -1)
                    AND LOWER(p.name) LIKE :product_name or :product_name is null;"
        );
        $stmt->bindParam(':product_category_id', $product_category_id, PDO::PARAM_INT);
        $stmt->bindParam(':store_id', $store_id, PDO::PARAM_INT);
        $productNameParam = '%' . $product_name . '%';
        $stmt->bindParam(':product_name', $productNameParam, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // json, don't change
    }

    public function getProductById(int $product_id) {
        $conn = $this->database->getConnection();

        $stmt = $conn->prepare(
            "SELECT p.id as product_id, 
                        p.name as product_name, 
                        p.description as product_description, 
                        p.price as product_price, 
                        p.image as product_image, 
                        pc.id as product_category_id, 
                        pc.name as product_category_name,
                        pc.description as product_category_description,
                        pi.id as product_inventory_id,
                        pi.quantity as product_inventory_quantity,
                        s.id as store_id,
                        s.postal_code as postal_code,
                        s.city,
                        s.address
                    FROM public.product as p
                        JOIN public.product_category_assignment as pca ON p.id = pca.product_id
                        JOIN public.product_category as pc ON pca.product_category_id = pc.id
                        JOIN public.product_inventory as pi ON p.inventory_id = pi.id
                        JOIN public.store as s ON pi.store_id = s.id
                    WHERE p.id = :product_id AND p.disabled = '0'"
        );
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
        $stmt->execute();

        $el = $stmt->fetch(PDO::FETCH_ASSOC); // fetchAll

        if($el == false) {
            return null;
        }

        $productCategory = new ProductCategory($el['product_category_id'], $el['product_category_name'], $el['product_category_description']);
        $store = new Store($el['store_id'], $el['postal_code'], $el['city'], $el['address']);
        $productInventory = new ProductInventory($el['product_inventory_id'], $el['product_inventory_quantity'], $store);

        return new Product($el['product_id'], $el['product_name'], $el['product_description'], $el['product_price'], $el['product_image'], $productCategory, $productInventory);
    }

    public function addNewProduct(Product $product, $quantity, $store_id, $product_category_id) {
        $conn = $this->database->getConnection();
        $conn->beginTransaction();

        try {
            $stmt = $conn->prepare(
                'INSERT INTO public.product_inventory (quantity, store_id) VALUES (:product_quantity, :store_id) RETURNING id'
            );
            $stmt->bindParam(':product_quantity', $quantity, PDO::PARAM_STR);
            $stmt->bindParam(':store_id', $store_id, PDO::PARAM_STR);
            $stmt->execute();
            $product_inventory_id = $stmt->fetch(PDO::FETCH_ASSOC)['id'];

            $stmt2 = $conn->prepare(
                'INSERT INTO public.product (name, description, inventory_id, price, image)
                   VALUES (:name, :description, :inventory_id, :price, :img_path) RETURNING id'
            );
            $name = $product->getName();
            $desc = $product->getDescription();
            $price = $product->getPrice();
            $image_path = $product->getImage();
            $stmt2->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt2->bindParam(':description', $desc, PDO::PARAM_STR);
            $stmt2->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt2->bindParam(':img_path', $image_path, PDO::PARAM_STR);
            $stmt2->bindParam(':inventory_id', $product_inventory_id, PDO::PARAM_STR);
            $stmt2->execute();
            $new_prod_id = $stmt2->fetch(PDO::FETCH_ASSOC)['id'];
            $product->setId($new_prod_id);

            $stmt3 = $conn->prepare(
                'INSERT INTO public.product_category_assignment (product_id, product_category_id)
                       VALUES (:product_id, :product_category_id)'
            );
            $id = intval($new_prod_id);
            $category_id = intval($product_category_id);
            $stmt3->bindParam(':product_id', $id, PDO::PARAM_INT);
            $stmt3->bindParam(':product_category_id', $category_id, PDO::PARAM_INT);
            $stmt3->execute();
        } catch (PDOException $e) {
            $conn->rollBack();
            print_r($e->errorInfo);
            return null;
        }

        $conn->commit();
        return 0;
    }

    public function modifyProduct(Product $product) {
        $conn = $this->database->getConnection();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare(
                'UPDATE public.product 
                        SET 
                          name = :name,
                          description = :description,
                          price = :price,
                          image = :img_path
                   WHERE id = :product_id'
            );
            $name = $product->getName();
            $desc = $product->getDescription();
            $price = $product->getPrice();
            $image_path = $product->getImage();
            $product_id = $product->getId();
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $desc, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->bindParam(':img_path', $image_path, PDO::PARAM_STR);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
            $stmt->execute();

            $stmt2 = $conn->prepare(
                'UPDATE public.product_inventory as pi
                        SET quantity = :quantity
                        FROM public.product P
                        WHERE pi.id = p.inventory_id
                        AND p.id = :product_id'
            );
            $quantity = $product->getProductInventory()->getTotalQuantityInStore();
            $stmt2->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt2->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt2->execute();

        } catch (PDOException $e) {
            $conn->rollBack();
            print($e->errorInfo);
            return null;
        }

        $conn->commit();

        return 0;
    }

    public function deleteProduct(int $product_id) {
        $conn = $this->database->getConnection();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare(
                'select delete_or_disable_product(:product_id);'
            );

            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
            $path = $stmt->fetch(PDO::FETCH_ASSOC)['delete_or_disable_product'];
        } catch (PDOException $e) {
            $conn->rollBack();
            print($e->errorInfo);
            return null;
        }
        $conn->commit();
        return $path;
    }

    public function getAllProductCategories() {
        $conn = $this->database->getConnection();
        $stmt = $conn->prepare(
            'SELECT * FROM product_category;'
        );
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result == false) {
            return null;
        }

        $productCategories = array();
        foreach ($result as $el) {
            $productCategories[] = new ProductCategory($el['id'], $el['name'], $el['description']);
        }

        return $productCategories;
    }


}