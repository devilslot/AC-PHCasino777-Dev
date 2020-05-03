<?php
session_start();

require dirname(__FILE__) . '/../../check.php';
require_once(dirname(__FILE__).'/../../config.php');
require_once(dirname(__FILE__).'/function/simple_html_dom.php');
require_once(dirname(__FILE__).'/function/function.php');
$PATH = dirname(__FILE__) . '/';
$COOKIEFILE = $PATH . 'protect/scb-cookies';
$response = array();

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
$cur_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
if(($cur_url == 'https://m.scbeasy.com/online/easynet/mobile/transfers/another-account-success-noProfile.aspx') OR ($cur_url == 'https://m.scbeasy.com/online/easynet/mobile/transfers/another-bank-noProfile-success.aspx')){
    $info['success'] = true;
    unset($_SESSION['form']);
    unset($_SESSION['data']);
}else{
    $info['success'] = false;
}
header('Content-Type: application/json');
print_r(json_encode($info));
?>
