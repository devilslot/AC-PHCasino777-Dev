<?php
if(isset($_POST)){
    require(dirname(__FILE__).'/../../class/database.php');
    $mysqli = new DB(); 
    $data = $mysqli->query("DELETE FROM `setting_wallet` WHERE `wallet_no` = '".$_POST['id']."'");
    $mysqli->close();
}
?>