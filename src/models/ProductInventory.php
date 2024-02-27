<?php


class ProductInventory {

    private $id;
    private $totalQuantityInStore;
    private $store;

    public function __construct($id, $totalQuantityInStore, $store) {
        $this->id = $id;
        $this->totalQuantityInStore = $totalQuantityInStore;
        $this->store = $store;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getTotalQuantityInStore() {
        return $this->totalQuantityInStore;
    }

    public function setTotalQuantityInStore($totalQuantityInStore): void {
        $this->totalQuantityInStore = $totalQuantityInStore;
    }

    public function getStore() {
        return $this->store;
    }

    public function setStore($store): void {
        $this->store = $store;
    }




}