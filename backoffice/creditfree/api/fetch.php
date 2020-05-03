<?php

require dirname(__FILE__) . '/../../check.php';
require dirname(__FILE__) . '/../../class/database.php';


$mysqli = new DB();
$data = $mysqli->query("SELECT * FROM `slot_check_img`WHERE `check_status` = 0")->fetchAll();
foreach ($data as $result) {
    echo '<tr>';
    echo '<td>' . $result['check_no'] . '</td>';
    echo '<td>' . $result['check_username'] . '</td>';
    echo '<td>' . $result['check_date'] . '</td>';
    echo '<td><button type="button" class="btn btn-outline-success" id="' . $result['check_filename'] . '" name="' . $result['check_filename'] . '" value="' . $result['check_filename'] . '" onclick="showpic(&#39;' . $result['check_filename'] . '&#39;)">ตรวจสอบรูป</button></td>';
    echo '</tr>';
}

?>