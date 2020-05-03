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

    $trans = $mysqli->query("SELECT * FROM kbank_transaction_".$_POST['id']." WHERE trans_no = ? ",$_POST['trans_no'])->fetchArray();

    $user = $mysqli->query("SELECT `member_level`,`member_password`,`member_aff` FROM `slot_member` WHERE `member_username` = ?", $send['username'])->fetchArray();


    if(isset($user['member_level'])){

        if ($user['member_level'] == 0) {

            $open['username'] = $send['username'];

            $open['password'] = $user['member_password'];

            $response = curl_get($api_url . 'new/CreateUser?username=' . $open['username'] . '&password=' . $open['password']);

            $update = $mysqli->query("UPDATE `slot_member` SET `member_level` = 1 WHERE `member_username` = ? AND `member_level` = 0", $open['username']);

        }

        //-aff-23-3-2020
        if($user['member_level'] != 1 AND $user['member_aff'] != '' ){

            $credit = $trans['trans_amount'];
                $aff_credit = $credit * 0.50;
                $aff_credit = $aff_credit;
                if($aff_credit > 300){
                $aff_credit = 300;
                }$mysqli->query("UPDATE `slot_member` SET `member_point` = `member_point` + '" . $aff_credit . "' WHERE `member_username` = '" . $user['member_aff'] . "'");

        }
        //-aff-end



        if($user['member_level'] != 1){

            $bonus = 2;

            $bonus_credit = $trans['trans_amount']*0.2;

            if($bonus_credit > 1000)

                $bonus_credit = 1000;

        }else{

            if (($trans['trans_amount'] == 300.00) or ($trans['trans_amount'] == 500.00) or ($trans['trans_amount'] == 1000.00) or ($trans['trans_amount'] == 2000.00) or ($trans['trans_amount'] == 3000.00)) {

            $bonus = 3;

            $bonus_credit = $trans['trans_amount']*0.1;

            if($bonus_credit > 1000)

                $bonus_credit = 1000;

            }else{

                $bonus = 1;

                $bonus_credit = 0;

            }

        }

        $credit_all = $trans['trans_amount'] + $bonus_credit;

        $credit = json_decode(curl_get($api_url."new/TransferCredit?username=" . $send['username'] . "&amount=" . $credit_all));

        if(isset($credit->Credit)){

            $mysqli->query("INSERT INTO `slot_topup` (`topup_username`,`topup_type`,`topup_amount`,`topup_credit`,`topup_datetime`,`topup_bonus`,`topup_info`,`topup_ocode`) VALUES (?,?,?,?,?,?,?,?)",$send['username'],'KBANK',$trans['trans_amount'],$credit_all,date('Y-m-d H:i:s'),$bonus,$_POST['info'],'');
            $mysqli->query("UPDATE kbank_transaction_".$_POST['id']." SET trans_status = 1,trans_used_username = ? WHERE trans_no = ?",$send['username'],$_POST['trans_no']);
            $info = $trans['trans_info'].' '.$trans['trans_datetime'];
            $mysqli->query("INSERT INTO `slot_addbutton` (add_datetime,add_username,add_amount,add_info,add_admin) VALUES (?,?,?,?,?)",date('Y-m-d H:i:s'),$send['username'],$credit_all,$info,$_SESSION['admin']['admin_user']);

            $status['status'] = true;

        }

    }

    $mysqli->close();

}

$output = json_encode($status);

header("Content-type: text/json");

print_r($output);



?>

 

