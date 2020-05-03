<?php
if(isset($_POST)){
    require(dirname(__FILE__).'/../../class/database.php');
    $mysqli = new DB(); 
    $data = $mysqli->query("UPDATE `slot_freecredit` SET `free_credit` = ? , free_min_credit = ? , free_money = ? ",$_POST['credit'],$_POST['min'],$_POST['money']);
    $mysqli->close();
    echo '<div class="alert alert-success" role="alert">แก้ไขเครดิตฟรีสำเร็จ</div>';
}
?>