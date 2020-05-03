<?php
session_start();
$_SESSION['form'] = array();
require dirname(__FILE__) . '/../../check.php';
require_once dirname(__FILE__) . '/../../config.php';
require_once dirname(__FILE__) . '/function/simple_html_dom.php';
require_once dirname(__FILE__) . '/function/function.php';
$PATH = dirname(__FILE__) . '/';
$COOKIEFILE = $PATH . 'protect/scb-cookies';

$response = array();

require dirname(__FILE__) . '/../../class/database.php';
$mysqli = new DB();
$bank_from = $mysqli->query("SELECT * FROM slot_bank WHERE bank_id = ?",$_POST['from'])->fetchArray();
$bank_to = $mysqli->query("SELECT * FROM slot_bank_transfer WHERE bank_id = ?",$_POST['to'])->fetchArray();
function login (){
    global $PATH,$COOKIEFILE,$bank_from;
    $ch = curl_init();
    require('curl_header.php');
    // grab login
    curl_setopt($ch, CURLOPT_URL, 'https://m.scbeasy.com/online/easynet/mobile/login.aspx');
    curl_setopt($ch, CURLOPT_POST, false);
    $data = curl_exec($ch);
    $html = str_get_html($data);
    $form_field = array();
    foreach ($html->find('form input') as $element) {
        $form_field[$element->name] = $element->value;
    }
    $form_field['tbUsername'] = $bank_from['bank_username'];
    $form_field['tbPassword'] = $bank_from['bank_password'];

    $post_string = '';
    foreach ($form_field as $key => $value) {
        $post_string .= $key . '=' . urlencode($value) . '&';
    }
    $post_string = substr($post_string, 0, -1);
    //start login
    curl_setopt($ch, CURLOPT_URL, 'https://m.scbeasy.com/online/easynet/mobile/login.aspx');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
    $data = curl_exec($ch);
    return ($data);
}
login();
$ch = curl_init();
require('curl_header.php');

if ($bank_to['bank_type'] == 000) {
    //grab transfer scb
    curl_setopt($ch, CURLOPT_URL, 'https://m.scbeasy.com/online/easynet/mobile/transfers/another-account-noProfile.aspx');
    curl_setopt($ch, CURLOPT_POST, false);
    $data = curl_exec($ch);
    $html = str_get_html($data);
    $form_field = array();
    foreach ($html->find('form input') as $element) {
        $form_field[$element->name] = $element->value;
    }
    $form_field['ctl00$DataProcess$ddlFromAcc'] = 'SA' . $bank_from['bank_number'];
    $form_field['ctl00$DataProcess$tbToAcc'] = $bank_to['bank_number'];
    $form_field['ctl00$DataProcess$tbAmount'] = $_POST['amount'];
    $form_field['ctl00$DataProcess$ddlMobile'] = $bank_from['bank_phone'];

    $post_string = post_string($form_field);

    //start transfer
    curl_setopt($ch, CURLOPT_URL, 'https://m.scbeasy.com/online/easynet/mobile/transfers/another-account-noProfile.aspx');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
    $data = curl_exec($ch);
    preg_match("'<span id=\"DataProcess_lbOTPRefNo\" class=\"bd_th_rd_11\">(.*?)</p>'si", $data, $match);
    $_SESSION['data']['is_scb'] = true;
} else {
    //grab transfer other
    curl_setopt($ch, CURLOPT_URL, 'https://m.scbeasy.com/online/easynet/mobile/transfers/another-bank-noProfile.aspx');
    curl_setopt($ch, CURLOPT_POST, false);
    $data = curl_exec($ch);
    $html = str_get_html($data);
    $form_field = array();
    foreach ($html->find('form input') as $element) {
        $form_field[$element->name] = $element->value;
    }
    $form_field['ctl00$DataProcess$ddlFromAcc'] = $html->find('form option[selected]',0)->value;
    $form_field['ctl00$DataProcess$ddlMobile'] = $bank_from['bank_phone'];
    $form_field['ctl00$DataProcess$ddlBank'] = $bank_to['bank_type'];
    $form_field['ctl00$DataProcess$tbAmt'] = $_POST['amount'];
    $form_field['ctl00$DataProcess$tbToAcc'] = $bank_to['bank_number'];
    $post_string = post_string($form_field);
    //print_r($form_field);
    //start transfer
    curl_setopt($ch, CURLOPT_URL, 'https://m.scbeasy.com/online/easynet/mobile/transfers/another-bank-noProfile.aspx');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
    $data = curl_exec($ch);
    preg_match("'<span id=\"DataProcess_lbOTPRefNo\">(.*?)</p>'si", $data, $match);
    $_SESSION['data']['is_scb'] = false;
}

if ($match) {
    $html = str_get_html($data);
    $_SESSION['form'] = array();
    foreach ($html->find('form input') as $element) {
        $_SESSION['form'][$element->name] = $element->value;
    }
    $_SESSION['form']['__EVENTTARGET'] = 'ctl00$DataProcess$btConfirm';
    unset($_SESSION['form']['ctl00$DataProcess$btConfirm']);
    unset($_SESSION['form']['ctl00$DataProcess$btCancel']);
    $info['success'] = true;
    $info['ref'] = substr($match[1], 0, 4);
    $_SESSION['data']['bank_num'] = $bank_to['bank_number'];
    $_SESSION['data']['bank_code'] = $bank_to['bank_type'];
    $_SESSION['data']['bank_amount'] = $_POST['amount'];

    $_SESSION['data']['ref'] = $info['ref'];
} else {
    $info['success'] = false;
}
header('Content-Type: text/json');
print_r(json_encode($info));
