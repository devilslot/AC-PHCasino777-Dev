<?php
session_start();
//require dirname(__FILE__) . '/../../check.php';
require_once dirname(__FILE__) . '/../../config.php';
require_once dirname(__FILE__) . '/function/simple_html_dom.php';
require_once dirname(__FILE__) . '/function/function.php';
$PATH = dirname(__FILE__) . '/';
$COOKIEFILE = $PATH . 'protect/gsb-cookies'.$_SESSION['gsb']['bank_id'];

$response = array();
require dirname(__FILE__) . '/../../class/database.php';
$mysqli = new DB();

function other_bank($otp)
{
    $form_field = array();
    global $PATH, $COOKIEFILE,$_SESSION;
    $form_field = $_SESSION['gsb']['data'];
    $form_field['oneTimePassword'] = $otp;
    $form_field['event'] = 'confirm_orft';
    $post = http_build_query($form_field);
    $ch = curl_init();
    require 'curl_header.php';
    curl_setopt($ch, CURLOPT_URL, 'https://ib.gsb.or.th/retail/cashmanagement/FundTransfer.do');    
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $data = curl_exec($ch);

    preg_match_all('/<strong class="pink">([0-9]{10,18}[^<\/strong>]*)/',$data,$txid);
    if(isset($txid[1][0]))
        return true;
    else
        return false;
}
function gsb_bank($otp)
{
    $form_field = array();
    global $PATH, $COOKIEFILE,$_SESSION;
    $form_field = $_SESSION['gsb']['data'];
    $form_field['oneTimePassword'] = $otp;
    $form_field['event'] = 'confirm_3rdparty';
    $post = http_build_query($form_field);
    $ch = curl_init();
    require 'curl_header.php';
    curl_setopt($ch, CURLOPT_URL, 'https://ib.gsb.or.th/retail/cashmanagement/FundTransfer.do');    
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $data = curl_exec($ch);
    preg_match_all('/<strong class="pink">([0-9]{10,18}[^<\/strong>]*)/',$data,$txid);
    if(isset($txid[1][0]))
        return true;
    else
        return false;
}
$response = false;
if($_SESSION['gsb']['is_gsb']){
    $info['gsb'] = true;
    $response = gsb_bank($_POST['otp']);
}else{
    $info['gsb'] = false;
    $response = other_bank($_POST['otp']);
}
if($response){
    unset($_SESSION['gsb']);
    $info['success'] = true;
    $mysqli->query("UPDATE `slot_withdraw` SET `wd_status` = 1 , `wd_otp` = ? , `wd_transtime` = ? ,`wd_admin` = ?  ,`wd_bank_acc` = ? WHERE `wd_id` = ?",$_POST['otp'],date('Y-m-d H:i:s'),$_SESSION['admin']['admin_user'],'GSB-'.$_SESSION['gsb']['bank_id'],$_POST['wd_id']);
}else{
    $info['success'] = false;
}
header('Content-Type: text/json');
print_r(json_encode($info));