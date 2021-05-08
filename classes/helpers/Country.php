<?php
class Country
{
    private $country_data;


    /**
     * CountryFromDb constructor.
     */
    public function __construct($country)
    {
        $url = "https://restcountries.eu/rest/v2/alpha/$country";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        $this->country_data = json_decode(curl_exec($curl));
        curl_close($curl);
    }

    public function getCountry(){
        if(is_null($this->country_data) || !isset($this->country_data->nativeName)){
            return "Štát sa nedá lokalizovať";
        }

        return $this->country_data->nativeName;
    }

    public function getCapital(){
        if(is_null($this->country_data) || !isset($this->country_data->capital)){
            return "Hlavné mesto sa nedá lokalizovať";
        }

        return $this->country_data->capital;
    }

    public function getImgSrc(){
        if(is_null($this->country_data) || !isset($this->country_data->flag)){
            return "";
        }

        return $this->country_data->flag;
    }
}