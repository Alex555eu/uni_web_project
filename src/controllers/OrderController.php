<?php

require_once __DIR__."/../../autoload.php";

class OrderController extends AppController {

    private $orderRepository;

    public function __construct() {
        parent::__construct();
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

    public function removeItemFromCart() {
        if (!$this->isPost()){
            return;
        }
        if (isset($_POST['cart_item_id'])) {
            $this->orderRepository->removeItemFromCart(intval($_POST['cart_item_id']));
        }
        $url = "http://" . $_SERVER['HTTP_HOST'];
        header("Location: {$url}/cart");
    }

    public function placeAnOrder() {
        if (!$this->isPost()){
            return;
        }

        $result = $this->orderRepository->placeAnOrder();

        if (is_null($result)) {
            $this->render('cart', ['message' => 'Error occurred']);
        } else {
            $this->render('cart', ['message' => 'Thank you for placing your order']);
        }

    }

    public function orders_history() {
        $result = $this->orderRepository->getOrdersHistory();
        usort($result, function($a, $b){
            return $b->getId() - $a->getId();
        });
        $repo = new LocationRepository();
        $locations = $repo->getAllLocations();
        $this->render('orders_history', ['orders' => $result, 'locations' => $locations]);
    }



}