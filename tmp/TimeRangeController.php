<?php
require_once(__DIR__ . "/../helpers/Database.php");


class TimeRangeController
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function getType($id){
        $stm = $this->conn->prepare("SELECT type FROM time_ranges WHERE id=:id");
        $stm->bindParam(":id", $id, PDO::PARAM_INT);
        $stm->execute();
        $result = $stm->fetch();
        if($result!=false){
            return $result["type"];
        }
        return "Ja neviem uz";
    }

    public function getTypes(){
        $stm = $this->conn->prepare(" SELECT id, type FROM time_ranges GROUP BY type");
        $stm->execute();
        $results = $stm->fetchAll();

        return $results;
    }
}