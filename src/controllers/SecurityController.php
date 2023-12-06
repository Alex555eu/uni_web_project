<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityController extends AppController {

    public function login_sec() {
        $user = new User('example@email.com', 'passwd', 'John', 'Forger');
        
        var_dump($_POST);
        die();
    }

}