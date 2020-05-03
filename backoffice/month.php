<?php 

    require(dirname(__FILE__).'/check.php');

?>

<!doctype html>

<html lang="en" dir="ltr">



<head>

    <?php 

    require(dirname(__FILE__).'/template/head.php');

?>



    <!-- Custom scroll bar css-->

    <link href="assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />





    <!-- Sidebar Accordions css -->

    <link href="assets/plugins/accordion1/css/dark-easy-responsive-tabs.css" rel="stylesheet">



<body class="app sidebar-mini rtl">







    <div class="page">

        <div class="page-main">

            <?php 

                require(dirname(__FILE__).'/template/menuside.php');

                require(dirname(__FILE__).'/class/database.php');

            ?>

            <!-- app-content-->

            <div class="container content-area">

                <div class="side-app">



                    <!-- page-header -->

                    <div class="page-header">

                        <ol class="breadcrumb">

                            <!-- breadcrumb -->

                            <li class="breadcrumb-item">Home</li>

                            <li class="breadcrumb-item active" aria-current="page">Summary (Month)</li>

                        </ol><!-- End breadcrumb -->

                    </div>

                    <!-- End page-header -->

                    <div class="card">

                        <div class="card-body">

                            <table id="dep_list" class="table table-striped table-bordered text-nowrap w-100">

                                <thead>

                                    <tr>

                                        <th>Date</th>

                                        <th class="text-info">Deposit</th>

                                        <th class="text-danger">Withdraw</th>

                                        <th class="text-success">Profit</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php 

                                    if($_SESSION['admin']['admin_level'] == 99){

                                        $mysqli = new DB();

                                        $lastday = date("t");

                                        $curmonth = date(" F Y");

                                        

                                        $topup_sql = 'SELECT SUM(topup_amount) As Total, DATE_FORMAT(topup_datetime, "%e") As Date

                                        FROM slot_topup

                                        WHERE  topup_amount > 0 AND Month(topup_datetime) = "'.DATE("m").'" AND YEAR(topup_datetime) = "'.DATE("Y").'"

                                        Group By YEAR(topup_datetime),Month(topup_datetime),Day(topup_datetime)

                                        ORDER BY topup_datetime ASC

                                        LIMIT '.$lastday;

                                        $topup_g = $mysqli->query($topup_sql)->fetchAll(); 



                                        $withdraw_sql = 'SELECT SUM(wd_amount) As Total, DATE_FORMAT(wd_datetime, "%e") As Date

                                        FROM slot_withdraw

                                        WHERE wd_status = 1 AND Month(wd_datetime) = "'.DATE("m").'" AND YEAR(wd_datetime) = "'.DATE("Y").'"

                                        Group By YEAR(wd_datetime),Month(wd_datetime),Day(wd_datetime)

                                        ORDER BY wd_datetime ASC

                                        LIMIT '.$lastday;

                                        

                                        $withdraw_g = $mysqli->query($withdraw_sql)->fetchAll(); 

                                        $topup_month = 0;

                                        $withdraw_month = 0;

                                        for($i=1;$i<=$lastday;$i++){

                                            echo '<tr>';

                                            echo '<td>'.$i.$curmonth.'</td>';

                                            echo '<td class="text-info">'.number_format($topup_g[$i-1]["Total"]).'</td>';

                                            echo '<td class="text-danger">'.number_format($withdraw_g[$i-1]["Total"]).'</td>';

                                            echo '<td class="text-success">'.number_format($topup_g[$i-1]["Total"]-$withdraw_g[$i-1]["Total"]).'</td>';

                                            echo '</tr>';

                                            $topup_month += $topup_g[$i-1]["Total"];

                                            $withdraw_month += $withdraw_g[$i-1]["Total"];

                                        }

                                            echo '<tr>';

                                            echo '<td>รวม</td>';

                                            echo '<td class="text-info">'.number_format($topup_month).'</td>';

                                            echo '<td class="text-danger">'.number_format($withdraw_month).'</td>';

                                            echo '<td class="text-success">'.number_format($topup_month-$withdraw_month).'</td>';

                                            echo '</tr>';

                                            $mysqli->close();

                                    }

                                    ?>

                                </tbody>

                            </table>

                        </div>

                    </div>













                </div>

                <!--End side app-->

            </div>

            <!-- End app-content-->

            <?php 

        	require(dirname(__FILE__).'/template/footer.php');

    	?>



        </div>

    </div>

    <!-- End Page -->



    <!-- Back to top -->

    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>



    <?php 

        	require(dirname(__FILE__).'/template/js.php');

    	?>



    <!-- Custom scroll bar js-->

    <script src="assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>





    <!-- Sidebar Accordions js -->

    <script src="assets/plugins/accordion1/js/easyResponsiveTabs.js"></script>



    <!-- Custom js-->

    <script src="assets/js-dark/custom.js" type="text/javascript"></script>





</body>



</html>