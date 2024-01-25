<?php

require_once __DIR__.'/Repository.php';

class ProductRepository extends Repository {

    public function getProductsFromStoreByCategoryName(int $store_id, string $product_category_name)
    {
        $conn = $this->database->getConnection();

        $stmt = $conn->prepare(
            'SELECT p.id, p.name, p.price, p.image, p.desc, p.category_id, p.inventory_id
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
            $listOfProds[] = new Product($el['id'], $el['name'], $el['price'], $el['image'], $el['desc'], $el['category_id'], $el['inventory_id']);
        }

        return $listOfProds;

    }

    public function getProductsById(int $product_id)
    {
        $conn = $this->database->getConnection();

        $stmt = $conn->prepare(
            'SELECT p.id, p.name, p.price, p.image, p.desc, p.category_id, p.inventory_id
                    FROM public.product as p
                    WHERE p.id = :product_id'
        );
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
        $stmt->execute();

        $product = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll

        if($product == false) {
            return null;
        }

        $listOfProds = array();
        foreach ($product as $el) {
            $listOfProds[] = new Product($el['id'], $el['name'], $el['price'], $el['image'], $el['desc'], $el['category_id'], $el['inventory_id']);
        }

        return $listOfProds;

    }


}