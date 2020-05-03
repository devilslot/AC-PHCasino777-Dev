<?php
if(isset($_POST)){
    require(dirname(__FILE__).'/../../class/database.php');
    $mysqli = new DB(); 
    $data = $mysqli->query("UPDATE `scb_transaction_".$_POST['id']."` SET `trans_status` = 0 WHERE `trans_status` = 4 AND DATE(`trans_datetime`) = ?",DATE('Y-m-d'));
    $mysqli->close();
}
?>