<?php
session_start();
require dirname(__FILE__) . '/../../check.php';
require dirname(__FILE__) . '/../../class/database.php';

$mysqli = new DB();
$mysqli->query("UPDATE `slot_withdraw` SET `wd_status` = 1  ,`wd_admin` = ? ,`wd_transtime` = ? WHERE `wd_id` = ?",$_SESSION['admin']['admin_user'],date('Y-m-d H:i:s'),$_POST['wd_id']);
$mysqli->close();
?>