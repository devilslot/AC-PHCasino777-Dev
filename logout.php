<?php

session_start();
//require_once 'dbmodel.php';
require_once 'function.php';

$site = include(__DIR__ . '/config/site.php');
//$pg = include(__DIR__ . '/config/pg.php');
//include(__DIR__ . '/checklogin.php');

session_destroy();
header('refresh:0;url=' . $site['host']);
//exit();

?>