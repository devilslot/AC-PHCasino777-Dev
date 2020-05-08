<?php
session_start();

//include(__DIR__ . '/../checklogin.php');

require_once '../dbmodel.php';
require_once '../function.php';

$site = include(__DIR__ . '/../config/site.php');
$pg = include(__DIR__ . '/../config/pg.php');

//include(__DIR__ . "/captcha/simple-php-captcha.php");
//require_once __DIR__ . '/captcha/simple-php-captcha.php"';
//$_SESSION['captcha'] = simple_php_captcha();

// $bank_list = $mysqli->query("SELECT * FROM m_bank ORDER BY id");
// $num_row = mysqli_num_rows($bank_list);

//print_r($bank_list);
//echo 'num_row : ' . $bank_list->num_rows;

$sql = "SELECT * FROM m_affiliate WHERE status=1 ORDER BY id";
$m_affiliate = $mysqli->query($sql);
$aff_level = $m_affiliate->num_rows;   //Affiliate level 
// echo "num_rows : $aff_level<BR><BR>";

// foreach ($m_affiliate as $rows) {
//     echo "<pre>" . json_encode($rows) . "</pre>";
//     echo "<pre>" . print_r($rows) . "</pre>";
// }

$member_no = $_SESSION['member_no'];
$errorCode = 0;
$errorMSG = "";
// echo $member_no;
// exit();

// Get data AFF level 1
$sql = "SELECT * FROM aff_branch WHERE aff_level_1='" . $member_no . "'";
// echo "Level 1 : " . $sql . "<BR><BR>";
$aff_branch_level_1 = $mysqli->query($sql);
$aff_turnover_l1 = 0;
$aff_turnover_l2 = 0;
$count_level_1 = 0;
$count_level_2 = 0;
$last_refresh = NULL;

foreach ($aff_branch_level_1 as $rows_l1) {
    $sql = "SELECT * FROM aff_branch WHERE aff_level_1='" . $rows_l1['aff_level_2'] . "'";
    // echo "Level 2 : " . $sql . "<BR><BR>";
    $last_refresh = $rows_l1['last_refresh'];
    $aff_turnover_l1 += $rows_l1['grand_total_turnover'];
    $count_level_1++;
    // Get data AFF level 2
    $aff_branch_level_2 = $mysqli->query($sql);
    foreach ($aff_branch_level_2 as $rows_l2) {
        $aff_turnover_l2 += $rows_l2['grand_total_turnover'];
        $count_level_2++;
    }
}

$comm_l1 = $aff_turnover_l1 * ($site['aff_comm_level_1'] / 100);
$comm_l2 = $aff_turnover_l2 * ($site['aff_comm_level_2'] / 100);
$total_comm = $comm_l1+$comm_l2;

$last_refresh_date = new DateTime("NOW");
$sql = "UPDATE aff_branch SET last_refresh='" . $last_refresh_date->format('Y-m-d H:i:s') . "' WHERE aff_level_1='" . $member_no . "'";

// echo $sql;
// exit();

try {
    if ($mysqli->query($sql) === TRUE) {
        $errorCode = 200;
        $errorMSG = "Update 'aff_branch' completed!!!!";
    } else {
        $errorCode = 404;
        $errorMSG = $mysqli->error;
    }
} catch (Exception $e) {
    $mysqli->rollback();
    $errorCode  = $e->getCode();
    $errorMSG = $e->getMessage();
}

echo json_encode(['level1_comm' => $comm_l1, 
                  'count_l1' => $count_level_1,
                  'level2_comm' => $comm_l2,
                  'count_l2' => $count_level_2,
                  'total_comm' => $total_comm,
                  'aff_turnover_l1' => $aff_turnover_l1,
                  'aff_turnover_l2' => $aff_turnover_l2,
                  'last_refresh' => $last_refresh,
                  'code' => $errorCode,
                  'msg' => $errorMSG
                ]);
exit();

?>
