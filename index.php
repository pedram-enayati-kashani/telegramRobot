<?php 

require_once 'helper.php';

function urlMethod(){
    $token = "7189598533:AAF4h1d-d1fMs6j1vJPb3hMs9MguHODQaaA";
    $url = "https://api.telegram.org/bot" . $token;
    return $url;
}

function getMessage ($value = null){
    $url = urlMethod();
    $action = '';
    if($value != null){
        $action = '/getUpdates'.$value;
    }
    else{
        $action = '/getUpdates';
    }
    $result = file_get_contents('php://input');
    $arrayJson = json_decode($result);
    return $arrayJson;
}

function sendMessage($userMsg = null){
    $arrayJson = getMessage('?offset=-1');
    $url = urlMethod();
    $chatId = $arrayJson->result[0]->message->chat->id;
    $meesageSended = $arrayJson->result[0]->message->text;
    $action = '/sendMessage';
    if($userMsg == null){
        $userMsg = 'you said : '.$meesageSended;
    }
    $result = file_get_contents($url.$action.'?chat_id='.$chatId.'&text='.$userMsg);
    return $result;
}

function command(){
    $arrayJson = getMessage('?offset=-1');
    $userMessage = $arrayJson->result[0]->message->text;
    switch($userMessage){
        case '/start':
        $sendMessage = 'به ربات من خوش آمدید';
        break;
        case '/command1':
        $sendMessage = 'شما کامند یک را انتخاب کرده اید';
        break;
        case '/command2':
        $sendMessage = 'شما کامند یک را انتخاب کرده اید';
        break;
        default:
        $sendMessage = 'شما هیچکدام از کامندهای مورد نظر را انتخال نکرده اید';

    }
    sendMessage($sendMessage);
}

command();

// webhook
// $content = file_get_contents('php://input');
// $update = json_decode($content, true);
// $text = $update['message']['text'];
// switch ($text) {
//     case "/start":
//         $sentMessage = 'به ربات من خوش آمدید';
//         break;
//     case "/command1":
//         $sentMessage = 'شما کامند ۱ را انتخاب کردید';
//         break;
//     case "/command2":
//         $sentMessage = 'شما کامند ۲ را انتخاب کردید';
//         break;
//     default:
//         $sentMessage = 'هیچ پیغامی برای نمایش به شما وجود ندارد لطفا کامند درستی انتخاب نمایید';
// }
// $chat_id = $update['message']['chat']['id'];
// $content = urlencode($content);
// $result = "https://api.telegram.org/bot_______/sendmessage?chat_id=" . $chat_id . "&text=" . $sentMessage;
// file_get_contents($result);
