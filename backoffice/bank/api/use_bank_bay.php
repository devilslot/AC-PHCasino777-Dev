<?php

session_start();

require dirname(__FILE__) . '/../../check.php';

require dirname(__FILE__) . '/../../class/database.php';

require dirname(__FILE__) . '/../../function.php';

require dirname(__FILE__) . '/../../config.php';



$send['username'] = trim($_POST['username']);

if(isset($_POST['username'])){

    $status['status'] = false;

    $mysqli = new DB();

    $trans = $mysqli->query("SELECT * FROM bay_transaction WHERE auto_id = ? ",$_POST['trans_no'])->fetchArray();

    $user = $mysqli->query("SELECT `member_level`,`member_password` FROM `slot_member` WHERE `member_username` = ?", $send['username'])->fetchArray();

    if(isset($user['member_level'])){

        if ($user['member_level'] == 0) {

            $open['username'] = $send['username'];

            $open['password'] = $user['member_password'];

            $response = curl_get($api_url . 'new/CreateUser?username=' . $open['username'] . '&password=' . $open['password']);

            $update = $mysqli->query("UPDATE `slot_member` SET `member_level` = 1 WHERE `member_username` = ? AND `member_level` = 0", $open['username']);

        }



        if($user['member_level'] != 1){

            $bonus = 3;

            $bonus_credit = $trans['auto_amount']*0.2;

            if($bonus_credit > 1000)

                $bonus_credit = 1000;

        }else{

            if (($trans['auto_amount'] == 300.00) or ($trans['auto_amount'] == 500.00) or ($trans['auto_amount'] == 1000.00) or ($trans['auto_amount'] == 2000.00) or ($trans['auto_amount'] == 3000.00)) {

            $bonus = 2;

            $bonus_credit = $trans['auto_amount']*0.1;

            if($bonus_credit > 1000)

                $bonus_credit = 1000;

            }else{

                $bonus = 1;

                $bonus_credit = 0;

            }

        }

        $credit_all = $trans['auto_amount'] + $bonus_credit;

        $credit = json_decode(curl_get($api_url."new/TransferCredit?username=" . $send['username'] . "&amount=" . $credit_all));

        if(isset($credit->Credit)){

            $mysqli->query("UPDATE `slot_member` SET `member_bonus` = '" . $bonus . "' WHERE `member_username` = ?",$send['username']);

            $mysqli->query("INSERT INTO `slot_topup` (`topup_username`,`topup_type`,`topup_amount`,`topup_credit`,`topup_datetime`,`topup_bonus`,`topup_info`,`topup_ocode`) VALUES (?,?,?,?,?,?,?,?)",$send['username'],'promptpay',$trans['auto_amount'],$credit_all,date('Y-m-d H:i:s'),$bonus,$trans['auto_bank_id'],'');

            $mysqli->query("UPDATE bay_transaction SET auto_status = 1,auto_username = ? WHERE auto_id = ?",$send['username'],$_POST['trans_no']);

            $status['status'] = true;

        }

    }

    $mysqli->close();

}

$output = json_encode($status);

header("Content-type: text/json");

print_r($output);



?>

 

