<?php

require_once __DIR__.'/Repository.php';

class ProductRepository extends Repository {

    public function getProducts(string $product_category_name)
    {
        $conn = $this->database->getConnection();

        $stmt = $conn->prepare(
            'SELECT p.id, p.name, p.price, p.image, p.desc
                    FROM public.product as p
                    JOIN public.product_category_assignment as pca ON p.id = pca.product_id
                    JOIN public.product_category as pc ON pca.product_category_id = pc.id
                    WHERE pc.name = :product_category_name' // alter from many products based on category
        );
        $stmt->bindParam(':product_category_name', $product_category_name, PDO::PARAM_STR);
        $stmt->execute();

        $product = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll

        if($product == false) {
            return null;
        }

        $listOfProds = array();
        foreach ($product as $el) {
            $listOfProds[] = new Product($el['id'], $el['name'], $el['price'], $el['image'], $el['desc']);
        }

        return $listOfProds;

    }


}