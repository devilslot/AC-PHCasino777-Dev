<?php
session_start();

require dirname(__FILE__) . '/../../check.php';

require dirname(__FILE__) . '/../../class/database.php';

require dirname(__FILE__) . '/../../function.php';

require dirname(__FILE__) . '/../../config.php';
$mysqli = new DB();
$result = $mysqli->query("SELECT * FROM `slot_bonus` WHERE `bonus_id` = '".$_GET['bonus']."'")->fetchArray();
$data['credit'] = $_GET['amount'] + ($_GET['amount']*($result['bonus_percent']/100) + $result['bonus_plus']);
$data['min_money'] = $data['credit'] * $result['bonus_turnover'];
header("Content-type: application/json; charset=utf-8");
echo json_encode($data);
?>