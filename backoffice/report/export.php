<?php
require dirname(__FILE__) . '/../class/database.php';
$mysqli = new DB();
$start_date = $_POST['start'];
$end_date = $_POST['end'];
//query
if(isset($_POST['vip'])){
    $data = $mysqli->query("SELECT member_username,member_name,member_surname,member_phone,member_register_date,member_line FROM slot_member WHERE member_level = 1 AND member_register_date between ? AND ?",$start_date,$end_date)->fetchAll();
    $filename = $_POST['vip'];
}
elseif(isset($_POST['normal'])){
    $data = $mysqli->query("SELECT member_username,member_name,member_surname,member_phone,member_register_date,member_line FROM slot_member WHERE member_level = 0 AND member_register_date between ? AND ?",$start_date,$end_date)->fetchAll();
    $filename = $_POST['normal'];
}
elseif(isset($_POST['free'])){
    $data = $mysqli->query("SELECT member_username,member_name,member_surname,member_phone,member_register_date,member_line FROM slot_member WHERE member_level = 2 AND member_register_date between ? AND ?",$start_date,$end_date)->fetchAll();
    $filename = $_POST['free'];
}
elseif(isset($_POST['topup'])){
    $data = $mysqli->query("SELECT member_username,member_name,member_surname,member_phone,member_register_date,member_line FROM slot_member WHERE member_username IN (SELECT DISTINCT(topup_username) from slot_topup WHERE topup_datetime Between ? AND ?)",$start_date,$end_date)->fetchAll();
    $filename = $_POST['topup'];
}

$f = fopen('php://temp', 'wt');
fprintf($f, chr(0xEF).chr(0xBB).chr(0xBF));
$first = true;
//  $data = array_map("utf8_decode", $data);
foreach ($data as $row) {
    if ($first) {
        fputcsv($f, array_keys($row));
        $first = false;
    }
    fputcsv($f, $row);
} // end while

$size = ftell($f);
rewind($f);

header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Length: $size");
// Output to browser with appropriate mime type, you choose ;)
header("Content-type: text/x-csv; charset=utf-8");
header("Content-type: text/csv; charset=utf-8");
header("Content-type: application/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=$filename.csv");
fpassthru($f);
exit;
