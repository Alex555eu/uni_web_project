<?php



class Order {

    private $id;
    private $products;
    private $total;
    private $user_email;


    public function __construct($order_id, array $products, $total, $user_email) {
        $this->id = $order_id;
        $this->products = $products;
        $this->total = $total;
        $this->user_email = $user_email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products): void
    {
        $this->products = $products;
    }

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total): void
    {
        $this->total = $total;
    }

    public function getUserEmail()
    {
        return $this->user_email;
    }

    public function setUserEmail($user_email): void
    {
        $this->user_email = $user_email;
    }




}