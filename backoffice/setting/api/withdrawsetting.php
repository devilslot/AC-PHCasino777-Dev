<?php
if(isset($_POST)){
    require(dirname(__FILE__).'/../../class/database.php');
    $mysqli = new DB(); 
    $data = $mysqli->query("UPDATE setting SET setting_wd = IF(`setting_wd` = 0,1,0)");
    $mysqli->close();
    echo '<div class="alert alert-success" role="alert">แก้ไขระบบถอนเงินสำเร็จ</div>';
}
?>