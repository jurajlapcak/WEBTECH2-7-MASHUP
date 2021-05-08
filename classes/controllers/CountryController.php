<?php
require_once(__DIR__ . "/../helpers/Database.php");
require_once(__DIR__ . "/../models/CountryFromDb.php");


class CountryController
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function insertCountry($code, $name)
    {
        $stm = $this->conn->prepare("INSERT IGNORE INTO countries (code,name) VALUES (:code,:name)");
        $stm->bindParam(":code", $code);
        $stm->bindParam(":name", $name);
        $stm->execute();

        return $this->getCountryId($code);
    }

    public function getCountryId($code): int
    {
        $stm = $this->conn->prepare("SELECT id FROM countries WHERE code=:code");
        $stm->bindParam(":code", $code);
        $stm->execute();
        return $stm->fetch()["id"];
    }

    public function getCountry($id)
    {
        $stm = $this->conn->prepare("SELECT * FROM countries WHERE id=:id");
        $stm->bindParam(":id", $id, PDO::PARAM_INT);
        try {
            $stm->execute();
            $stm->setFetchMode(PDO::FETCH_CLASS, "CountryFromDb");
            return $stm->fetch();
        }catch (Exception $e) {
            return null;
        }
    }
}