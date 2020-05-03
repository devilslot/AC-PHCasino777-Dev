<?php

session_start();

require dirname(__FILE__) . '/../../check.php';

require dirname(__FILE__) . '/../../class/database.php';

require dirname(__FILE__) . '/../../function.php';

require dirname(__FILE__) . '/../../config.php';



$send['username'] = trim($_POST['username']);

$send['credit'] = trim($_POST['amount']);

if(isset($_POST['username']) AND isset($_POST['amount'])){

    $mysqli = new DB();

    $user = $mysqli->query("SELECT `member_level`,`member_password` FROM `slot_member` WHERE `member_username` = ?", $send['username'])->fetchArray();

    if(isset($user['member_level'])){

        if ($user['member_level'] == 0) {

            $open['username'] = $send['username'];

            $open['password'] = $user['member_password'];

            $response = curl_get($api_url . 'new/CreateUser?username=' . $open['username'] . '&password=' . $open['password']);

            $update = $mysqli->query("UPDATE `slot_member` SET `member_level` = 1 WHERE `member_username` = ? AND `member_level` = 0", $open['username']);

        }

        $credit = json_decode(curl_get($api_url."new/TransferCredit?username=" . $send['username'] . "&amount=" . $send['credit']));

        if(isset($credit->Credit)){

            $mysqli->query("INSERT INTO `slot_agent` (ag_datetime, ag_username, ag_type, ag_amount, ag_info, ag_admin) VALUES (?,?,?,?,?,?)",date('Y-m-d H:i:s'),$send['username'],'AddCredit',$send['credit'],$_POST['info'],$_SESSION['admin']['admin_user']);

            $mysqli->query("INSERT INTO `slot_topup` (`topup_username`,`topup_type`,`topup_amount`,`topup_credit`,`topup_datetime`,`topup_bonus`,`topup_info`,`topup_ocode`) VALUES (?,?,?,?,?,?,?,?)",$send['username'],$_POST['type'],$send['credit'],$send['credit'],date('Y-m-d H:i:s'),1,$_POST['info'],'');

            echo '<div class="alert alert-success" role="alert">ทำรายการสำเร็จ</div>';

            notify('a3nB0AMOgU7Y9UFJP9D5sfpV3FJD5aIfV4XfGQB0wvQ',
'
Username : '.$send['username'].'
Admin : '.$_SESSION['admin']['admin_user'].'
จำนวนเครดิต : '.$send['credit'].'
หมายเหตุ : '.$_POST['info']);

        }else{

            echo '<div class="alert alert-danger" role="alert">ทำรายการไม่สำเร็จ</div>';

        }

    }else{

        echo '<div class="alert alert-danger" role="alert">ไม่พบยูสเซอร์นี้ในระบบ</div>';

    }

    $mysqli->close();

}



?>

 

