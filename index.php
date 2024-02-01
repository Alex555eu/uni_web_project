<?php

require "Routing.php";

$path = trim($_SERVER['REQUEST_URI'], '/');
//$path = parse_url($path, PHP_URL_PATH);

Routing::get('main', 'DefaultController');
Routing::get('locales', 'DefaultController');
Routing::get('cart', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::get('select_product', 'ProductController');
Routing::get('admin', 'DefaultController');
Routing::get('user', 'DefaultController');
Routing::get('orders_history', 'OrderController');

Routing::post('add_product', 'DefaultController');
Routing::post('addProduct', 'ProductController');
Routing::post('login', 'DefaultController');
Routing::post('login_secure', 'SecurityController');
Routing::post('register_secure', 'SecurityController');
Routing::post('modify_product', 'DefaultController');
Routing::post('modifyProduct', "ProductController");
Routing::post('deleteProduct', 'ProductController');
Routing::post('addProductToCart', 'OrderController');
Routing::post('logout', 'DefaultController');
Routing::post('updateUserData', 'DefaultController');
Routing::post('removeItemFromCart', "OrderController");
Routing::post('placeAnOrder', 'OrderController');

Routing::post('search', 'ProductController');


Routing::run($path);