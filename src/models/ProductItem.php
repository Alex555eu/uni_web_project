<?php

class ProductItem {

    private $id;
    private $productQuantity;
    private $product;


    public function __construct($id, $productQuantity, $product) {
        $this->id = $id;
        $this->productQuantity = $productQuantity;
        $this->product = $product;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getProductQuantity() {
        return $this->productQuantity;
    }

    public function setProductQuantity($productQuantity): void {
        $this->productQuantity = $productQuantity;
    }

    public function getProduct() {
        return $this->product;
    }

    public function setProduct($product): void {
        $this->product = $product;
    }



}