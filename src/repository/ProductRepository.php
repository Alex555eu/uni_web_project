<?php

require_once __DIR__.'/Repository.php';

class ProductRepository extends Repository {

    public function getAllProducts() {
        $conn = $this->database->getConnection();

        $stmt = $conn->prepare(
            'SELECT p.id, p.name, p.price, p.image, p.description, pca.product_category_id, pi.quantity, pi.store_id
                    FROM public.product as p
                    JOIN public.product_category_assignment as pca ON p.id = pca.product_id
                    JOIN public.product_category as pc ON pca.product_category_id = pc.id
                    JOIN public.product_inventory as pi ON p.inventory_id = pi.id
                    JOIN public.store as s ON pi.store_id = s.id'
        );
        $stmt->execute();

        $product = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll

        if($product == false) {
            return null;
        }

        $listOfProds = array();
        foreach ($product as $el) {
            $listOfProds[] = new Product($el['id'], $el['name'], $el['price'], $el['image'], $el['description'], $el['product_category_id'], $el['quantity'], $el['store_id']);
        }

        return $listOfProds;
    }

    public function getProductsFromStoreByCategoryName(int $store_id, string $product_category_name)
    {
        $conn = $this->database->getConnection();

        $stmt = $conn->prepare(
            'SELECT p.id, p.name, p.price, p.image, p.description, pca.product_category_id, pi.quantity, pi.store_id
                    FROM public.product as p
                    JOIN public.product_category_assignment as pca ON p.id = pca.product_id
                    JOIN public.product_category as pc ON pca.product_category_id = pc.id
                    JOIN public.product_inventory as pi ON p.inventory_id = pi.id
                    JOIN public.store as s ON pi.store_id = s.id
                    WHERE pc.name = :product_category_name
                    AND s.id = :store_id'
        );
        $stmt->bindParam(':product_category_name', $product_category_name, PDO::PARAM_STR);
        $stmt->bindParam(':store_id', $store_id, PDO::PARAM_STR);
        $stmt->execute();

        $product = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll

        if($product == false) {
            return null;
        }

        $listOfProds = array();
        foreach ($product as $el) {
            $listOfProds[] = new Product($el['id'], $el['name'], $el['price'], $el['image'], $el['description'], $el['product_category_id'], $el['quantity'], $el['store_id']);
        }

        return $listOfProds;
    }

    public function getProductsByName(string $product_name) {
        $product_name = strtolower($product_name);
        $conn = $this->database->getConnection();
        $stmt = $conn->prepare(
            'SELECT p.id, p.name, p.price, p.image, p.description, pca.product_category_id, pi.quantity, pi.store_id
                    FROM public.product as p
                    JOIN public.product_category_assignment as pca ON p.id = pca.product_id
                    JOIN public.product_category as pc ON pca.product_category_id = pc.id
                    JOIN public.product_inventory as pi ON p.inventory_id = pi.id
                    JOIN public.store as s ON pi.store_id = s.id
                    WHERE LOWER(p.name) LIKE :product_name'
        );
        $productNameParam = '%' . $product_name . '%';
        $stmt->bindParam(':product_name', $productNameParam, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById(int $product_id) {
        $conn = $this->database->getConnection();

        $stmt = $conn->prepare(
            'SELECT p.id, p.name, p.price, p.image, p.description, pca.product_category_id, pi.quantity, pi.store_id
                    FROM public.product as p
                    JOIN public.product_category_assignment as pca ON p.id = pca.product_id
                    JOIN public.product_inventory as pi ON p.inventory_id = pi.id 
                    WHERE p.id = :product_id'
        );
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
        $stmt->execute();

        $el = $stmt->fetch(PDO::FETCH_ASSOC); // fetchAll

        if($el == false) {
            return null;
        }

        $product = new Product($el['id'], $el['name'], $el['price'], $el['image'], $el['description'], $el['product_category_id'], $el['quantity'], $el['store_id']);

        return $product;
    }

    public function addNewProduct(Product $product) {
        $conn = $this->database->getConnection();
        $conn->beginTransaction();

        try {
            $stmt = $conn->prepare(
                'INSERT INTO public.product_inventory (quantity, store_id) VALUES (:product_quantity, :store_id) RETURNING id'
            );
            $quantity = $product->getQuantity();
            $store_id = $product->getStoreId();
            $stmt->bindParam(':product_quantity', $quantity, PDO::PARAM_STR);
            $stmt->bindParam(':store_id', $store_id, PDO::PARAM_STR);
            $stmt->execute();
            $product_inventory_id = $stmt->fetch(PDO::FETCH_ASSOC)['id']; // fetchAll

            $stmt2 = $conn->prepare(
                'INSERT INTO public.product (name, description, inventory_id, price, image)
                   VALUES (:name, :description, :inventory_id, :price, :img_path) RETURNING id'
            );
            $name = $product->getName();
            $desc = $product->getDesc();
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
            $category_id = intval($product->getCategoryId());
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
            $desc = $product->getDesc();
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
            $quantity = $product->getQuantity();
            $product_id = $product->getId();
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
                'DELETE FROM public.product_inventory
                       USING public.product AS p
                       WHERE public.product_inventory.id = p.inventory_id
                       AND p.id = :product_id
                       RETURNING p.image'
            );

            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->execute();
            $path = $stmt->fetch(PDO::FETCH_ASSOC)['image'];
        } catch (PDOException $e) {
            $conn->rollBack();
            print($e->errorInfo);
            return null;
        }
        $conn->commit();
        return $path;
    }


}