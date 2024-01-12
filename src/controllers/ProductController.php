<?php

//require_once "AppController.php";
require_once __DIR__."/../../autoload.php";

class ProductController extends AppController {

    public function select_product() {
        $this->render('product');
    }

}