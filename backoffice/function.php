<?php
function curl_post($Url, $Post)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'POST FROM OFFICE');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $Post);
    CURL_SETOPT($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function curl_get($URL)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_USERAGENT, 'GET FROM OFFICE');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function bank_type_rename($str_bnk)
{
    if (!get_magic_quotes_gpc()) {
        $str_bnk = addslashes($str_bnk);
    }
    $str_bnk = str_replace("000", "ไทยพาณิชย์", $str_bnk);
    $str_bnk = str_replace("002", "กรุงเทพ", $str_bnk);
    $str_bnk = str_replace("004", "กสิกรไทย", $str_bnk);
    $str_bnk = str_replace("006", "กรุงไทย", $str_bnk);
    $str_bnk = str_replace("034", "ธกส.", $str_bnk);
    $str_bnk = str_replace("011", "ทหารไทย", $str_bnk);
    $str_bnk = str_replace("070", "ไอซีบีซี", $str_bnk);
    $str_bnk = str_replace("071", "ไทยเครดิต", $str_bnk);
    $str_bnk = str_replace("017", "ซิตี้แบงก์", $str_bnk);
    $str_bnk = str_replace("018", "ซูมิโตโม มิตซุย", $str_bnk);
    $str_bnk = str_replace("020", "สแตนดาร์ดชาร์เต", $str_bnk);
    $str_bnk = str_replace("022", "ซีไอเอ็มบี", $str_bnk);
    $str_bnk = str_replace("024", "ยูโอบี", $str_bnk);
    $str_bnk = str_replace("025", "กรุงศรีอยุธยา", $str_bnk);
    $str_bnk = str_replace("030", "ออมสิน", $str_bnk);
    $str_bnk = str_replace("031", "เอชเอสบีซี", $str_bnk);
    $str_bnk = str_replace("039", "มิซูโฮ", $str_bnk);
    $str_bnk = str_replace("033", "ธอส.", $str_bnk);
    $str_bnk = str_replace("073", "แลนด์แอนด์เฮ้าส", $str_bnk);
    $str_bnk = str_replace("065", "ธนชาติ", $str_bnk);
    $str_bnk = str_replace("067", "ทิสโก้", $str_bnk);
    $str_bnk = str_replace("069", "เกียรตินาคิน", $str_bnk);
    $str_bnk = str_replace("066", "อิสลาม", $str_bnk);
    return $str_bnk;
}
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
