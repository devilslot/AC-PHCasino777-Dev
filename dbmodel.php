<?php

//session_start();

ini_set('display_errors', 0);

ini_set('display_startup_errors', 0);

error_reporting(0);

date_default_timezone_set("Asia/Bangkok");

require_once 'function.php';

/* DB SETTING */

$dbconfig = include(__DIR__ . '/config/database.php');

$DB_Host        = $dbconfig['db_host'];
$DB_Username    = $dbconfig['db_username'];
$DB_Password    = $dbconfig['db_password'];
$DB_Name        = $dbconfig['db_database'];
$DB_Charset     = $dbconfig['db_charset'];

$mysqli = new mysqli($DB_Host, $DB_Username, $DB_Password, $DB_Name);

mysqli_set_charset($mysqli, $DB_Charset);

mysqli_options($mysqli,MYSQLI_INIT_COMMAND,"SET time_zone = 'Asia/Bangkok'" );

if ($mysqli->connect_errno) {

    printf("Connect failed: %s\n", $mysqli->connect_error);

    exit();

} else {
    //echo 'DB Connected!!!!<BR>';
}
