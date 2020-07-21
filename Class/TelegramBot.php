<?php

namespace App;
use GuzzleHttp\Client;

class TelegramBot

{
    protected $token = "1244704683:AAHAgjQbXGOfLWl8ncRQEfRozadeOiDQ-nE";
    protected $api = "https://api.telegram.org/bot";
    protected $updateID;

    protected function query($method, $params = []) {
        //Запрос к Телеграм API
        $url = $this->api.$this->token."/".$method;
        //Формируем URL с учетом параметров
        if (!empty($params)) {
            $url .= "?" . http_build_query($params);
        }
            $client = new Client([
                'base_uri' => $url
            ]);

            $result = $client->request('GET');
        return json_decode($result->getBody());
    }
    public function getUpdate() {
            $response = $this->query('getUpdates',
                [
                    'offset' => $this->updateID + 1
                ]);
            if (!empty($response->result)) {
                $this->updateID = $response->result[count($response->result) - 1]->update_id;
            }
        return $response->result;
    }
    public function sendMessage($text, $chat_id) {
            $response = $this->query('sendMessage', [
                'text' => $text,
                'chat_id' => $chat_id,
            ]);
        return $response;
    }


}