<?php

//require_once "AppController.php";
require_once __DIR__."/../../autoload.php";

class CartController extends AppController {

    private $cartRepository;

    public function __construct() {
        parent::__construct();
        $this->cartRepository = new CartRepository();
    }

    public function cart() {
        $this->cartRepository->reloadCart();
        $cart_items = $this->cartRepository->getAllCartItems();
        if (empty($cart_items)){
            $this->render('cart');
        } else {
            $this->render('cart', ['cart_items' => $cart_items]);
        }
    }


    public function addProductToCart() {
        if (isset($_COOKIE['user_token'])) {
            $validate = new SecurityController();
            $validate->validateUserToken();

            $tmp = $this->cartRepository->addProductToCart($_POST['product_id'], $_POST['quantity']);
            if (!is_null($tmp)) {
                $url = "http://" . $_SERVER['HTTP_HOST'];
                header("Location: {$url}/main#products-container");
            }
        }else {
            $url = "http://" . $_SERVER['HTTP_HOST'];
            header("Location: {$url}/login");
        }
    }

    public function removeItemFromCart() {
        if (!$this->isPost()){
            return;
        }
        if (isset($_POST['cart_item_id'])) {
            $this->cartRepository->removeItemFromCart(intval($_POST['cart_item_id']));
        }
        $url = "http://" . $_SERVER['HTTP_HOST'];
        header("Location: {$url}/cart");
    }

}