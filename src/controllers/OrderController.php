<?php

require_once __DIR__."/../../autoload.php";

class OrderController extends AppController {

    private $orderRepository;

    public function __construct() {
        parent::__construct();
        $this->orderRepository = new OrderRepository();
    }

    public function orders_history() {
        $ordersHistory = $this->orderRepository->getOrdersHistory();
        usort($ordersHistory, function($a, $b){ // reverse the order
            return $b->getId() - $a->getId();
        });
        $this->render('orders_history', ['orders' => $ordersHistory]);
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


}