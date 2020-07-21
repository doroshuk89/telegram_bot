<?php

require_once 'vendor/autoload.php';

$telegram = new \App\TelegramBot();
$weather  = new \App\Weather();

while (true) {
    sleep(3);
    $data = $telegram->getUpdate();
    //Проходи по всем сообщения
    foreach ($data as $message) {
        if (isset($message->message->chat->id) && ($message->message->chat->id > 0)) {
            if (isset($message->message->location)) {
                //Получаем погоду для локации
                $result = $weather->getWeather($message->message->location->latitude, $message->message->location->longitude);

               $telegram->sendMessage(json_encode($result), $message->message->chat->id);
            } else {
                $telegram->sendMessage('Пожалуйста укажите свою локацию', $message->message->chat->id);
            }
        }
    }
}

