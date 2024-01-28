<?php

require_once __DIR__."/../../autoload.php";

class OrderController extends AppController {

    private $orderRepository;

    public function __construct() {
        $this->orderRepository = new OrderRepository();
    }

    public function addProductToCart() {
        if (isset($_COOKIE['user_token'])) {
            $validate = new SecurityController();
            $validate->validate_user_token();

            $tmp = $this->orderRepository->addProductToCart($_POST['product_id'], $_POST['quantity']);
            if (!is_null($tmp)) {
                $url = "http://" . $_SERVER['HTTP_HOST'];
                header("Location: {$url}/main#products-container");
            }
        }else {
            $url = "http://" . $_SERVER['HTTP_HOST'];
            header("Location: {$url}/login");
        }
    }


}