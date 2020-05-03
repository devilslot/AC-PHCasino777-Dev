<?php
session_start();
require dirname(__FILE__) . '/../../check.php';
require dirname(__FILE__) . '/../../class/database.php';

$mysqli = new DB();
$mysqli->query("UPDATE `slot_turnpoint` SET `turnpoint_status` = 2  ,`turnpoint_admin` = ? ,`turnpoint_transtime` = ? WHERE `turnpoint_id` = ?",$_SESSION['admin']['admin_user'],date('Y-m-d H:i:s'),$_POST['wd_id']);
$mysqli->close();
?>