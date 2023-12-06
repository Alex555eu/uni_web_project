<?php

require_once "AppController.php";

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
        $this->render('login', ['messages' => ["Hello za wuardoo !!!"]]);
    }

    public function register() {
        $this->render('register');
    }


}