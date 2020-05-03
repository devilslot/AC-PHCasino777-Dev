<?php

    session_start();

    require dirname(__FILE__) . '/../../check.php';

    require dirname(__FILE__) . '/../../class/database.php';

    require dirname(__FILE__) . '/../../function.php';

    require dirname(__FILE__) . '/../../config.php';



    //$mysqli = new DB();

    //$mysqli->query("UPDATE `slot_check_img` SET `check_status` = 2 WHERE `check_filename` = ?",$_POST['chk_filename']);

    $name_admin = $_SESSION['admin']['admin_user'] ;

    $mysqli = new DB();

    $mychk = $mysqli->query("SELECT * FROM `slot_check_img` WHERE `check_filename` = ?",$_POST['chk_filename'])->fetchArray();

    $send['username'] = $mychk['check_username'];  

    $user = $mysqli->query("SELECT `member_level`,`member_password` FROM `slot_member` WHERE `member_username` = ?", $send['username'])->fetchArray();

    $free = $mysqli->query("SELECT * FROM slot_freecredit")->fetchArray();

    if(isset($user['member_level'])){

        if ($user['member_level'] == 0) {

            $open['username'] = $send['username'];

            $open['password'] = $user['member_password'];

            $free = $mysqli->query("SELECT free_credit FROM slot_freecredit ")->fetchArray();

            $response = curl_get($api_url . 'new/CreateUser?username=' . $open['username'] . '&password=' . $open['password']);

            $credit = json_decode(curl_get($api_url."new/TransferCredit?username=" . $send['username'] . "&amount=" . $free['free_credit']));

            $myfiles = '/home/admin/domains/slot007.com/public_html/member/imgfreecredit/' . $_POST['chk_filename'] . ''; 

            unlink($myfiles);
            
            $pic2 = str_replace(".","_2.",$_POST['chk_filename']);
            $myfiles2 = '/home/admin/domains/slot007.com/public_html/member/imgfreecredit/' . $pic2 . ''; 

            unlink($myfiles2); 

            if (isset($credit->Credit)){

                $status = 1;
                $mysqli->query("UPDATE `slot_member` SET `member_level` = 2 WHERE `member_username` = ? AND `member_level` = 0", $send['username']);
                
                $mysqli->query("INSERT `slot_topup` (`topup_username`,`topup_ocode`,`topup_type`,`topup_amount`,`topup_credit`,`topup_datetime`,`topup_bonus`,`topup_info`) VALUES ('" . $send['username'] . "','','free','0','".$free['free_credit']."','" . date('Y-m-d H:i:s') . "','0','เครดิตฟรี')");

                echo '<div class="alert alert-success" role="alert">เปิดเครดิตฟรีสำเร็จ</div>';

            }else{
                $status = 3;
                echo '<div class="alert alert-danger" role="alert">เปิดเครดิตฟรีไม่สำเร็จ</div>';

            }
             
            $mysqli->query("UPDATE `slot_check_img` SET check_status = ? , check_cfm_by = ? WHERE check_filename = ?",$status,$name_admin,$_POST['chk_filename']);


        }else{

            echo '<div class="alert alert-danger" role="alert">ยูสเซอร์นี้เคยเติมเงินหรือรับเครดิตฟรีไปแล้ว</div>';

        }

    }else{

        echo '<div class="alert alert-danger" role="alert">ไม่พบยูสเซอร์นี้ในระบบ</div>';

    }



    



    $mysqli->close();







?>