<?php
require_once(__DIR__ . "/../../config.php");

class LocationProvider
{
    private $ip;
    private string $api_key = IP_API_KEY;
    private array $location_data;
    private string $city;
    private string $country;
    /**
     * @return mixed
     */
    public function getIp(): mixed
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }



    /**
     * LocationProvider constructor.
     */

    public function __construct()
    {
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->location_data = array();

        $api_url = 'https://geo.ipify.org/api/v1';
        $url = "{$api_url}?apiKey={$this->api_key}&ipAddress={$this->ip}";

        $location_data = json_decode(file_get_contents($url));

        $this->location_data["lat"] = $location_data->location->lat;
        $this->location_data["long"] = $location_data->location->lng;

        if(!is_null($location_data) && isset($location_data->location->city)){
            $this->city = $location_data->location->city;
        }else{
            $this->city = "Mesto sa nedá lokalizovať";
        }

        $this->country = $location_data->location->country;
    }

    //https://geo.ipify.org/code-samples
    public function getLatLong(): ?array
    {
        if (!isset($this->location_data["lat"])) {
            return null;
        }
        if (!isset($this->location_data["long"])) {
            return null;
        }

        return $this->location_data;
    }
}