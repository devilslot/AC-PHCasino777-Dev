<?php

require dirname(__FILE__) . '/../../class/truewallet.class.php';

session_start();

require dirname(__FILE__) . '/../../check.php';

require dirname(__FILE__) . '/../../class/database.php';



if(isset($_SESSION['truewallet'])){

    $tw = $_SESSION['truewallet'];

}

$mysqli = new DB();

$data = $tw->verifyOTP($_POST['ref'],$_POST['otp']);


if($data['code'] == 'MAS-200'){

    $mysqli->query("UPDATE `setting_wallet` SET `wallet_ref` = ? , `wallet_access` = ? ,`wallet_tracking` = ? WHERE `wallet_no` = ?",$data['data']['reference_token'],$data['data']['access_token'],$tw->mobileTracking,$_POST['id']);

    $info['success'] = true;

}else{

    $info['success'] = false;

}

$mysqli->close();

header('Content-Type: text/json');

print_r(json_encode($info));

?>