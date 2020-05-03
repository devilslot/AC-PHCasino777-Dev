<?php
require dirname(__FILE__) . '/../../check.php';
require dirname(__FILE__) . '/../../class/database.php';
function bank_type_rename($str_bnk)

{

    if (!get_magic_quotes_gpc()) {

        $str_bnk = addslashes($str_bnk);

    }

    $str_bnk = str_replace("ไทยพาณิชย์", "000", $str_bnk);

    $str_bnk = str_replace("กรุงเทพ", "002", $str_bnk);

    $str_bnk = str_replace("กสิกรไทย", "004", $str_bnk);

    $str_bnk = str_replace("กสิกร", "004", $str_bnk);

    $str_bnk = str_replace("กรุงไทย", "006", $str_bnk);

    $str_bnk = str_replace("ธกส.", "034", $str_bnk);

    $str_bnk = str_replace("ทหารไทย", "011", $str_bnk);

    $str_bnk = str_replace("ซีไอเอ็มบี ไทย", "022", $str_bnk);

    $str_bnk = str_replace("ยูโอบี", "024", $str_bnk);

    $str_bnk = str_replace("กรุงศรีอยุธยา", "025", $str_bnk);

    $str_bnk = str_replace("ออมสิน", "030", $str_bnk);

    $str_bnk = str_replace("แลนแอนด์เฮาส์", "073", $str_bnk);

    $str_bnk = str_replace("ธนชาต", "065", $str_bnk);

    $str_bnk = str_replace("เกียรตินาคิน", "069", $str_bnk);

    $str_bnk = str_replace("ทิสโก้", "067", $str_bnk);

    return $str_bnk;

}
$mysqli = new DB();
$data = $mysqli->query("SELECT * FROM `slot_withdraw` WHERE `wd_status` = 0")->fetchAll();
foreach ($data as $result) {
    $user = $mysqli->query("SELECT `member_name`,`member_surname`,`member_bank_number`,`member_bank_type` FROM `slot_member` WHERE `member_username` = ?", $result['wd_username'])->fetchArray();
    ?>
<tr>
    <td><?php echo $result['wd_datetime']; ?></td>
    <td><a class="text-warning"
            href="/member/list?acc=<?php echo $result['wd_username']; ?>"><?php echo $result['wd_username']; ?></a>
    </td>
    <td><?php echo $result['wd_amount']; ?></td>
    <td><?php echo $user['member_name'] . ' ' . $user['member_surname']; ?>
    </td>
    <td><?php echo $user['member_bank_number'] . ' (' . $user['member_bank_type'] . ')'; ?>
    </td>
    <td>
        <button class="btn btn-success btn-sm"
            onclick="req_otp(<?php echo '\'' . $user['member_bank_number'] . '\',\'' . bank_type_rename($user['member_bank_type']) . '\',\'' . $result['wd_amount'] . '\',\'' . $result['wd_id'] . '\'' ?>)">
            <i class="fa fa-check"></i> ขอ OTP</button>
        <button class="btn btn-warning btn-sm"
            onclick="req_gsb(<?php echo '\'' . $user['member_bank_number'] . '\',\'' . bank_type_rename($user['member_bank_type']) . '\',' . $result['wd_amount'] . ',\'' . $result['wd_id'] . '\''.',1' ?>)">
            <i class="fa fa-check"></i>GSB 1</button>
        <button class="btn btn-info btn-sm"
            onclick="return_credit(<?php echo '\'' . $result['wd_id'] . '\'' ?>)">
            <i class="fa fa-refresh"></i> คืนเครดิต</button>
        <button class="btn btn-danger btn-sm float-right"
            onclick="cancel(<?php echo '\'' . $result['wd_id'] . '\'' ?>)">
            <i class="fa fa-close"></i> ยกเลิก</button>
        <button class="btn btn-info btn-sm float-right"
            onclick="success(<?php echo '\'' . $result['wd_id'] . '\''; ?>)">
            <i class="fa fa-check"></i> ยืนยัน</button>


    </td>
</tr>
<?php }
if($result['wd_id'] > $_SESSION['last_wd']){
    $_SESSION['last_wd'] = $result['wd_id'];
    echo '<script>$.playSound("http://www.noiseaddicts.com/samples_1w72b820/3724.mp3")</script>';
}

$mysqli->close();?>