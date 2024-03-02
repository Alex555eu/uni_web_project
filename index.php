<?php

require "Routing.php";

$path = trim($_SERVER['REQUEST_URI'], '/');
//$path = parse_url($path, PHP_URL_PATH);

Routing::get('main', 'DefaultController');
Routing::get('login', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('admin', 'DefaultController');
Routing::get('add_product', 'DefaultController');
Routing::get('modify_product', 'DefaultController');
Routing::get('user', 'DefaultController');
Routing::get('cart', 'DefaultController');
Routing::get('select_product', 'DefaultController');
Routing::get('orders_history', 'DefaultController');
Routing::get('locales', 'DefaultController');


//main
Routing::post('search', 'ProductController');
//login, register
Routing::post('loginSecure', 'SecurityController');
Routing::post('registerSecure', 'SecurityController');
Routing::post('logout', 'SecurityController');
// admin
Routing::post('addProduct', 'ProductController');
Routing::post('modifyProduct', "ProductController");
Routing::post('deleteProduct', 'ProductController');
// user
Routing::post('updateUserData', 'SecurityController');
// cart
Routing::post('addProductToCart', 'CartController');
Routing::post('removeItemFromCart', "CartController");
Routing::post('placeAnOrder', 'OrderController');


Routing::run($path);