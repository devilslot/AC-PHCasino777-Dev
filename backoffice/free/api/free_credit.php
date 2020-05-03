<?php

session_start();

require dirname(__FILE__) . '/../../check.php';

require dirname(__FILE__) . '/../../class/database.php';

require dirname(__FILE__) . '/../../function.php';

require dirname(__FILE__) . '/../../config.php';



$send['username'] = trim($_POST['username']);

if(isset($_POST['username'])){

    $mysqli = new DB();

    $user = $mysqli->query("SELECT `member_level`,`member_password` FROM `slot_member` WHERE `member_username` = ?", $send['username'])->fetchArray();

    if(isset($user['member_level'])){

        if ($user['member_level'] == 0) {

            $open['username'] = $send['username'];

            $open['password'] = $user['member_password'];

            $free = $mysqli->query("SELECT free_credit FROM slot_freecredit ")->fetchArray();

            $response = curl_get($api_url . 'new/CreateUser?username=' . $open['username'] . '&password=' . $open['password']);

            //echo $api_url . 'new/CreateUser?username=' . $open['username'] . '&password=' . $open['password'];

            $credit = json_decode(curl_get($api_url."new/TransferCredit?username=" . $send['username'] . "&amount=" . $free['free_credit']));

            //echo $api_url."new/TransferCredit?username=" . $send['username'] . "&amount=" . $free['free_credit'];

            if (isset($credit->Credit)){

                $mysqli->query("UPDATE `slot_member` SET `member_level` = 2 WHERE `member_username` = ? AND `member_level` = 0", $send['username']);

                echo '<div class="alert alert-success" role="alert">เปิดเครดิตฟรีสำเร็จ</div>';

            }else{

                echo '<div class="alert alert-danger" role="alert">เปิดเครดิตฟรีไม่สำเร็จ</div>';

            }

        }else{

            echo '<div class="alert alert-danger" role="alert">ยูสเซอร์นี้เคยเติมเงินหรือรับเครดิตฟรีไปแล้ว</div>';

        }

    }else{

        echo '<div class="alert alert-danger" role="alert">ไม่พบยูสเซอร์นี้ในระบบ</div>';

    }

    $mysqli->close();

}



?>

 

