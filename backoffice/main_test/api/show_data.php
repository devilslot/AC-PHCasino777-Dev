<?php
session_start();

require dirname(__FILE__) . '/../../check.php';

require dirname(__FILE__) . '/../../class/database.php';

require dirname(__FILE__) . '/../../function.php';

require dirname(__FILE__) . '/../../config.php';
$mysqli = new DB();
$topup = $mysqli->query("SELECT sum(topup_amount) as value,count(*) as count_today FROM slot_topup WHERE  topup_amount > 0 AND DATE(topup_datetime) LIKE ?",date('Y-m-d'))->fetchArray();
$withdraw = $mysqli->query("SELECT sum(wd_amount) as value,count(*) as count_today FROM slot_withdraw WHERE DATE(wd_datetime) LIKE ? AND wd_status = 1",date('Y-m-d'))->fetchArray();

$data['value_topup']=$topup['value'];
$data['value_withdraw']=$withdraw['value'];
$data['count_today_topup']=$topup['count_today'];
$data['count_today_withdraw']=$withdraw['count_today'];
$data['profit'] = $data['value_topup']-$data['value_withdraw'];

echo json_encode($data);

?>