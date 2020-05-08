<?php

session_start();
//require_once 'dbmodel.php';
require_once 'function.php';

$site = include(__DIR__ . '/config/site.php');

session_destroy();
header('refresh:0;url=' . $site['host']);
?>