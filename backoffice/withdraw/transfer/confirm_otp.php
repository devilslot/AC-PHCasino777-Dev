<?php
session_start();

require dirname(__FILE__) . '/../../check.php';
require_once(dirname(__FILE__).'/../../config.php');
require_once(dirname(__FILE__).'/function/simple_html_dom.php');
require_once(dirname(__FILE__).'/function/function.php');
$PATH = dirname(__FILE__) . '/';
$COOKIEFILE = $PATH . 'protect/scb-cookies'.$_SESSION['data']['bank_id'];
$response = array();
$captcha_filename = $PATH.'pinpad/pin.png';

$ch = curl_init();
require('curl_header.php');

if($_SESSION['data']['is_scb'] == false){
    $_SESSION['form']['__EVENTTARGET'] = 'ctl00$DataProcess$btConfirm';
    $url = 'https://m.scbeasy.com/online/easynet/mobile/transfers/another-bank-noProfile-confirm.aspx';
}else{
    $url = 'https://m.scbeasy.com/online/easynet/mobile/transfers/another-account-confirm-noProfile.aspx';
}
$_SESSION['form']['ctl00$DataProcess$tbOTP'] = $_POST['otp'];
$post_string = post_string($_SESSION['form']);
/*curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);*/
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
$data = curl_exec($ch);
//print_r($data);
$cur_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
if(($cur_url == 'https://m.scbeasy.com/online/easynet/mobile/transfers/another-account-success-noProfile.aspx') OR ($cur_url == 'https://m.scbeasy.com/online/easynet/mobile/transfers/another-bank-noProfile-success.aspx') OR $data==''){
    $info['success'] = true;

    if(isset($_POST['wd_id'])){
        require dirname(__FILE__) . '/../../class/database.php';
        $mysqli = new DB();
        $mysqli->query("UPDATE `slot_withdraw` SET `wd_status` = 1 , `wd_otp` = '".$_POST['otp']."' , `wd_transtime` = '".date('Y-m-d H:i:s')."' , `wd_admin` = ? WHERE `wd_id` = '".$_POST['wd_id']."'",$_SESSION['admin']['admin_user']);
        $mysqli->close();
    }/*else{
        notify('2hxo7bb9gwMsjkt7Z8ejxSjKgpyI7BgkNMSN1I2ATsS',
'วันที่ :'.date("Y-m-d H:i").'
บัญชีปลายทาง :'.$_SESSION['data']['bank_num'].'
หมายเหตุ :'.$_SESSION['data']['info'].'
จำนวนเงิน : '.$_SESSION['data']['bank_amount'].'
โดย :'.$_SESSION['admin']['admin_name']);
        $mysqli->query("INSERT INTO `sa_withdraw_extra` ( extra_bank_number, extra_bank_code, extra_amount, extra_datetime, extra_otp, extra_info, extra_admin) VALUES (?,?,?,?,?,?,?)",
        $_SESSION['data']['bank_num'],$_SESSION['data']['bank_code'],$_SESSION['data']['bank_amount'],date('Y-m-d H:i:s'),$_POST['otp'],$_SESSION['data']['info'],$_SESSION['admin']['admin_user']);
    }*/
    unset($_SESSION['form']);
    unset($_SESSION['data']);
}else{
    $info['success'] = false;
}
header('Content-Type: application/json');
print_r(json_encode($info));
?>
