<?php

require dirname(__FILE__) . '/../../check.php';
require dirname(__FILE__) . '/../../class/truewallet.class.php';
require dirname(__FILE__) . '/../../class/database.php';
$mysqli = new DB();
$_SESSION['truewallet'] = [];
$id = $_POST['wallet_no'];
$data = $mysqli->query("SELECT * FROM `setting_wallet` WHERE `wallet_no` = ?",$id)->fetchArray();
$_SESSION['truewallet'] = new TrueWallet($data['wallet_show'], $data['wallet_pass']);
$wallet = $_SESSION['truewallet']->requestOTP();
$mysqli->close();
header('Content-Type: text/json');
?>