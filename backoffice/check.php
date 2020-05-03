<?php

session_start();

if(empty($_SESSION['admin'])){

    header('Location:/office69/index');

    session_destroy();

    exit();

}

if(isset($_GET['logout'])){

    session_destroy();

    header('refresh:0');

    exit();

} 

if(isset($_GET['cancel_otp'])){

    unset($_SESSION['form']);

    unset($_SESSION['data']);

    $full = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    $link = preg_replace('/\\?.*/', '', $full);

    header('refresh:0;url='.$link);

    exit();

} 

?>