<?php
require_once(__DIR__ . "/../classes/helpers/LocationProvider.php");
require_once(__DIR__ . "/../classes/helpers/WeatherForecast.php");
require_once(__DIR__ . "/../classes/controllers/SiteVisitController.php");

$siteVisitController = new SiteVisitController();
$siteVisitController->insertVisit("index");

if(isset($_GET["timeoffset"])){
    $locationProvider = new LocationProvider();
    $location_vector = $locationProvider->getLatLong();
    $country = $locationProvider->getCountry();
    if (is_null($location_vector)) {
        die();
    }

    $weatherForecast = new WeatherForecast($location_vector["lat"], $location_vector["long"]);

    $response = array("error" => false);
    $response["data"] = ($weatherForecast->getForecast($location_vector["lat"], $location_vector["long"]));

}else{
    $response = array("error" => true);
}

echo json_encode($response);