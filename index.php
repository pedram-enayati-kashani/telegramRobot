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
    $result = file_get_contents($url.$action);
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