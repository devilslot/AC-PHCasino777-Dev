<?php 

    require(dirname(__FILE__).'/../check.php');

?>

<!doctype html>

<html lang="en" dir="ltr">



<head>

    <?php 

    require(dirname(__FILE__).'/../template/head.php');

?>



    <!-- Custom scroll bar css-->

    <link href="/office69/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />



    <!-- Horizontal-menu css -->

    <link href="/office69/assets/plugins/horizontal-menu/dropdown-effects/fade-down.css" rel="stylesheet">

    <link href="/office69/assets/plugins/horizontal-menu/dark-horizontalmenu.css" rel="stylesheet">





    <!-- Sidebar Accordions css -->

    <link href="/office69/assets/plugins/accordion1/css/dark-easy-responsive-tabs.css" rel="stylesheet">

    <!-- Date Picker css-->

    <link href="/office69/assets/plugins/date-picker/spectrum.css" rel="stylesheet" />

    <!-- Data table css -->

    <link href="/office69/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <link href="/office69/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />









<body class="app sidebar-mini rtl">







    <div class="page">

        <div class="page-main">

            <?php 

            require(dirname(__FILE__).'/../template/menuside.php');

            ?>



            <!-- app-content-->

            <div class="container content-area">

                <div class="side-app">



                    <!-- page-header -->

                    <div class="page-header">

                        <ol class="breadcrumb">

                            <!-- breadcrumb -->

                            <li class="breadcrumb-item">Home</li>

                            <li class="breadcrumb-item active" aria-current="page">Deposit</li>

                        </ol><!-- End breadcrumb -->

                    </div>

                    <!-- End page-header -->

                    <!-- row -->

                    <div class="row">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header">

                                    <div class="card-title"><i class="fa fa-money"></i> ประวัติยอดเงินออก Wallet</div>

                                </div>

                                <div class="card-body">

                                    <?php

                                    require dirname(__FILE__) . '/../class/database.php';

                                    require dirname(__FILE__) . '/../class/truewallet.class.php';

                                    $mysqli = new DB();

                                    $start_date = date('Y-m-d');

                                    $end_date = date("Y-m-d", strtotime('tomorrow'));

                                    $start_time = '00:00:00';

                                    $end_time = '00:00:00';

                                    if(isset($_POST['start_date'])){

                                        $start_date = $_POST['start_date'];

                                        $end_date = $_POST['end_date'];

                                        $start_time = $_POST['start_time'];

                                        $end_time = $_POST['end_time'];

                                    }

                                    $start_datetime = $start_date.' '.$start_time;

                                    $end_datetime = $end_date.' '.$end_time;

                                    //$data = $mysqli->query("SELECT * FROM wallet_tnx_out WHERE (`tnx_out_datetime`) BETWEEN ? AND ?",$start_datetime,$end_datetime)->fetchAll();
                                    $data = $mysqli->query("SELECT * FROM truewallet WHERE (`Wallet_Datetime`) BETWEEN ? AND ?",$start_datetime,$end_datetime)->fetchAll();
                                    ?>


                                    <h3>เลือกวันและเวลา</h3>

                                    <form method="POST">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <div class="input-group-text">

                                                    วันเวลาเริ่มต้น

                                                </div>

                                            </div>

                                            <input class="form-control fc-datepicker" placeholder="<?php echo $start_date; ?>"

                                                type="text" name="start_date" value="<?php echo $start_date; ?>"

                                                autocomplete="off">

                                            <input class="form-control" type="text" name="start_time" id="start_time" value="<?php echo $start_time; ?>" autocomplete="off">

                                        </div>

                                        <br/>

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <div class="input-group-text">

                                                    วันเวลาสิ้นสุด

                                                </div>

                                            </div>

                                            <input class="form-control fc-datepicker" placeholder="<?php echo $end_date; ?>"

                                                type="text" name="end_date" value="<?php echo $end_date; ?>"

                                                autocomplete="off">

                                            <input class="form-control" type="text" name="end_time" id="end_time" value="<?php echo $end_time; ?>" autocomplete="off">



                                        </div>

                                        <br/>

                                        <button type="submit" class="btn btn-primary">ค้นหา</button>

                                    </form>

                                    <hr />

                                    <div class="table-responsive">

                                        <table id="dep_list"

                                            class="table table-striped table-bordered text-nowrap w-100">

                                            <thead>

                                                <tr>

                                                    <th>DateTime</th>

                                                    <th>Number</th>

                                                    <!--<th>Type</th>-->

                                                    <th>Amount</th>

                                                    <!--<th>Info</th>-->


                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                                foreach($data as $result){

                                                

                                                ?>

                                                <tr>
                                                    <!-- 
                                                    
                                                    <td><?php echo $result['tnx_out_datetime'];?></td>

                                                    <td><?php echo $result['tnx_out_number'];?></td>

                                                    <td><?php echo $result['tnx_out_type'];?></td>

                                                    <td><?php echo $result['tnx_out_amount'];?></td>

                                                    <td><?php echo $result['tnx_out_detail'];?></td>
                                                    
                                                    -->

                                                    <td><?php echo $result['Wallet_Datetime'];?></td>

                                                    <td><?php echo $result['Wallet_Phone'];?></td>

                                                    <!--<td><?php echo $result['tnx_out_type'];?></td>-->

                                                    <td><?php echo $result['Wallet_Amount'];?></td>

                                                   <!--<td><?php echo $result['tnx_out_detail'];?></td>-->

                                                </tr>

                                                <?php

                                                }

                                                $mysqli->close();

                                                ?>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                                <!-- table-wrapper -->

                            </div>

                            <!-- section-wrapper -->

                        </div>

                    </div>

                    <!-- row end -->





                </div>

                <!--End side app-->

            </div>

            <!-- End app-content-->

            <?php 

        	require(dirname(__FILE__).'/../template/footer.php');

    	?>



        </div>

    </div>

    <!-- End Page -->



    <!-- Back to top -->

    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>



    <?php 

        	require(dirname(__FILE__).'/../template/js.php');

    	?>



    <!-- Horizontal-menu js -->

    <script src="/office69/assets/plugins/horizontal-menu/horizontalmenu.js"></script>



    <!-- Sidebar Accordions js -->

    <script src="/office69/assets/plugins/accordion1/js/easyResponsiveTabs.js"></script>



    <!-- Custom scroll bar js-->

    <script src="/office69/assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Datepicker js -->

    <script src="/office69/assets/plugins/date-picker/jquery-ui.js"></script>

    <script src="/office69/assets/plugins/input-mask/jquery.maskedinput.js"></script>

    <!-- Custom js-->

    <script src="/office69/assets/js-dark/custom.js"></script>



    <!-- Data tables js-->

    <script src="/office69/assets/plugins/datatable/jquery.dataTables.min.js"></script>

    <script src="/office69/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="/office69/assets/plugins/datatable/dataTables.responsive.min.js"></script>





    <script type="text/javascript">

        $(document).ready(function () {

            $('#dep_list').DataTable({

                "order": [

                    [0, "desc"]

                ]

            });



            $('.fc-datepicker').datepicker({

                showOtherMonths: true,

                selectOtherMonths: true,

                dateFormat: 'yy-mm-dd'

            });

        });

    </script>

</body>



</html>