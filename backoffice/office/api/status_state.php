<?php
if(isset($_POST)){

    require(dirname(__FILE__).'/../../class/database.php');

    $mysqli = new DB(); 

    $data = $mysqli->query("UPDATE `slot_admin` SET `admin_status` = ".$_POST['state']." WHERE `admin_id` = '".$_POST['id']."'");
    
    $mysqli->close();
}
?>