<?php
require_once(__DIR__ . "/../classes/controllers/SiteVisitController.php");
require_once(__DIR__ . "/../classes/controllers/LocationController.php");

$siteVisitController = new SiteVisitController();
$siteVisitController->insertVisit("stats");

$locationController = new LocationController();
$locations = $locationController->getLocations();

$response = array();
$response["error"] = false;
$locationArray = array();
if($locations != false){
    $i = 0;
    foreach ($locations as $location){
        $locationArray[$i] = array("lat" => $location["lat"], "lng" => $location["lng"]);
        $i++;
    }

}else{
    $locationArray = false;
}

$response["location"] = $locationArray;


echo json_encode($response);