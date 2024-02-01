<?php

//require_once "AppController.php";
require_once __DIR__."/../../autoload.php";

class DefaultController extends AppController {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->render('index');
    }

    public function main() {
        $this->render('main-page');
    }

    public function locales() {
        $repo = new LocationRepository();
        $locations = $repo->getAllLocations();
        $this->render('locales', ['locales' => $locations]);
    }

    public function cart() {
        $repo = new OrderRepository();
        $cart_data = $repo->getAllCartItems();
        if (empty($cart_data)){
            $this->render('cart');
        } else {
            $this->render('cart', ['cart_data' => $cart_data]);
        }
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
        $this->render('add_product');
    }

    public function modify_product() {
        $repo = new ProductRepository();
        $prod = $repo->getAllProducts();
        $this->render('modify_product', ['products' => $prod]);
    }

    public function user() {
        $this->render('user');
    }

    public function logout() {
        $repo = new UserRepository();
        $repo->deleteUserToken();
        $url = "http://" . $_SERVER['HTTP_HOST'];
        header("Location: {$url}/main");
    }

    public function updateUserData() {
        $repo = new UserRepository();
        $repo->updateUserData();
        $url = "http://" . $_SERVER['HTTP_HOST'];
        header("Location: {$url}/user");
    }


}