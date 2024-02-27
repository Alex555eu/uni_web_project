<?php

require_once __DIR__.'/Repository.php';

class OrderRepository extends Repository {

    public function getOrdersHistory() {
        $conn = $this->database->getConnection();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare(
                'SELECT
                            od.id as order_details_id,
                            od.total as order_details_total,
                            od.placement_date as order_placement_date,
                            od.additional_info as order_additional_info,
                            us.id as user_id,
                            us."password" as user_password,
                            us.first_name as user_first_name,
                            us.last_name as user_last_name,
                            us.email_address as user_email_address,
                            oi.id as order_item_id,
                            oi.quantity as order_item_quantity,
                            pr.id as product_id,
                            pr.name as product_name,
                            pr.description as product_description,
                            pr.price as product_price,
                            pr.image as product_image,
                            pi.id as product_inventory,
                            pi.quantity as product_inventory_quantity,
                            st.id as store_id,
                            st.postal_code as store_postal_code,
                            st.city as store_city,
                            st.address as store_address
                        FROM
                            order_details AS od
                            JOIN public.user AS us ON us.id = od.user_id
                            JOIN order_item AS oi ON oi.details_id = od.ID
                            JOIN product as pr ON pr.id = oi.product_id
                            JOIN product_inventory as pi on pi.id = pr.inventory_id
                            JOIN store as st on st.id = pi.store_id
                        ORDER BY
	                        od.id;'
            );
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $orders = array();
            foreach ($result as $res) {
                $currOrder = end($orders);
                if ($currOrder == null || $currOrder->getId() != $res['order_details_id']) {
                    $currOrder = new Order($res['order_details_id'], [], $res['order_details_total'], $res['order_placement_date'], $res['order_additional_info'], new User($res['user_email_address'], $res['user_password'], $res['user_first_name'], $res['user_last_name'], $res['user_id']));
                    $orders[] = $currOrder;
                }
                $store = new Store($res['id'], $res['postal_code'], $res['city'], $res['address']);
                $productInventory = new ProductInventory($res['product_inventory_id'], $res['product_inventory_quantity'], $store);
                $product = new Product($res['product_id'], $res['product_name'], $res['product_description'], $res['product_price'], $res['product_image'], null, $productInventory);
                $productItem = new ProductItem($res['order_item_id'], $res['order_item_quantity'], $product);
                $currOrder->addProductItem($productItem);
            }


        } catch (PDOException $e) {
            $conn->rollBack();
            print($e->errorInfo);
            return null;
        }
        $conn->commit();
        return $orders;
    }

    public function placeAnOrder(): ?int {
        if (isset($_COOKIE['user_token'])) {
            $conn = $this->database->getConnection();
            $conn->beginTransaction();
            try {
                $stmt = $conn->prepare(
                    'SELECT place_new_order(:session_id, :additional_info)'
                );
                $stmt->bindParam(':session_id', $_COOKIE['user_token'], PDO::PARAM_INT);
                $stmt->bindParam(':additional_info', $_POST['additional_info'], PDO::PARAM_STR);
                $stmt->execute();
            } catch (PDOException $e) {
                $conn->rollBack();
                $tmpRepo = new CartRepository();
                $tmpRepo->reloadCart();
                //print($e->errorInfo);
                return null;
            }
            $conn->commit();
            return 0;
        }
        return null;
    }

}