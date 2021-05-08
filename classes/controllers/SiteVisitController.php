<?php
require_once(__DIR__ . "/../helpers/Database.php");


class SiteVisitController
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function insertVisit($site){
        $stm = $this->conn->prepare("INSERT INTO site_visits (site) values(:site)");
        $stm->bindParam(":site", $site);
        $stm->execute();
    }

    public function getVisits($site){
        $stm = $this->conn->prepare("SELECT count(*) AS count FROM site_visits WHERE site=:site");
        $stm->bindParam(":site", $site);
        $stm->execute();
        return $stm->fetch()["count"];
    }

    public function visitTable(){
        $stm = $this->conn->prepare("SELECT site FROM site_visits GROUP by site");
        $stm->execute();
        $results =  $stm->fetchAll();

        $table = "<table class='visit-table'> <thead><tr><th>Stránka</th> <th>Počet návštev</th></tr></thead>";
        if($results != false){
            foreach ($results as $result){
                $site = $result["site"];
                $visits = $this->getVisits($site);
                $table .= "<tr>
                                <td>$site</td>
                                <td>$visits</td>
                            </tr>";
            }
        }
        $table .= "</table>";
        return $table;
    }
}