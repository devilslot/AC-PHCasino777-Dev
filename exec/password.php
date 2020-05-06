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
// Required field
if (empty($_POST['current_password'])) {
    $errorMSG = "กรุณากรอก รหัสผ่านเดิม";
} elseif (empty($_POST['new_password'])) {
    $errorMSG = "กรุณากรอก รหัสผ่านใหม่";
} elseif (empty($_POST['new_password_confirmation'])) {
    $errorMSG = "กรุณากรอก ยืนยันรหัสผ่านใหม่";
}

if (!empty($errorMSG)) {
    echo json_encode(['code' => 401, 'msg' => $errorMSG]);
    exit();
}

$current_password = $_POST['current_password'];
$new_password =  $_POST['new_password'];
$new_password_confirmation = $_POST['new_password_confirmation'];

// echo json_encode(['code' => 200, 'msg' => $_SESSION['pwd']]);
// exit();

// Valid current password
if (trim($current_password) !== trim($_SESSION['pwd'])) {
    echo json_encode(['code' => 402, 'msg' => 'รหัสผ่านเดิมไม่ถูกต้อง']);
    exit();
}

// Valid new_password == new password_confirmation
if (trim($new_password) !== trim($new_password_confirmation)) {
    echo json_encode(['code' => 402, 'msg' => 'รหัสผ่านใหม่และยืนยันรหัสผ่านใหม่ ไม่ตรงกัน']);
    exit();
}

require_once '../dbmodel.php';
require_once '../function.php';

$re = "/^(?=.*[a-z])(?=.*\\d).{8,}$/i";

if (mb_strlen($new_password, 'UTF8') < 8) {
    $errorMSG = "รหัสผ่านต้องมีไม่ต่ำกว่า 8 ตัว";
} elseif (!preg_match($re, $new_password)) {
    if (misc_parsestring($new_password) == false) {
        $errorMSG = "รหัสผ่านต้องมีอักษรภาษาอังกฤษกับตัวเลขผสมเท่านั้น";
    } else {
        $errorMSG = "รหัสผ่านต้องมีตัวเลขอยู่ด้วยอย่างน้อย 1 ตัว";
    }
}

if (!empty($errorMSG)) {
    echo json_encode(['code' => 402, 'msg' => $errorMSG]);
    exit();
}

$sql = "UPDATE members SET member_password='" . $new_password . "' WHERE member_login='" . $_SESSION['member_login'] . "'";
if ($mysqli->query($sql) === TRUE) {
    $errorCode = 200;
    $errorMSG = "เปลี่ยนรหัสผ่านสำเร็จ";
    $_SESSION['pwd'] = trim($new_password);
    //echo "\nNew record 'members' created successfully";
} else {
    $errorcode = 404;
    $errorMSG = $mysqli->error;
}

echo json_encode(['code' => $errorCode, 'msg' => $errorMSG]);
