<?php
function notify($token, $message)
{
    $lineapi = $token;
    $mms = trim($message);
    date_default_timezone_set("Asia/Bangkok");
    $chOne = curl_init();
    curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    // SSL USE
    curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
    //POST
    curl_setopt($chOne, CURLOPT_POST, 1);
    curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=$mms");
    curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $lineapi . '');
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($chOne);
    curl_close($chOne);
}

require dirname(__FILE__) . '/class/database.php';
require dirname(__FILE__) . '/class/truewallet.class.php';
$mysqli = new DB();
$data = $mysqli->query("SELECT * FROM `setting_wallet` WHERE `wallet_status` = 1")->fetchAll();
foreach($data as $data){
    $tw = new TrueWallet($data['wallet_show'], $data['wallet_pass'], $data['wallet_ref'], $data['wallet_tracking']);
    $tw->Login();
    $profile = $tw->GetProfile();
    $balance = $profile['data']['currentBalance'];
    if($balance >= 30000){
        $balance = number_format($balance,2);
        notify('pbWRZsRmTyDrjP9DplzDD2ITi6xx1UjFk1r8N7gM0bo',' 
         
เบอร์ : '.$data['wallet_show'].'
ยอดเงินปัจจุบัน : '.$balance.'
เกิน 30000 บาทแล้วกรุณาถอนเงินด้วยค่ะ');
    }

    $phone = $profile['data']['mobileNumber'];
    $data = $tw->getTransaction(150);
    foreach($data['data']['activities'] as $data){
        if($data['amount'] < 0){
            $date_space = explode(" ", $data['date_time']);
            $date = explode("/", $date_space[0]);
            $data['date'] = '20' . $date['2'] . '-' . $date['1'] . '-' . $date['0'];
            $data['date_time'] = $data['date'].' '.$date_space[1];
            $amt = str_replace(',','',$data['amount']);
            $mysqli->query("INSERT IGNORE INTO wallet_tnx_out VALUES (?,?,?,?,?,?)",$data['report_id'],$phone,$data['date_time'],$amt,$data['type'],$data['sub_title'].' '.$data['original_type'].' '.$data['original_action']);
        }
    }
}
?>