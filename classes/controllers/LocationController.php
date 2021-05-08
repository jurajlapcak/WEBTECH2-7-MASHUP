<?php
require_once(__DIR__ . "/../helpers/Database.php");


class LocationController
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function insertLocation($lat, $lng)
    {
        $stm = $this->conn->prepare("INSERT IGNORE INTO locations (lat,lng) VALUES (:lat, :lng)");
        $stm->bindParam(":lng", $lng);
        $stm->bindParam(":lat", $lat);
        $stm->execute();

        return $this->getLocationId($lat, $lng);
    }

    public function getLocationId($lat, $lng): int
    {
        $stm = $this->conn->prepare("SELECT id FROM locations WHERE lat=:lat AND lng=:lng");
        $stm->bindParam(":lat", $lat);
        $stm->bindParam(":lng", $lng);
        $stm->execute();
        return $stm->fetch()["id"];
    }

    public function getLocations(){
        $stm = $this->conn->prepare("SELECT lat,lng FROM locations");
        $stm->execute();
        return $stm->fetchAll();
    }
}