<?php
require_once(__DIR__ . "/../classes/controllers/VisitorController.php");
require_once(__DIR__ . "/../classes/controllers/CountryController.php");
require_once(__DIR__ . "/../classes/controllers/CityController.php");
require_once(__DIR__ . "/../classes/controllers/LocationController.php");
require_once(__DIR__ . "/../classes/helpers/LocationProvider.php");
require_once(__DIR__ . "/../classes/helpers/Country.php");

$ip = $_SERVER['REMOTE_ADDR'];

$locationProvider = new LocationProvider();
$city = $locationProvider->getCity();
$country = $locationProvider->getCountry();
$location_data = $locationProvider->getLatLong();

$countryProvider = new Country($country);
$countryName = $countryProvider->getCountry();

if (trim(strlen($city)) == 0 || trim(strlen($country)) == 0 || $location_data == null) {
    echo json_encode(array("error" => true));
    die();
}

$countryController = new CountryController();
$country_id = $countryController->insertCountry($country, $countryName);

$cityController = new CityController();
$city_id = $cityController->insertCity($country_id, $city);

$locationController = new LocationController();
$location_id = $locationController->insertLocation($location_data["lat"], $location_data["long"]);

$visitorController = new VisitorController();
$visitorController->insertVisitor($country_id, $city_id, $location_id, $ip);
echo json_encode(array("error" => false));