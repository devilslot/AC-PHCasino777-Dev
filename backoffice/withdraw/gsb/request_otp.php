<?php
session_start();
//require dirname(__FILE__) . '/../../check.php';
require_once dirname(__FILE__) . '/../../config.php';
require_once dirname(__FILE__) . '/function/simple_html_dom.php';
require_once dirname(__FILE__) . '/function/function.php';
$PATH = dirname(__FILE__) . '/';
$COOKIEFILE = $PATH . 'protect/gsb-cookies'.$_POST['bank_id'];

$response = array();
require dirname(__FILE__) . '/../../class/database.php';
$mysqli = new DB();
$bank = $mysqli->query("SELECT * FROM slot_bank_transfer_gsb WHERE bank_id = ?",$_POST['bank_id'])->fetchArray();
unset($_SESSION['gsb']);

if($_POST['bank_type'] == '000'){
    $_POST['bank_type'] = '014';
}

function login()
{
    global $PATH, $COOKIEFILE, $bank;
    $ch = curl_init();
    require 'curl_header.php';
    //start login
    curl_setopt($ch, CURLOPT_URL, 'https://ib.gsb.or.th/retail/security/commonLogin.jsp');
    curl_setopt($ch, CURLOPT_POST, false);
    $data = curl_exec($ch);
    $html = str_get_html($data);
    $form_field = array();
    foreach ($html->find('form input') as $element) {
        $form_field[$element->name] = $element->value;
    }
    $form_field['userLoginId'] = $bank['bank_username'];
    $form_field['companyLoginId'] = $bank['bank_username'];
    $form_field['password'] = $bank['bank_password'];
    curl_setopt($ch, CURLOPT_URL, 'https://ib.gsb.or.th/retail/security/Welcome.do');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $form_field);
    $data = curl_exec($ch);
    return true;
}
function check()
{
    global $PATH, $COOKIEFILE, $bank;
    $ch = curl_init();
    require 'curl_header.php';
    curl_setopt($ch, CURLOPT_URL, 'https://ib.gsb.or.th/retail/cashmanagement/AccountSummary.do?fromMenu=true&event=viewSA');
    curl_setopt($ch, CURLOPT_POST, false);
    $data = curl_exec($ch);
    $cur_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    if (stripos($data, "commonLogin.jsp") !== false) {
        return false;
    } else {
        return true;
    }
}
function other_bank()
{
    global $PATH, $COOKIEFILE, $bank;
    $ch = curl_init();
    require 'curl_header.php';
    //start login
    curl_setopt($ch, CURLOPT_URL, 'https://ib.gsb.or.th/retail/cashmanagement/FundTransfer.do?event=prepare_orft&frommenu=true');
    curl_setopt($ch, CURLOPT_POST, false);
    $data = curl_exec($ch);
    //print_r($data);
    //exit;
    $html = str_get_html($data);
    $form_field['fromAccountId'] = $bank['bank_num_code'];
    $form_field['transferChannel'] = 'ACTUAL';
    $form_field['toBankCode'] = $_POST['bank_type'];
    $form_field['toActualAccount'] = $_POST['bank_num'];
    $form_field['transferAmount'] = $_POST['amount'];
    /*$form_field['toBankCode'] = '004';
    $form_field['toActualAccount'] = '0198059625';
    $form_field['transferAmount'] = '10';*/
    $form_field['transferMode'] = 'I';
    $form_field['description'] = '';
    $form_field['accept'] = 'on';
    $form_field['event'] = 'create_orft';
    $form_field['smsnoti'] = '';
    $form_field['recipientSmsNoti'] = '';
    $form_field['recipientEmailNoti'] = '';
    $form_field['acceptnc'] = 'on';
    $form_field['currency'] = 'THB';
    $form_field['toAccountType'] = 'R';
    //print_r($data);
    //exit;
    curl_setopt($ch, CURLOPT_URL, 'https://ib.gsb.or.th/retail/cashmanagement/FundTransfer.do');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $form_field);
    $data = curl_exec($ch);
    print_r($data);
    exit;
    $html = str_get_html($data); 
    $info = array();
    foreach ($html->find('form input') as $element) {
        $info[$element->name] = $element->value;
    }
    $info['currentSidParam'] = $info[0];
    unset($info[0]);
    unset($info['submitform']);
    unset($info['previous']);
    //print_r($info);
    //preg_match_all('/<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">([^<\/div>]*)/', $data, $otp);
    //$info['ref'] = $otp[1][0];
    return $info;
}
function gsb_bank()
{
    global $PATH, $COOKIEFILE, $bank;
    $ch = curl_init();
    require 'curl_header.php';
    //start login
    curl_setopt($ch, CURLOPT_URL, 'https://ib.gsb.or.th/retail/cashmanagement/FundTransfer.do');
    curl_setopt($ch, CURLOPT_POST, false);
    $data = curl_exec($ch);
    $html = str_get_html($data);
    $form_field['fromAccountId'] = $bank['bank_num_code'];
    $form_field['toAccountId'] = '';
    $form_field['toAccountType'] = 'U';
    $form_field['toUnregisteredAcctNo'] = $_POST['bank_num'];
    $form_field['transferAmount'] = $_POST['amount'];
    $form_field['transferMode'] = 'I';
    $form_field['accept'] = 'on';
    $form_field['event'] = 'create_3rdparty';
    $form_field['smsnoti'] = '';
    $form_field['recipientSmsNoti'] = '';
    $form_field['recipientEmailNoti'] = '';
    $form_field['acceptnc'] = 'on';
    $form_field['currency'] = 'THB';
    $form_field['suspectAccount'] = 'N';
    $form_field['suspectAccountCode'] = '';
    $form_field['suspectAccountDesc'] = '';
    $form_field['oneTimeTransferDate'] = '';
    $form_field['recurFromDate'] = '';
    $form_field['recurToDate'] = '';
    $form_field['recurTimes'] = '1';

    curl_setopt($ch, CURLOPT_URL, 'https://ib.gsb.or.th/retail/cashmanagement/FundTransfer.do');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $form_field);
    $data = curl_exec($ch);
    $html = str_get_html($data);
    $info = array();
    foreach ($html->find('form input') as $element) {
        $info[$element->name] = $element->value;
    }
    $info['currentSidParam'] = $info[0];
    unset($info[0]);
    unset($info['submitform']);
    unset($info['previous']);
    unset($info['cancelFlag']);
    //preg_match_all('/<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">([^<\/div>]*)/', $data, $otp);
    //$info['ref'] = $otp[1][0];
    return $info;
}
if (!check()) {
    login();
}
if ($_POST['bank_type'] == '030') {
    $_SESSION['gsb']['data'] = gsb_bank();
    $_SESSION['gsb']['is_gsb'] = true;
} else {
    $_SESSION['gsb']['data'] = other_bank();
    $_SESSION['gsb']['is_gsb'] = false;
}
$_SESSION['gsb']['bank_id'] = $_POST['bank_id'];
if(isset($_SESSION['gsb']['data']['referenceNo'])){
    $info = $_SESSION['gsb']['data'];
    $info['success'] = true;
}else{
    $info['success'] = false;
}  
header('Content-Type: text/json');
print_r(json_encode($info));