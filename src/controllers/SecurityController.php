<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../models/Session.php';

class SecurityController extends AppController {

    public function login_secure() {

        $userRepository = new UserRepository();

        if (!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->getUser($email);

        if(!$user) {
            //return $this->render('login', ['messages' => ['user not found']]);
            var_dump("user not found");
            die();
        }

        if($user->getPassword() !== $password) {
            //return $this->render('login', ['messages' => ['incorrect password']]);
            var_dump("user password incorrect");
            die();
        }

        //$session = Session::getInstance();
        //$session->session_id = 111;
        //session_start();
        //$_SESSION['session_id'] = 111;
        //session_write_close();

        setcookie("user_token", $user->getEmail(), time() + (60*1), '/');
        //setcookie("user_token", $user->get, time() + (60*1), '/');

        $url = "http://" . $_SERVER['HTTP_HOST'];
        header("Location: {$url}/main");

        //return $this->render('main-page');

    }




}