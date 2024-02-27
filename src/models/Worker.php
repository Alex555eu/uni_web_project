<?php

class Worker extends User {

    private $authorization;
    private $store_id;

    public function __construct(string $email, string $password, string $name, string $surname, string $authorization = null, string $store_id = null, string $id = null) {
        parent::__construct($email, $password, $name, $surname, $id);
        $this->authorization = $authorization;
        $this->store_id = $store_id;
    }

    public function getAuthorization(): ?string {
        return $this->authorization;
    }

    public function getStoreId(): string {
        return $this->store_id;
    }

    public function toArray() : array {
        $array = parent::toArray();
        $array['store_id'] = $this->getStoreId();
        $array['authorization'] = $this->getAuthorization();
        return $array;
    }



}