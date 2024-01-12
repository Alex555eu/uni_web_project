<?php

require "Routing.php";

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('main', 'DefaultController');
Routing::get('locales', 'DefaultController');
Routing::get('cart', 'DefaultController');
Routing::get('register', 'DefaultController');

Routing::get('select_product', 'ProductController');

Routing::post('login', 'DefaultController');
Routing::post('login_secure', 'SecurityController');
Routing::post('register_secure', 'SecurityController');
Routing::run($path);