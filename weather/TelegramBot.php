<?php

namespace app;

class TelegramBot
{
    private $apiUrl;
    private $botToken;

    public function __construct($botToken){
        $this->botToken = $botToken;
        $this->apiUrl = "https://api.telegram.org/bot{$this->botToken}/";
    }

    public function handleUpdate($update){
        $message = $update['message'];
        $chatId = $message['chat']['id'];
        $text = $message['text'];

        $curl = curl_init();

        $apiKey = '0e5e3bce723d478d9be95137240508';

        $url = "http://api.weatherapi.com/v1/current.json?key=$apiKey&q=$text&aqi=no";

        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        $output = curl_exec($curl);
        $data = json_decode($output,true);
        curl_close($curl);

        $this->sendMessage($chatId, round($data['current']['temp_c']));
    }

    public function sendMessage($chatId, $text)
    {
        $url = $this->apiUrl . "sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text' => $text,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}


$botToken = "7189598533:AAF4h1d-d1fMs6j1vJPb3hMs9MguHODQaaA";
$bot = new TelegramBot($botToken);

$update = json_decode(file_get_contents("php://input"), true);
$bot->handleUpdate($update);