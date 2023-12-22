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


}