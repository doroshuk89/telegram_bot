<?php

namespace App;
use GuzzleHttp\Client;

class Weather

{
    protected $token ="f701a3163873b7bc08186d0fd8933cb0";
    protected $base_url = "api.openweathermap.org/data/2.5/weather";

    public function getWeather ($lat, $lon) {
        $params = [];
        $params ['lat'] = $lat;
        $params ['lon'] = $lon;
        $params ['appid'] = $this->token;
        $url = $this->base_url."/?".http_build_query($params);

        $client = new Client([
            'base_uri' => $url
        ]);
        $result = $client->request('GET');
        return json_decode($result->getBody());
    }
}