<?php
session_start();

require dirname(__FILE__) . '/../../check.php';

require dirname(__FILE__) . '/../../class/database.php';

require dirname(__FILE__) . '/../../function.php';

require dirname(__FILE__) . '/../../config.php';
$mysqli = new DB();
if($_GET['amount']<=5000){

    $result = $mysqli->query("SELECT * FROM `slot_return` WHERE `return_id` = ? ",1)->fetchArray();

}
elseif($_GET['amount']>5000)
{
    $result = $mysqli->query("SELECT * FROM `slot_return` WHERE `return_id` = ? ",2)->fetchArray();
}

$data['return'] = ($_GET['amount']*($result['return_percent']/100));

header("Content-type: application/json; charset=utf-8");
echo json_encode($data);
?>