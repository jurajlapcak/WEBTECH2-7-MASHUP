<?php

class WeatherForecast
{
    private $api_key = WEATHER_API_KEY;
    private $city;


    //https://openweathermap.org/current

    /**
     * WeatherForecast constructor.
     */
    public function __construct($lat, $long)
    {
        $api_url = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$long}&units=metric&lang=sk&appid={$this->api_key}";
        $weather_data = json_decode(file_get_contents($api_url));
        $this->city = $weather_data->name;
    }

    public function weatherHtml($weather_data)
    {
        if (!empty($weather_data->main)) {
            $temperature = $weather_data->main->temp;
            $weather = $weather_data->weather[0]->description;
            $icon = $weather_data->weather[0]->icon;
            $date = $weather_data->dt;
            $url = "https://openweathermap.org/img/wn/$icon@2x.png";

            return "<div class='weather-container col-sm-4 border rounded'>" .
                "<div class='date'>" . $date . "</div>" .
                "<div class='city'>" . $this->city . "</div>" .
                "<div class='temperature d-flex justify-content-center'>" . "<div class='weather-value'>".intval($temperature) . "</div>" ."<div>°C</div>" . "</div>" .
                "<div class='weather-icon'>" . "<img src='$url' alt='weather-icon'>" . "</div>" .
                "<div class='weather'> Očakávané počasie: " . "<p class='weather-value'>$weather</p>" . "</div>" .
                "</div>";

        } else {
            return "";
        }
    }

    public function getForecast($lat, $long)
    {
        $api_url = "http://api.openweathermap.org/data/2.5/forecast?lat={$lat}&lon={$long}&units=metric&lang=sk&appid={$this->api_key}";
        $weather_data = json_decode(file_get_contents($api_url));

        if (is_null($weather_data)) {
            return "";
        }

        $s = "";

        if (isset($_COOKIE["timeoffset"])) {
            date_default_timezone_set('GMT+' . intval($_COOKIE["timeoffset"]));
        } else {
            date_default_timezone_set('Europe/Bratislava');
        }
        foreach ($weather_data->list as $object) {
            $object->dt = date("d-m-Y, H:i", $object->dt);
            $s .= $this->weatherHtml($object);
        }

        return $s;
    }
}