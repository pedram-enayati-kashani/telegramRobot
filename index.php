<?php

$content = file_get_contents('php://input');
$update = json_decode($content, true);
$text = $update['message']['text'];
switch ($text) {
    case "/start":
        $sentMessage = 'به ربات من خوش آمدید';
        break;
    case "/command1":
        $sentMessage = 'شما کامند ۱ را انتخاب کردید';
        break;
    case "/command2":
        $sentMessage = 'شما کامند ۲ را انتخاب کردید';
        break;
    default:
        $sentMessage = 'هیچ پیغامی برای نمایش به شما وجود ندارد لطفا کامند درستی انتخاب نمایید';
}
$chat_id = $update['message']['chat']['id'];
$content = urlencode($content);
$result = "https://api.telegram.org/bot_______/sendmessage?chat_id=" . $chat_id . "&text=" . $sentMessage;
file_get_contents($result);
