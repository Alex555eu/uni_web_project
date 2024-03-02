<?php

require_once __DIR__.'/Repository.php';

class StoreRepository extends Repository {

    public function getAllLocations(): ?array {
        $conn = $this->database->getConnection();
        $stmt = $conn->prepare(
            'SELECT * FROM public.store'
        );
        $stmt->execute();
        $location = $stmt->fetchAll(PDO::FETCH_ASSOC); // fetchAll
        if($location == false) {
            return null;
        }
        $listOfLocations = array();
        foreach ($location as $el) {
            $listOfLocations[] = new Store($el['id'], $el['postal_code'], $el['city'], $el['address']);
        }

        return $listOfLocations;
    }

    public function getLocationById($location_id): ?Store {
        $conn = $this->database->getConnection();
        $stmt = $conn->prepare(
            'SELECT * FROM public.store WHERE id = :store_id'
        );
        $tmp = intval($location_id);
        $stmt->bindParam(':store_id', $tmp, PDO::PARAM_INT);
        $stmt->execute();
        $location = $stmt->fetch(PDO::FETCH_ASSOC);

        if($location == false) {
            return null;
        }

        return new Store($location['id'], $location['postal_code'], $location['city'], $location['address']);
    }



}