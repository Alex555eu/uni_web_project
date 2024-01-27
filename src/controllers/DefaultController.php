<?php

//require_once "AppController.php";
require_once __DIR__."/../../autoload.php";

class DefaultController extends AppController {

    public function index() {
        $this->render('index');
    }

    public function main() {

        $this->render('main-page');
    }

    public function locales() {
        $this->render('locales');
    }

    public function cart() {
        $this->render('cart');
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

}