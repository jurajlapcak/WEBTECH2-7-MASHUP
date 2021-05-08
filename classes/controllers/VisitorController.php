<?php
require_once(__DIR__ . "/../helpers/Database.php");
require_once(__DIR__ . "/../helpers/Country.php");
require_once(__DIR__ . "/../models/Visitor.php");
require_once(__DIR__ . "/../models/CountryFromDb.php");
require_once(__DIR__ . "/../controllers/CountryController.php");

class VisitorController
{
    private ?PDO $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }

    public function getVisitorCount()
    {
        $stm = $this->conn->prepare("SELECT COUNT(*) FROM visitors");
    }

    public function insertVisitor($country_id, $city_id, $location_id, $ip)
    {
        if (isset($_COOKIE["timeoffset"])) {
            date_default_timezone_set('GMT+' . intval($_COOKIE["timeoffset"]));
        } else {
            date_default_timezone_set('Europe/Bratislava');
        }
        $day = date("Y-m-d");
        $time = date("H:i:s");

        $time_id = $this->setTimeRange($time);

        $ip = hash("sha256", $ip);
        $stm = $this->conn->prepare("INSERT IGNORE INTO visitors (country_id, city_id, location_id, ip, day,time_id) 
                                            VALUES (:country_id,:city_id, :location_id, :ip, :day, :time_id)");

        $stm->bindParam(":country_id", $country_id, PDO::PARAM_INT);
        $stm->bindParam(":city_id", $city_id, PDO::PARAM_INT);
        $stm->bindParam(":location_id", $location_id, PDO::PARAM_INT);
        $stm->bindParam(":time_id", $time_id, PDO::PARAM_INT);
        $stm->bindParam(":ip", $ip);
        $stm->bindParam(":day", $day);

        $stm->execute();
    }

    public function getCountryIpTable()
    {
        $stm = $this->conn->prepare("SELECT country_id,count(*) as count from visitors group by country_id");
        $stm->execute();
        $results = $stm->fetchAll();
        $countryController = new CountryController();

        $imgSrc = "";
        $table = "<table class='table country-table'><thead><tr><th>Časový interval</th><th>Počet unikátnych návštev</th></tr></thead>";
        if ($results != false) {
            foreach ($results as $result) {
                $country = $countryController->getCountry(intval($result["country_id"]));
                $countryName = $country->getName();
                $code = strtolower($country->getCode());
                $visits = $result["count"];
                $countryProvider = new Country($code);
                $imgSrc = $countryProvider->getImgSrc();

                $table .= "<tr>
                                <td><img src='$imgSrc' alt='$countryName' width='50px'></td>
                                <td>$visits</td>
                            </tr>";
            }
        }
        $table .= "</table>";
        return $table;

    }

    public function getTimeStats()
    {
        $stm = $this->conn->prepare("SELECT time_ranges.type as type, time_ranges.id, count(visitors.time_id) as count
                                            FROM time_ranges
                                            LEFT JOIN visitors ON time_ranges.id=visitors.time_id
                                            GROUP BY time_ranges.type
");
        $stm->execute();
        $results = $stm->fetchAll();

        $table = "<table class='times-table'><thead><tr><th>Časový interval</th><th>Počet unikátnych návštev</th></tr></thead>";

        if ($results != false) {
            foreach ($results as $result) {
                $type = $result["type"];
                $count = $result["count"];
                $row = "<tr>
                            <td>$type</td>
                            <td>$count</td>
                        </tr>";
                $table .= $row;
            }
        }
        $table .= "</table>";
        return $table;
    }

    private function setTimeRange($time): int
    {
        $id = 0;

        $time1 = date("H:i:s", mktime(6, 0, 0));
        $time2 = date("H:i:s", mktime(15, 0, 0));
        $time3 = date("H:i:s", mktime(21, 0, 0));
        $time4 = date("H:i:s", mktime(24, 0, 0,));

        if ($time >= $time1 && $time < $time2) {
            $id = 1;
        } else if ($time >= $time2 && $time < $time3) {
            $id = 2;
        } else if ($time >= $time3 && $time < $time4) {
            $id = 3;
        } else if ($time >= $time4 && $time < $time1) {
            $id = 4;
        }
        return $id;
    }
}