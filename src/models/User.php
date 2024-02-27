<?php

class User {
    private $email;
    private $password;
    private $name;
    private $surname;
    private $id;


    public function __construct($email, $password, $name, $surname, $id = null) {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->id = $id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password): void {
        $this->password = $password;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function getSurname() {
        return $this->surname;
    }

    public function setSurname($surname): void {
        $this->surname = $surname;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function toArray() : array{
        return [
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'name' => $this->getName(),
            'surname' => $this->getSurName(),
            'id' => $this->getId()
        ];
    }


}