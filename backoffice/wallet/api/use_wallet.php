<?php

session_start();

require dirname(__FILE__) . '/../../check.php';

require dirname(__FILE__) . '/../../class/database.php';

require dirname(__FILE__) . '/../../class/truewallet.class.php';

require dirname(__FILE__) . '/../../function.php';

require dirname(__FILE__) . '/../../config.php';



$mysqli = new DB();

$username = trim($_POST['username']);

$first_time = 0;

$data = $mysqli->query("SELECT * FROM `setting_wallet` WHERE `wallet_no` = ?", $_POST['id'])->fetchArray();

$tw = new TrueWallet($data['wallet_show'],$data['wallet_pass'],$data['wallet_access']);

$tx = ($tw->GetTransactionReport($_POST['report_id']))['data'];
//print_r($tx);
if ($tx['ref1'] != '') {

    $transfer = true;

} else {

    $transfer = false;

}



if ($transfer == true) {

    $wallet['tel'] = $tx['ref1'];

    $wallet['trans'] = $tx['section4']['column2']['cell1']['value'];

    $date_in = $tx['section4']['column1']['cell1']['value'];

    $wallet['tel'] = substr_replace($wallet['tel'], '-', 3, 0);

    $wallet['tel'] = substr_replace($wallet['tel'], '-', 7, 0);

} else {

    $wallet['tel'] = $tx['section1']['title'];

    $wallet['trans'] = $tx['section3']['column2']['cell1']['value'];

    $date_in = $tx['section3']['column1']['cell1']['value'];

}

$wallet['report_id'] = $_POST['report_id'];

$wallet['amount'] = $tx['amount'];



$date_space = explode(" ", $date_in);

$date = explode("/", $date_space[0]);

$wallet['date'] = '20' . $date['2'] . '-' . $date['1'] . '-' . $date['0'];

//print_r($wallet);    


$insert_qry = "INSERT INTO `truewallet` (Wallet_ReportID,Wallet_Date,Wallet_Amount,Wallet_Phone,Wallet_Username,Wallet_Datetime,Wallet_Transaction)

                SELECT * FROM (SELECT '" . $wallet['report_id'] . "','" . $wallet['date'] . "','" . $wallet['amount'] . "','" . $wallet['tel'] . "','" . $username . "','" . date("Y-m-d H:i:s") . "','" . $wallet['trans'] . "') as tmp

                WHERE NOT EXISTS (

                    SELECT `Wallet_ReportID` FROM `truewallet` WHERE `Wallet_ReportID` = '" . $wallet['report_id'] . "'

                ) LIMIT 1";

$insert = $mysqli->query($insert_qry);

if ($insert->affectedRows() == 1) {

    $can_use = true;

} else {

    $can_use = false;

}

$can_add = false;

$status['status'] = false;

$send['username'] = strtoupper($username);

$send['credit'] = $wallet['amount'];

if ($can_use) {
    $mysqli = new DB();

    $user = $mysqli->query("SELECT `member_level`,`member_password`,`member_aff` FROM `slot_member` WHERE `member_username` = ?", $send['username'])->fetchArray();
    //print_r($user);
    if(isset($user['member_level'])){

        if ($user['member_level'] == 0) {

            $open['username'] = $send['username'];

            $open['password'] = $user['member_password'];

            $response = curl_get($api_url . 'new/CreateUser?username=' . $open['username'] . '&password=' . $open['password']);

            $update = $mysqli->query("UPDATE `slot_member` SET `member_level` = 1 WHERE `member_username` = ? AND `member_level` = 0", $open['username']);

        }
        //-aff-23-3-2020
        if($user['member_level'] != 1 AND $user['member_aff'] != '' ){

            $credit = $send['credit'];
            $aff_credit = $credit * 0.50;
            $aff_credit = $aff_credit;
            if($aff_credit > 300){
            $aff_credit = 300;
            }$mysqli->query("UPDATE `slot_member` SET `member_point` = `member_point` + '" . $aff_credit . "' WHERE `member_username` = '" . $user['member_aff'] . "'");

            }
        //-aff-end

        $credit = json_decode(curl_get($api_url."new/TransferCredit?username=" . $send['username'] . "&amount=" . $send['credit']));
        //print_r($credit);
        if(isset($credit->Credit)){

            $status['status'] = true;

        }

    }

    if ($status['status']) {

        //$mysqli->query("INSERT INTO `slot_agent` (ag_datetime, ag_username, ag_type, ag_amount, ag_info, ag_admin) VALUES (?,?,?,?,?,?)",date('Y-m-d H:i:s'),$send['username'],'AddCredit',$send['credit'],$wallet['trans'],$_SESSION['admin']['admin_user']);

        $mysqli->query("INSERT INTO `slot_topup` (`topup_username`,`topup_type`,`topup_amount`,`topup_credit`,`topup_datetime`,`topup_bonus`,`topup_info`,`topup_ocode`) VALUES (?,?,?,?,?,?,?,?)",$send['username'],'wallet',$send['credit'],$send['credit'],date('Y-m-d H:i:s'),1,$wallet['trans'],'');
        $mysqli->query("INSERT INTO `slot_addbutton` (add_datetime,add_username,add_amount,add_info,add_admin) VALUES (?,?,?,?,?)",date('Y-m-d H:i:s'),$send['username'],$send['credit'],$wallet['trans'],$_SESSION['admin']['admin_user']);



    } else {

        $mysqli->query("DELETE FROM `truewallet` WHERE `Wallet_ReportID` = ?", $wallet['report_id']);

    }

}



$mysqli->close();

$output = json_encode($status);

header("Content-type: text/json");

print_r($output);

