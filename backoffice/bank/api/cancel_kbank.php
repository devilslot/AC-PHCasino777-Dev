<?php

if(isset($_POST)){
    require(dirname(__FILE__).'/../../class/database.php');
    $mysqli = new DB(); 

    $data = $mysqli->query("UPDATE `kbank_transaction_".$_POST['id']."` SET `trans_status` = 6  WHERE `trans_no` = '".$_POST['trans_no']."'");
    $mysqli->close();
    if($data){
        $status['status'] = true;
    }else{
        $status['status'] = false;
    }
    $output = json_encode($status);
    header("Content-type: text/json");
    print_r($output);
}

?>