<?php

require dirname(__FILE__) . '/../../check.php';
require dirname(__FILE__) . '/../../class/truewallet.class.php';
require dirname(__FILE__) . '/../../class/database.php';
$mysqli = new DB();
session_start();
$_SESSION['truewallet'] = [];
$id = $_POST['wallet_no'];
$data = $mysqli->query("SELECT * FROM `setting_wallet` WHERE `wallet_no` = ?",$id)->fetchArray();
$_SESSION['truewallet'] = new TrueWallet($data['wallet_phone'], $data['wallet_pass']);
$wallet = $_SESSION['truewallet']->RequestLoginOTP();
$info['ref'] = ($wallet['data']['otp_reference']);
$mysqli->close();
header('Content-Type: text/json');
print_r(json_encode($info));
?>