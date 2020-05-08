<?php

session_start();
include(__DIR__ . '/../checklogin.php');

require_once '../dbmodel.php';
require_once '../function.php';

$site = include(__DIR__ . '/../config/site.php');
$pg = include(__DIR__ . '/../config/pg.php');

?>

<!DOCTYPE html>
<html>

<head>
    <?php include(__DIR__ . '/../include/head-sl66.php'); ?>

</head>

<body>
    <!-- <form role="form" id="test_form"> -->
    <button id="aff_refresh" type="submit">Refresh AFF</button><BR><BR>
    <div id="l1"></div>
    <div id="l2"></div>
    <div id="total_comm"></div>
    <!-- </form> -->


    <?php include(__DIR__ . '/../include/footer-sl66.php'); ?>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#aff_refresh').click(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "<?= $site['host'] ?>/exec/aff-calculate.php",
                    dataType: "json"
                }).done(function(data) {
                    //var nxx = numeral(data.level2).format('0,0.00');
                    $("#l1").html("<label> L1 = " + numeral(data.level1_comm).format('0,0.00') + " (" + numeral(data.aff_turnover_l1).format('0,0.00') + ")</label>");
                    $("#l2").html("<label> L2 = " + numeral(data.level2_comm).format('0,0.00') + " (" + numeral(data.aff_turnover_l2).format('0,0.00') + ")</label>");
                    $("#total_comm").html("<label> Total Comm = " + numeral(data.total_comm).format('0,0.00') + "</label>");
                    //console.log(data);
                });
            });
        });
    </script>
</body>

</html>