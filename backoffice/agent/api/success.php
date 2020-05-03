<?php
session_start();
require dirname(__FILE__) . '/../../check.php';
require dirname(__FILE__) . '/../../class/database.php';
require dirname(__FILE__) . '/../../function.php';
require dirname(__FILE__) . '/../../config.php';

// print_r($_POST['turnpoint_id']);
// print_r($_POST['turnpoint_username']);
// print_r($_POST['turnpoint_amount']);
if(isset($_POST['turnpoint_id']) && ($_POST['turnpoint_username'])){
    $mysqli = new DB();
    $credit = json_decode(curl_get($api_url."new/TransferCredit?username=" . $_POST['turnpoint_username'] . "&amount=" . $_POST['turnpoint_amount']));
    $mysqli->query("UPDATE `slot_turnpoint` SET `turnpoint_status` = 1  ,`turnpoint_admin` = ? ,`turnpoint_transtime` = ? WHERE `turnpoint_id` = ?",$_SESSION['admin']['admin_user'],date('Y-m-d H:i:s'),$_POST['turnpoint_id']);
    $mysqli->close();

}

?>