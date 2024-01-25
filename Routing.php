<?php

require_once __DIR__."/autoload.php";

class Routing {
    public static $routes; // map

    public static function get($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function post($url, $controller) {
        self::$routes[$url] = $controller;
    }

    public static function run($path) {
        $url = parse_url($path, PHP_URL_PATH);
        $action = explode("/", $url)[0];

        if(!array_key_exists($action, self::$routes)) {
            die("Wrong url!");
        }

        // TODO: call controller
        $controller = self::$routes[$action];

        $object = new $controller();

        if (is_a($object, 'ProductController')) {
            $tmp = parse_url($path, PHP_URL_QUERY );
            $tmp = intval(filter_var($tmp, FILTER_SANITIZE_NUMBER_INT));
            if ($tmp != 0) {
                $object->select_product($tmp);
                return;
            } else
                die("Wrong url!");

        }

        $object->$action();
    }




}

