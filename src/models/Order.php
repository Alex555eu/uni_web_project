<?php



class Order {

    private $id;
    private $productItems;
    private $total;
    private $placementDate;
    private $additionalInfo;
    private $user;

    public function __construct($id, $productItems, $total, $placementDate, $additionalInfo, $user) {
        $this->id = $id;
        $this->productItems = $productItems;
        $this->total = $total;
        $this->placementDate = $placementDate;
        $this->additionalInfo = $additionalInfo;
        $this->user = $user;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function addProductItem($productItem) {
        $this->productItems[] = $productItem;
    }

    public function getProductItems() {
        return $this->productItems;
    }

    public function setProductItems($productItems): void {
        $this->productItems = $productItems;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total): void {
        $this->total = $total;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user): void {
        $this->user = $user;
    }
    public function getPlacementDate() {
        return $this->placementDate;
    }
    public function setPlacementDate($placementDate): void {
        $this->placementDate = $placementDate;
    }

    public function getAdditionalInfo() {
        return $this->additionalInfo;
    }

    public function setAdditionalInfo($additionalInfo): void {
        $this->additionalInfo = $additionalInfo;
    }


}