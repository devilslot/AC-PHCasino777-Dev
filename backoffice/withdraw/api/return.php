<?php

session_start();

require dirname(__FILE__) . '/../../check.php';

require dirname(__FILE__) . '/../../class/database.php';

require dirname(__FILE__) . '/../../config.php';

require dirname(__FILE__) . '/../../function.php';





$mysqli = new DB();

$wd = $mysqli->query("SELECT * FROM slot_withdraw WHERE wd_id = ?", $_POST['wd_id'])->fetchArray();

$info['success'] = false;

$credit = json_decode(curl_get($api_url . "new/TransferCredit?username=" . $wd['wd_username'] . "&amount=" . $wd['wd_credit']));

if (isset($credit->Credit)) {

    $info['success'] = true;

    $mysqli->query("UPDATE `slot_withdraw` SET `wd_status` = 3  ,`wd_admin` = ? ,`wd_transtime` = ? WHERE `wd_id` = ?",$_SESSION['admin']['admin_user'],date('Y-m-d H:i:s'),$_POST['wd_id']);

}

$mysqli->close();

header('Content-Type: text/json');

print_r(json_encode($info));

