<?php
if(isset($_POST)){
    require(dirname(__FILE__).'/../../../class/database.php');
    $mysqli = new DB(); 
    $data = $mysqli->query("DELETE FROM `slot_bank_transfer` WHERE `bank_id` = '".$_POST['id']."'");
    $mysqli->close();
}
?>