<?php

require dirname(__FILE__) . '/../../check.php';

require dirname(__FILE__) . '/../../class/database.php';


$mysqli = new DB();

$status = 2;
$name_admin = $_SESSION['admin']['admin_user'] ;
$mysqli->query("UPDATE `slot_check_img` SET check_status = ? , check_cfm_by = ? WHERE check_filename = ?",$status,$name_admin,$_POST['chk_filename']);
//pic1
$myfiles = '/home/admin/domains/slot007.com/public_html/member/imgfreecredit/' . $_POST['chk_filename'] . ''; 
//pic2
$pic2 = str_replace(".","_2.",$_POST['chk_filename']);
$myfiles2 = '/home/admin/domains/slot007.com/public_html/member/imgfreecredit/' . $pic2 . ''; 

unlink($myfiles); 
unlink($myfiles2); 
$mysqli->query("DELETE FROM `slot_check_img` WHERE check_filename = ?",$_POST['chk_filename']);
$mysqli->close();

?>