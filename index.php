<?php

require "Routing.php";

$path = trim($_SERVER['REQUEST_URI'], '/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('main', 'DefaultController');
Routing::get('locales', 'DefaultController');
Routing::get('cart', 'DefaultController');
Routing::get('register', 'DefaultController');
Routing::post('login', 'DefaultController');
Routing::post('login_sec', 'SecurityController');
Routing::run($path);