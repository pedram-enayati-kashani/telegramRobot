<?php 

$token = "7189598533:AAF4h1d-d1fMs6j1vJPb3hMs9MguHODQaaA";
$action = '/getUpdates';
$url = "https://api.telegram.org/bot" . $token.$action;
$result = file_get_contents($url);
echo $result;