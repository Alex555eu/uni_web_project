<?php

class User {
    private $email;
    private $password;
    private $name;
    private $surname;
    private $id;

    public function __construct(string $email, string $password, string $name, string $surname, string $id = null) {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->id = $id;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }
    public function getPassword() : string {
        return $this->password;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }
    public function getName() : string {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
    }
    public function getSurName() : string {
        return $this->surname;
    }

    public function setSurName(string $surname) {
        $this->surname = $surname;
    }

    public function getId() : string {
        return $this->id;
    }

    public function toArray() {
        return [
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'name' => $this->getName(),
            'surname' => $this->getSurName(),
            'id' => $this->getId()
        ];
    }


}