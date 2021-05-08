<?php
require_once(__DIR__ . "/../classes/helpers/LocationProvider.php");
require_once(__DIR__ . "/../classes/helpers/Country.php");
require_once(__DIR__ . "/../classes/controllers/SiteVisitController.php");

$siteVisitController = new SiteVisitController();
$siteVisitController->insertVisit("location");

$locationProvider = new LocationProvider();
$ip = $locationProvider->getIp();
$location = $locationProvider->getLatLong();
$lat = $location["lat"];
$long = $location["long"];
$city = $locationProvider->getCity();
$country = $locationProvider->getCountry();

$countyProvider = new Country($country);
$nativeCountry = $countyProvider->getCountry();
$capital = $countyProvider->getCapital();


$data = array(
    "ip" => $ip,
    "lat" => $lat,
    "long" => $long,
    "city" => $city,
    "country" => $nativeCountry,
    "capital" => $capital);

$response["error"] = false;
$response["data"] = $data;

echo json_encode($response);