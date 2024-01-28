<?php



class CartItem extends Product {

    private $cartItemId;
    private $amountInCart;
    public function __construct($cartItemId, $id, $name, $price, $image, $desc, $category_id, $quantity, $store_id, $amountInCart) {
        parent::__construct($id, $name, $price, $image, $desc, $category_id, $quantity, $store_id);
        $this->cartItemId = $cartItemId;
        $this->amountInCart = $amountInCart;
    }

    public function getCartItemId()
    {
        return $this->cartItemId;
    }

    public function setCartItemId($cartItemId): void
    {
        $this->cartItemId = $cartItemId;
    }

    public function getAmountInCart()
    {
        return $this->amountInCart;
    }

    public function setAmountInCart($amountInCart): void
    {
        $this->amountInCart = $amountInCart;
    }


}