<?php // /exec/register.php

session_start();
$site = include(__DIR__ . '/../config/site.php');
$errorMSG = "";
$errorCode = "";
/*
400 => ข้อมูลซ้ำ
401 => ข้อมูลไม่สมบูรณ์
402 => ข้อมูลไม่ถูกต้อง
*/

if (empty($_POST['phone'])) {
    $errorMSG = "กรุณากรอก เบอร์มือถือ";
} elseif (empty($_POST['password'])) {
    $errorMSG = "กรุณากรอก รหัสผ่าน";
} elseif (empty($_POST['first_name'])) {
    $errorMSG = "กรุณากรอก ชื่อในสมุดบัญชีธนาคาร";
} elseif (empty($_POST['last_name'])) {
    $errorMSG = "กรุณากรอก นามสกุลในสมุดบัญชีธนาคาร";
} elseif (empty($_POST['bank_account'])) {
    $errorMSG = "กรุณากรอก เลขบัญชีธนาคาร";
} elseif (empty($_POST['bank_code'])) {
    $errorMSG = "กรุณาเลือก ธนาคาร";
} elseif (empty($_POST['line_id'])) {
    $errorMSG = "กรุณากรอก ไลน์ไอดี";
    //} elseif (empty($_POST['captcha'])) {
    //    echo "<script>swal.fire('ข้อมูลไม่ครบ','กรุณากรอก CAPTCHA', 'error');</script>";
} elseif (empty($_POST['source'])) {
    $errorMSG = "กรุณาเลือก รู้จักเว็บเราจากที่ไหน?";
} 

if (!empty($errorMSG)) {
    echo json_encode(['code' => 401, 'msg' => $errorMSG]);  
    exit();
}

require_once '../dbmodel.php';
require_once '../function.php';

// Check duplicated IP
$ip = getIP();

$query = "SELECT member_ip FROM members WHERE member_ip = '" . $ip . "'";
$query_result = $mysqli->query($query);

if ($query_result->num_rows > 0) {
    // Duplicated IP
    $errorMSG = "หมายเลข IP " . $ip . " ของคุณเคยสมัครไปแล้ว";
    echo json_encode(['code' => 400, 'msg' => $errorMSG]);  
    exit();
}


$member_login = uniqid(); // Generate unique member_login

$query = "SELECT count(member_login) AS member_login FROM `members` WHERE member_login = '" . $member_login . "' GROUP BY member_login";
$count_query = $mysqli->query($query)->fetch_assoc();


while ($count_query['member_login'] > 0) {
    $player_session = urlencode(uniqid());
    $count_query = $mysqli->query($query)->fetch_assoc();
}

$phone = str_check(trim($_POST['phone']));
$password = str_check(trim($_POST['password']));
$firstname = str_check(trim($_POST['first_name']));
$lastname = str_check(trim($_POST['last_name']));
$bank_code = str_check(trim($_POST['bank_code']));
$bank_account = str_check(trim($_POST['bank_account']));
$line_id = str_check(trim($_POST['line_id']));
$source = trim($_POST['source']);
$row_bank = check_bank_num($bank_account);
$row_line = check_line($line_id);
$row_phone = check_phone($phone);
$know_us_from = str_check(trim($_POST['source']));
$aff_upline = trim($_POST['aff_upline']);
$usr_aff_upline = get_member_no_aff_upline($aff_upline);

//console_log("usr_aff_upline : ". $usr_aff_upline);

// $captcha_code = trim($_POST['captcha']);
// echo 'captcha : ' . $captcha_code . PHP_EOL;
// echo 'captcha : ' . $_SESSION['captcha']['code'] . PHP_EOL;
// exit();

$register_date = date("Y-m-d H:i:s");
$re = "/^(?=.*[a-z])(?=.*\\d).{8,}$/i";

$errorCode = 402;

if (misc_parsestring($phone, '0123456789') == false || strlen($phone) != 10) {
    $errorMSG = "หมายเลขโทรศัพท์ ต้องเป็นตัวเลข 10 หลักเท่านั้น";
} elseif (!preg_match('/^[ก-๙เ]+$/', $firstname)) {
    $errorMSG = "ชื่อจริงต้องเป็นภาษาไทยเท่านั้น ห้ามมีเว้นวรรค";
} elseif (!preg_match('/^[ก-๙เ]+$/', $lastname)) {
    $errorMSG = "นามสกุลต้องเป็นภาษาไทยเท่านั้น ห้ามมีเว้นวรรค";
} elseif (mb_strlen($password, 'UTF8') < 8) {
    $errorMSG = "รหัสผ่านต้องมีไม่ต่ำกว่า 8 ตัว";
} elseif (!preg_match($re, $password)) {
    if (misc_parsestring($password) == false) {
        $errorMSG = "รหัสผ่านต้องมีอักษรภาษาอังกฤษกับตัวเลขผสมเท่านั้น";
    } else {
        $errorMSG = "รหัสผ่านต้องมีตัวเลขอยู่ด้วยอย่างน้อย 1 ตัว";
    }
} elseif (misc_parsestring($bank_account, '0123456789') == false) {
    $errorMSG = "หมายเลขบัญชี ต้องเป็นตัวเลข 10 หลักเท่านั้น";
} elseif ($row_bank > 0) {
    $errorMSG = "หมายเลขบัญชี $bank_account นี้ถูกใช้งานแล้ว";
    $errorCode = 400;
} elseif ($row_phone > 0) {
    $errorMSG = "หมายเลขโทรศัพท์: $phone นี้ถูกใช้งานแล้ว";
    $errorCode = 400;
} elseif ($row_line > 0) {
    $errorMSG = "ไลน์ไอดี: $line_id นี้ถูกใช้งานแล้ว";
    $errorCode = 400;
    //} elseif ($_SESSION['captcha']['code'] <> $captcha_code) {
    //        echo "<script>swal.fire('ข้อมูลผิด','CAPTCHA ไม่ถูกต้อง', 'error');</script>";
}

if (!empty($errorMSG)) {
    echo json_encode(['code' => $errorCode, 'msg' => $errorMSG]);
    exit();
}

// All validate value is completed then insert data to table 'members'.

$row_getuser = $mysqli->query("SELECT member_no FROM `members` ORDER BY member_no DESC LIMIT 1")->fetch_assoc();
$username = '';
$uid = 0;

if ((count($row_getuser)) > 0) {
    $u_num =  $row_getuser['member_no'];
    $uid = $u_num + 1;
} else {
    $uid = 100001;
}
//$uid += 100000;
$username = $site['site_id'] . $uid;

$level = 0;

// Insert 'members' table
$sql = "INSERT INTO members (member_username,member_password,member_firstname,member_lastname,member_phone,member_bank_account, member_bank_name, member_line, member_register_date,member_ip,member_level,member_aff_upline,member_vip_date,member_login,member_from) VALUES (";
$sql .= "'" . $username . "','" . $password . "','" . $firstname . "','" . $lastname . "','" . $phone . "','" . $bank_account . "','" . $bank_code . "','" . $line_id . "','" . $register_date . "','" . $ip . "'," . $level . ",'" . $aff_upline . "',NULL,'" . $member_login . "','" . $know_us_from . "')";

$errorCode = 200;
$mysqli->begin_transaction();

try {
    if ($mysqli->query($sql) === TRUE) {
        $errorMSG = 'Success';

        // Insert 'aff_branch' table
        if ($usr_aff_upline !== NULL && sizeof($usr_aff_upline) > 0) {
            $sql = "INSERT INTO aff_branch (aff_level_1, aff_level_2) VALUES ";
            $sql .= "('" . $usr_aff_upline . "','" . $uid . "')";

            //echo "SQL : " . $sql;
            if ($mysqli->query($sql) === TRUE) {
                $errorMSG = 'Success';
            } else {
                $errorCode = 404;
                $errorMSG = $mysqli->error;
            }
        }
    } else {
        $errorCode = 404;
        $errorMSG = $mysqli->error;
    }

} catch(Exception $e) {
    $mysqli->rollback();
    $errorCode  = $e->getCode();
    $errorMSG = $e->getMessage();
}

if ($errorCode == 200) {
    $mysqli->commit();
} else {
    $mysqli->rollback();
}

$row = $mysqli->query("SELECT * FROM members WHERE member_username = '" . $username . "'")->fetch_assoc();
$_SESSION['username'] = $row['member_username'];
$_SESSION['member_login'] = $row['member_login'];

echo json_encode(['code' => $errorCode, 'msg' => $errorMSG]);

// if (empty($errorMSG)) {
//     echo json_encode(['code' => 200, 'msg' => 'Success']);
// }
