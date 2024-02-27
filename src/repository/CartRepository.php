<?php

require_once __DIR__.'/Repository.php';

class CartRepository extends Repository {

    public function addProductToCart(int $product_id, int $quantity) {
        $conn = $this->database->getConnection();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare(
                'select add_product_to_cart(:product_id, :quantity, :session_id);'
            );
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':session_id', $_COOKIE['user_token'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $conn->rollBack();
            print_r($e->errorInfo);
            return null;
        }
        $conn->commit();
        return 0;
    }

    public function getAllCartItems() {
        $conn = $this->database->getConnection();

        $stmt = $conn->prepare(
            'SELECT
                        ci.ID AS cart_item_id,
                        ci.quantity AS cart_item_quantity,
                        P.ID AS product_id,
                        P.NAME AS product_name,
                        P.description AS product_description,
                        P.price AS product_price,
                        P.image AS product_image,
                        pc.ID AS product_category_id,
                        pc.NAME AS product_category_name,
                        pc.description AS product_category_description,
                        pi.ID AS product_inventory_id,
                        pi.quantity AS product_inventory_quantity,
                        s.ID AS store_id,
                        s.postal_code AS postal_code,
                        s.city,
                        s.address 
                    FROM
                        PUBLIC.cart_item AS ci
                        JOIN PUBLIC.product AS P ON P.ID = ci.product_id
                        JOIN PUBLIC.product_category_assignment AS pca ON P.ID = pca.product_id
                        JOIN PUBLIC.product_category AS pc ON pca.product_category_id = pc.id 
                        JOIN PUBLIC.product_inventory AS pi ON P.inventory_id = pi."id"
                        JOIN PUBLIC.store AS s ON pi.store_id = s.id
                    WHERE
                        ci.session_id = :session_id;'
        );
        $stmt->bindParam(':session_id', $_COOKIE['user_token'], PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $cartItems = [];
        foreach ($result as $el) {
            $productCategory = new ProductCategory($el['product_category_id'], $el['product_category_name'], $el['product_category_description']);
            $store = new Store($el['store_id'], $el['postal_code'], $el['city'], $el['address']);
            $productInventory = new ProductInventory($el['product_inventory_id'], $el['product_inventory_quantity'], $store);
            $product = new Product($el['product_id'], $el['product_name'], $el['product_description'], $el['product_price'], $el['product_image'], $productCategory, $productInventory);
            $cartItems[] = new ProductItem($el['cart_item_id'], $el['cart_item_quantity'], $product);
        }

        return $cartItems;
    }

    public function removeItemFromCart(int $item_id) {
        $conn = $this->database->getConnection();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare(
                'DELETE FROM public.cart_item
                    WHERE id = :cart_item_id'
            );
            $stmt->bindParam(':cart_item_id', $item_id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            $conn->rollBack();
            print($e->errorInfo);
            return null;
        }
        $conn->commit();
        return 0;
    }

    public function reloadCart() {
        $conn = $this->database->getConnection();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare(
                'select reload_cart(:session_id);'
            );
            $stmt->bindParam(':session_id', $_COOKIE['user_token'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $conn->rollBack();
            print($e->errorInfo);
            return null;
        }
        $conn->commit();
        return 0;
    }


}