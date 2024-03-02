<?php

//require_once "AppController.php";
require_once __DIR__."/../../autoload.php";

class DefaultController extends AppController {

    public function __construct() {
        parent::__construct();
    }

    public function main() {
        $productsRepository = new ProductRepository();
        $products = $productsRepository->getAllProducts();
        $categories = $productsRepository->getAllProductCategories();

        $storeRepository = new StoreRepository();
        $locales = $storeRepository->getAllLocations();

        $this->render('main-page', ['products' => $products, 'categories' => $categories, 'locales' => $locales]);
    }

    public function locales() {
        $repo = new StoreRepository();
        $locations = $repo->getAllLocations();
        $this->render('locales', ['locales' => $locations]);
    }

    public function login() {
        $this->render('login');
    }

    public function register() {
        $this->render('register');
    }

    public function admin() {
        $this->render('admin');
    }

    public function add_product() {
        $storeRepo = new StoreRepository();
        $locales = $storeRepo->getAllLocations();

        $productRepo = new ProductRepository();
        $productCategories = $productRepo->getAllProductCategories();

        $this->render('add_product', ['locales' => $locales, 'productCategories' => $productCategories]);
    }

    public function modify_product() {
        $repo = new ProductRepository();
        $prod = $repo->getAllProducts();
        $this->render('modify_product', ['products' => $prod]);
    }

    public function user() {
        $this->render('user');
    }

    public function cart() {
        $repo = new CartRepository();
        $repo->reloadCart();
        $cart_items = $repo->getAllCartItems();
        if (empty($cart_items)){
            $this->render('cart');
        } else {
            $this->render('cart', ['cart_items' => $cart_items]);
        }
    }

    public function select_product(string $argument) {
        $argument = intval(filter_var($argument, FILTER_SANITIZE_NUMBER_INT)); // returns 0 on failure
        if ($argument != 0) {
            $repo = new ProductRepository();
            $products = $repo->getProductById($argument);
            $this->render('select_product', ['product' => $products]);
        }
        else
            die("Wrong url!");
    }

    public function orders_history() {
        $repo = new OrderRepository();
        $ordersHistory = $repo->getOrdersHistory();
        usort($ordersHistory, function($a, $b){ // reverse the order
            return $b->getId() - $a->getId();
        });
        $this->render('orders_history', ['orders' => $ordersHistory]);
    }



}