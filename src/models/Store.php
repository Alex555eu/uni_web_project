<?php


class Store {

    private $id;
    private $postalCode;
    private $city;
    private $address;


    public function __construct($id, $postalCode, $city, $address) {
        $this->id = $id;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->address = $address;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getPostalCode() {
        return $this->postalCode;
    }

    public function setPostalCode($postalCode): void {
        $this->postalCode = $postalCode;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city): void {
        $this->city = $city;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address): void {
        $this->address = $address;
    }

    public function __toString(): string {
        return $this->postalCode . ' ' . $this->city . ', ' . $this->address;
    }

}

