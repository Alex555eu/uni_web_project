<?php

require_once __DIR__.'/Repository.php';

class UserRepository extends Repository {

    public function getUser(string $email): ?User
    {
        $conn = $this->database->getConnection();

        $stmt = $conn->prepare(
            'SELECT * FROM public.user AS us WHERE us.email_address = :email'
        );
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user == false) {
            return null;
        }

        return new User (
            $user['email_address'],
            $user['password'],
            $user['first_name'],
            $user['last_name']
        );

    }

    public function addUser($user): ?bool
    {
        $conn = $this->database->getConnection();
        //'SELECT * FROM public.user AS us WHERE us.email_address = :email'
        $stmt = $conn->prepare(
            'INSERT INTO public.user (email_address, password, first_name, last_name) VALUES (:email, :password, :name, :surname)'
        );
        $stmt->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindParam(':password', $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindParam(':name', $user->getName(), PDO::PARAM_STR);
        $stmt->bindParam(':surname', $user->getSurname(), PDO::PARAM_STR);
        $stmt->execute();

        return true;
    }


}