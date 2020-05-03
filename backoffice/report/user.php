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
    <!-- Time picker css-->
    <link href="/office69/assets/plugins/time-picker/jquery.timepicker.css" rel="stylesheet" />




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
                            <li class="breadcrumb-item active" aria-current="page">Report</li>
                        </ol><!-- End breadcrumb -->
                    </div>
                    <!-- End page-header -->
                    <!-- row -->
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title"><i class="fa fa-external-link-square"></i> ประวัติการสมัครและเปิดยูส</div>
                                </div>
                                <div class="card-body">
                                    <?php
                                    require dirname(__FILE__) . '/../class/database.php';
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

                                    $vip = $mysqli->query("SELECT COUNT(*) as count FROM slot_member WHERE member_level = 1 AND member_register_date between ? AND ?",$start_datetime,$end_datetime)->fetchArray();
                                    $normal = $mysqli->query("SELECT COUNT(*) as count FROM slot_member WHERE member_vip_date IS NULL AND member_register_date between ? AND ?",$start_datetime,$end_datetime)->fetchArray();
                                    $free = $mysqli->query("SELECT COUNT(*) as count FROM slot_member WHERE member_level = 2 AND member_register_date between ? AND ?",$start_datetime,$end_datetime)->fetchArray();
                                    $topup = $mysqli->query("SELECT COUNT(DISTINCT(topup_username)) as count from slot_topup WHERE topup_datetime Between ? AND ?",$start_datetime,$end_datetime)->fetchArray();
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
                                    <form method="POST" action="export.php">
                                    <input type="hidden" name="start" value="<?php echo $start_datetime; ?>"/>
                                    <input type="hidden" name="end" value="<?php echo $end_datetime; ?>"/>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">
                                            <button class="card card-counter bg-gradient-primary" name="vip" value="ยูส VIP <?php echo $start_datetime; ?> ถึง <?php echo $end_datetime; ?>">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <i
                                                                class="si si-people mt-3 mb-0 text-white-transparent"></i>
                                                        </div>
                                                        <div class="col-8 text-center">
                                                            <div class="mt-4 mb-0 text-white">
                                                                <h2 class="mb-0"><?php echo $vip['count']; ?>
                                                                </h2>
                                                                <p class="text-white mt-1 ">รวมเปิดยูสเติมเงิน</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div><!-- col end -->
                                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">
                                            <button class="card card-counter bg-gradient-success" name="normal" value="ยูสธรรมดา <?php echo $start_datetime; ?> ถึง <?php echo $end_datetime; ?>">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <i
                                                                class="si si-people mt-3 mb-0 text-white-transparent"></i>
                                                        </div>
                                                        <div class="col-8 text-center">
                                                            <div class="mt-4 mb-0 text-white">
                                                                <h2 class="mb-0"><?php echo $normal['count']; ?>
                                                                </h2>
                                                                <p class="text-white mt-1 ">สมัครยังไม่เปิดยูส</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div><!-- col end -->
                                        
                                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">
                                            <button class="card card-counter bg-gradient-info" name="free" value="ยูสเครดิตฟรี <?php echo $start_datetime; ?> ถึง <?php echo $end_datetime; ?>">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <i
                                                                class="si si-people mt-3 mb-0 text-white-transparent"></i>
                                                        </div>
                                                        <div class="col-8 text-center">
                                                            <div class="mt-4 mb-0 text-white">
                                                                <h2 class="mb-0"><?php echo $free['count']; ?>
                                                                </h2>
                                                                <p class="text-white mt-1 ">เครดิตฟรี</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div><!-- col end -->
                                        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">
                                            <button class="card card-counter bg-gradient-danger" name="topup" value="ยูสเติมเงิน <?php echo $start_datetime; ?> ถึง <?php echo $end_datetime; ?>">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <i
                                                                class="si si-people mt-3 mb-0 text-white-transparent"></i>
                                                        </div>
                                                        <div class="col-8 text-center">
                                                            <div class="mt-4 mb-0 text-white">
                                                                <h2 class="mb-0"><?php echo $topup['count']; ?>
                                                                </h2>
                                                                <p class="text-white mt-1 ">Active เติมเงิน</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div><!-- col end -->
                                    </div>
                                    </form>
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
    <!-- Timepicker js -->
    <script src="/office69/assets/plugins/time-picker/jquery.timepicker.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#start_time').timepicker({ timeFormat: 'H:i:s' });
            $('#end_time').timepicker({ timeFormat: 'H:i:s' });

            $('.fc-datepicker').datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>

</body>

</html>