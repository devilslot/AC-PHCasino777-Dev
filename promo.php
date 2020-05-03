<?php

session_start();


require_once 'dbmodel.php';
require_once 'function.php';

$site = include(__DIR__ . '/config/site.php');
$pg = include(__DIR__ . '/config/pg.php');
include(__DIR__ . '/checklogin.php');

$promo_list = $mysqli->query("SELECT * FROM m_promo WHERE promo_status='1' ORDER BY promo_id");

?>

<!DOCTYPE html>
<html>

<head>
    <title>โปรโมชั่น</title>
    <?php
    include(__DIR__ . '/include/head.php');
    ?>
</head>

<body>
    <h3>โปรโมชั่น</h3>

    <?php
    foreach ($promo_list as $row) {
        $full_desc = $row['full_desc'];
        if (strpos($full_desc, "$1") <> false) {
            $full_desc = str_replace("$1", $row['calculate_value'], $full_desc);
        }
        if (strpos($full_desc, "$2") <> false) {
            $full_desc = str_replace("$2", $row['min'], $full_desc);
        }
        if (strpos($full_desc, "$3") <> false) {
            $full_desc = str_replace("$3", $row['max'], $full_desc);
        }
        if (strpos($full_desc, "$4") <> false) {
            $full_desc = str_replace("$4", $row['turnover_multiplier'], $full_desc);
        }

        echo '<form id="promo' . $row['promo_id'] . '">';
        echo '<input type="hidden" name="promo_id" value="' . $row['promo_id'] . '">';
        echo '-> ' . trim($full_desc);
        if (!isset($_SESSION['promo1'])) {
            echo '  >>> <button type="submit">รับสิทธิ์</button><BR>';
            //echo '  >>> <button id="getPromo' . $row['promo_id'] . '">รับสิทธิ์</button><BR>';
            //echo '  >>> <button onclick="getConfirmPromo(' . $row['promo_id'] . ',' . $_SESSION['member_no'] . ')">รับสิทธิ์</button><BR>';
        }
        echo '</form>';
    }
    ?>

    <div id="alerts"></div>

    <script src="/util/utility.js"></script>

    <?php
    $promo_list = $mysqli->query("SELECT * FROM m_promo WHERE promo_status='1' ORDER BY promo_id");
    foreach ($promo_list as $row) {
        echo '<script>' . PHP_EOL;
        echo '$("#promo' . $row['promo_id'] . '").submit(function(e) {' . PHP_EOL;
    ?>
        e.preventDefault();
        $.post('/exec/promo.php', $(this).serialize(), function(data) {
        $("#alerts").html(data)
        });
        return false;
        });
    <?php
        echo '</script>';
    }
    ?>

    <script>
        
    </script>


</body>

</html>