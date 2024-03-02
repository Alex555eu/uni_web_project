<?php

//require_once 'AppController.php';
//require_once __DIR__.'/../models/User.php';
//require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController {

    public function loginSecure() {
        $userRepository = new UserRepository();
        if (!$this->isPost()) {
            return $this->render('login');
        }
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $userRepository->getUserByEmail($email);
        if(!$user) {
            return $this->render('login', ['messages' => ['user not found']]);
        }
        if (!password_verify($password, $user->getPassword())) {
            return $this->render('login', ['messages' => ['incorrect password']]);
        }

        $new_session = $this->createUserToken($user->getId());

        setcookie("user_token", $new_session, time() + (365 * 24 * 60 * 60), '/');

        $url = "http://" . $_SERVER['HTTP_HOST'];
        header("Location: {$url}/main");

    }

    public function logout() {
        $repo = new UserRepository();
        $repo->deleteUserToken();
        $url = "http://" . $_SERVER['HTTP_HOST'];
        header("Location: {$url}/login");
    }

    public function registerSecure() {
        if (!$this->isPost()) {
            return $this->render('login');
        }
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $options = [
            'cost' => 12,
        ];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);

        $user = new User($email, $password, $name, $surname);

        $userRepository = new UserRepository();
        $res = $userRepository->addUser($user);
        if (is_null($res)) {
            $this->render('register', ['messages' => 'Account already exists']);
        }
        $url = "http://" . $_SERVER['HTTP_HOST'];
        header("Location: {$url}/login");
    }

    public function validateUserToken() {
        if (isset($_COOKIE['user_token'])) {
            $db = Database::getInstance();
            $conn = $db->getConnection();
            $conn->beginTransaction();
            try {
                $stmt = $conn->prepare(
                    'SELECT validate_user_token(:token_id)' // returns token_id on success or null
                );
                $stmt->bindParam(':token_id', $_COOKIE['user_token'], PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                $conn->rollBack();
                echo $e->getTraceAsString();
            }
            $conn->commit();
            if ($result['validate_user_token'] != $_COOKIE['user_token']) {
                setcookie("user_token", '', time() - 60, '/');
                $url = "http://" . $_SERVER['HTTP_HOST'];
                header("Location: {$url}/login?alert=expired");
                return 0;
            }
        }
        return null;
    }

    private function createUserToken($user_id) {
        $db = Database::getInstance();
        $conn = $db->getConnection();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare(
                'SELECT create_user_token(:user_id)'
            );
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
            $stmt->execute();
            $new_session_id = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $conn->rollBack();
            //echo $e->getTraceAsString();
            $this->render('login', ['messages' => ['error']]);
        }
        $conn->commit();
        return $new_session_id['create_user_token'];
    }

    public function updateUserData() {
        $repo = new UserRepository();
        $repo->updateUserData();
        $url = "http://" . $_SERVER['HTTP_HOST'];
        header("Location: {$url}/user");
    }

}