<?php
session_start();
require dirname(__FILE__) . '/../../check.php';
require dirname(__FILE__) . '/../../class/database.php';

$mysqli = new DB();

$count = $mysqli->query("SELECT bank_id  FROM `slot_bank_transfer` WHERE bank_status = 1 ")->fetchAll();
//print_r($count);
$status['status'] = false;
$bank_no = trim($_POST['bank_no']) -1 ;

    for($i=0;$i<count($count);$i++){
        if($i == $bank_no){
            $files = '/home/admin/domains/office007.slot007.com/public_html/withdraw/transfer/protect/scb-cookies' . $count[$i]['bank_id'];
            unlink($files); 
            $status['status'] = true;
        }
        if($bank_no == 0){
            $files = '/home/admin/domains/office007.slot007.com/public_html/withdraw/transfer/protect/scb-cookies';
            unlink($files); 
            $status['status'] = true;
        }
    }

    $mysqli->close();

$output = json_encode($status);
header("Content-type: text/json");
print_r($output);

?>
