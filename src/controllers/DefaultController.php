<?php

require_once "AppController.php";

class DefaultController extends AppController {

    public function index() {
        //die("index method");
        $this->render('login');
    }

    public function projects() {
        //die("projects method");
        $this->render('main');
    }
}