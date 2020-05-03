<?php

require dirname(__FILE__) . '/../../check.php';

require dirname(__FILE__) . '/../../class/database.php';

$mysqli = new DB();

    $data = $mysqli->query("SELECT * FROM `slot_turnpoint` WHERE `turnpoint_status` = 0")->fetchAll();

foreach ($data as $result) {

    $user = $mysqli->query("SELECT `member_name`,`member_surname` FROM `slot_member` WHERE `member_username` = ?", $result['turnpoint_username'])->fetchArray();

    ?>

<tr>

    <td><?php echo $result['turnpoint_datetime']; ?></td>

    <td><a class="text-warning"

            href="/member/list?acc=<?php echo $result['turnpoint_username']; ?>"><?php echo $result['turnpoint_username']; ?></a>

    </td>

    <td><?php echo $user['member_name'] . ' ' . $user['member_surname']; ?>

    </td>

    <td><?php echo $result['turnpoint_amount']; ?></td>

    <td>

        <button class="btn btn-danger btn-sm float-right"

            onclick="cancel(<?php echo '\'' . $result['turnpoint_id'] . '\'' ?>)">

            <i class="fa fa-close"></i> ยกเลิก</button>
            

        <button class="btn btn-info btn-sm float-right" 

            onclick="success(<?php echo '\'' . $result['turnpoint_id'] . '\',\'' . $result['turnpoint_username'] . '\',\'' . $result['turnpoint_amount'] . '\''; ?>)">

            <i class="fa fa-check"></i> ยืนยัน</button>

    </td>

</tr>

<?php }

if($result['turnpoint_id'] > $_SESSION['last_turnpoint']){

    $_SESSION['last_turnpoint'] = $result['turnpoint_id'];

    echo '<script>$.playSound("http://www.noiseaddicts.com/samples_1w72b820/3724.mp3")</script>';

}



$mysqli->close();?>