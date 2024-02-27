<?php


class Product {
    private $id;
    private $name;
    private $description;
    private $price;
    private $image;
    private $productCategory;
    private $productInventory;

    public function __construct($id, $name, $description, $price, $image, $productCategory, $productInventory)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->image = $image;
        $this->productCategory = $productCategory;
        $this->productInventory = $productInventory;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): void
    {
        $this->price = $price;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function getProductCategory()
    {
        return $this->productCategory;
    }

    public function setProductCategory($productCategory): void
    {
        $this->productCategory = $productCategory;
    }

    public function getProductInventory()
    {
        return $this->productInventory;
    }

    public function setProductInventory($productInventory): void
    {
        $this->productInventory = $productInventory;
    }




}