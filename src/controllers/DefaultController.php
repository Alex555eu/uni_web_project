<?php

require_once "AppController.php";

class DefaultController extends AppController {

    public function main() {
        //die("projects method");
        $this->render('main-page');
    }

    public function locales() {
        //die("projects method");
        $this->render('locales');
    }

    public function cart() {
        //die("projects method");
        $this->render('cart');
    }

    public function login() {
        //die("projects method");
        $this->render('login');
    }

    public function register() {
        //die("projects method");
        $this->render('register');
    }


}