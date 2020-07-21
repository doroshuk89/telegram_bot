<?php

require_once 'vendor/autoload.php';

$telegram = new \App\TelegramBot();

while (true) {
    sleep(3);
    $data = $telegram->getUpdate();
    //Проходи по всем сообщения
    foreach ($data as $message) {
        $telegram->sendMessage('HELLO',$message->message->chat->id);
    }
}

