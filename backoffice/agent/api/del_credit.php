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
            echo '<div class="alert alert-danger" role="alert">ยูสเซอร์นี้ยังไม่เคยเปิด</div>';
            exit();
        }
        $credit = json_decode(curl_get($api_url."new/TransferCredit?username=" . $send['username'] . "&amount=-" . $send['credit']));
        if(isset($credit->Credit)){
            $mysqli->query("INSERT INTO `slot_agent` (ag_datetime, ag_username, ag_type, ag_amount, ag_info, ag_admin) VALUES (?,?,?,?,?,?)",date('Y-m-d H:i:s'),$send['username'],'removeCredit',$send['credit'],$_POST['info'],$_SESSION['admin']['admin_user']);
            echo '<div class="alert alert-success" role="alert">ทำรายการสำเร็จ</div>';
        }else{
            echo '<div class="alert alert-danger" role="alert">ทำรายการไม่สำเร็จ</div>';
        }
    }else{
        echo '<div class="alert alert-danger" role="alert">ไม่พบยูสเซอร์นี้ในระบบ</div>';
    }
    $mysqli->close();
}

?>
 
