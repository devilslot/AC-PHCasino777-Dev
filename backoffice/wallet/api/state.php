<?php

if(isset($_POST)){

    require(dirname(__FILE__).'/../../class/database.php');

    $mysqli = new DB(); 

    $data = $mysqli->query("UPDATE `setting_wallet` SET `wallet_status` = ".$_POST['state']." WHERE `wallet_no` = '".$_POST['id']."'");

    $mysqli->close();

}

?>