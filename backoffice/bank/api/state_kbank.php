<?php
if(isset($_POST)){
    require(dirname(__FILE__).'/../../class/database.php');
    $mysqli = new DB(); 
    $data = $mysqli->query("UPDATE `slot_bank_kbank` SET `bank_show` = ".$_POST['state']." WHERE `bank_id` = '".$_POST['id']."'");
    $mysqli->close();
}
?>