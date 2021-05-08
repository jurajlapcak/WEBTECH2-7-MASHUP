<?php


class CityController
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function insertCity($country_id, $name)
    {
        $stm = $this->conn->prepare("INSERT IGNORE INTO cities (country_id,name) VALUES (:country_id,:name)");
        $stm->bindParam(":country_id", $country_id, PDO::PARAM_INT);
        $stm->bindParam(":name", $name);
        $stm->execute();

        return $this->getCityId($country_id, $name);
    }

    public function getCityId($country_id, $name): int
    {
        $stm = $this->conn->prepare("SELECT id FROM cities WHERE country_id=:country_id AND name=:name");
        $stm->bindParam(":country_id", $country_id, PDO::PARAM_INT);
        $stm->bindParam(":name", $name);
        $stm->execute();
        return $stm->fetch()["id"];
    }
}