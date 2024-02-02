<?php

require_once __DIR__.'/Repository.php';

class UserRepository extends Repository {

    public function getUserByEmail(string $email): ?User
    {
        $conn = $this->database->getConnection();

        $stmt = $conn->prepare(
            'SELECT us.*, w.authorization_level FROM public.user AS us
                   LEFT JOIN public.worker as w ON us.id = w.user_id
                   WHERE us.email_address = :email'
        );
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user == false) {
            return null;
        }
        if (is_null($user['authorization_level'])) {
            return new User (
                $user['email_address'],
                $user['password'],
                $user['first_name'],
                $user['last_name'],
                $user['id']
            );
        } else {
            return new Worker(
                $user['email_address'],
                $user['password'],
                $user['first_name'],
                $user['last_name'],
                $user['authorization_level'],
                $user['store_id'],
                $user['id']
            );
        }
    }

    public function getUserByToken(?string $user_token) : ?User {
        if (!is_null($user_token)) {
            $conn = $this->database->getConnection();
            $stmt = $conn->prepare(
                'select us.*, w.authorization_level, w.store_id from public.shopping_session as ss
                    left join public.user as us on ss.user_id = us.id
                    left join public.worker as w on w.user_id = us.id
                    where ss.id = :user_token'
            );
            $stmt->bindParam(':user_token', $user_token, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user == false) {
                return null;
            }
            if (is_null($user['authorization_level'])) {
                return new User (
                    $user['email_address'],
                    $user['password'],
                    $user['first_name'],
                    $user['last_name'],
                    $user['id']
                );
            } else {
                return new Worker(
                    $user['email_address'],
                    $user['password'],
                    $user['first_name'],
                    $user['last_name'],
                    $user['authorization_level'],
                    $user['store_id'],
                    $user['id']
                );
            }
        }
        return null;
    }

    public function addUser($user): ?bool {
        $conn = $this->database->getConnection();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare(
                'INSERT INTO public.user (email_address, password, first_name, last_name) VALUES (:email, :password, :name, :surname)'
            );
            $stmt->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);
            $stmt->bindParam(':password', $user->getPassword(), PDO::PARAM_STR);
            $stmt->bindParam(':name', $user->getName(), PDO::PARAM_STR);
            $stmt->bindParam(':surname', $user->getSurname(), PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $conn->rollBack();
            print($e->errorInfo);
            return null;
        }
        $conn->commit();
        return true;
    }

    public function deleteUserToken() {
        $conn = $this->database->getConnection();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare(
                'DELETE FROM public.shopping_session as ss WHERE ss.id = :session_id'
            );
            $stmt->bindParam(':session_id', $_COOKIE['user_token'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $conn->rollBack();
            print($e->errorInfo);
            return null;
        }
        $conn->commit();

        setcookie("user_token", '', time() - 60, '/');

        return 0;
    }

    public function updateUserData() {
        $conn = $this->database->getConnection();
        $conn->beginTransaction();
        try {
            $stmt = $conn->prepare(
                'UPDATE public.user as u
                        SET 
		                first_name = :name,
                        last_name = :surname,
                        email_address = :email
                        FROM public.shopping_session as ss
                        WHERE u.id = ss.user_id
                        AND ss.id = :session_id'
            );
            $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
            $stmt->bindParam(':surname', $_POST['surname'], PDO::PARAM_STR);
            $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
            $stmt->bindParam(':session_id', $_COOKIE['user_token'], PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            $conn->rollBack();
            print($e->errorInfo);
            return null;
        }
        $conn->commit();

        return 0;
    }


}