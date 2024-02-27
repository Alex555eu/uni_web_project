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

    public function logout() {
        $repo = new UserRepository();
        $repo->deleteUserToken();
        $url = "http://" . $_SERVER['HTTP_HOST'];
        header("Location: {$url}/login");
    }



}