<?php 

function dd($value, $die = true){
    if($die == true){
        echo '<pre>';
        var_dump($value);
        die;
    }
    else{
        echo '<pre>';
        var_dump($value);
    }
}