<?php 

if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])){
    echo "Your Email is : ".$_POST['email']." and Password is : ".$_POST['password'];
}