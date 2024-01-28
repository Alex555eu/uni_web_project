<?php

require_once __DIR__.'/Repository.php';

class OrderRepository extends Repository {

    public function addProductToCart(int $product_id, int $quantity) {
        $conn = $this->database->getConnection();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare(
                'INSERT INTO public.cart_item (product_id, quantity, session_id) values (:product_id, :quantity, :session_id)'
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
            'SELECT ci.id as cart_item_id, p.id as product_id, p.name, p.price, p.image, p.description, pca.product_category_id, pi.quantity as inv_quantity, pi.store_id, ci.quantity
                    FROM public.cart_item as ci
	                JOIN public.product as p on p.id = ci.product_id
	                JOIN public.product_category_assignment as pca ON ci.product_id = pca.product_id
	                JOIN public.product_inventory as pi ON p.inventory_id = pi.id
	                where ci.session_id = :session_id'
        );
        $stmt->bindParam(':session_id', $_COOKIE['user_token'], PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $cartItems = [];
        foreach ($result as $item) {
            $cartItems[] = new CartItem($item['cart_item_id'], $item['product_id'], $item['name'], $item['price'], $item['image'], $item['description'], $item['product_category_id'], $item['inv_quantity'], $item['store_id'], $item['quantity']);
        }

        return $cartItems;
    }



}