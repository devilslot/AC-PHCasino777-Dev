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

    <link href="/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />



    <!-- Horizontal-menu css -->

    <link href="/assets/plugins/horizontal-menu/dropdown-effects/fade-down.css" rel="stylesheet">

    <link href="/assets/plugins/horizontal-menu/dark-horizontalmenu.css" rel="stylesheet">





    <!-- Sidebar Accordions css -->

    <link href="/assets/plugins/accordion1/css/dark-easy-responsive-tabs.css" rel="stylesheet">





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

                            <li class="breadcrumb-item active" aria-current="page">Wallet</li>

                        </ol><!-- End breadcrumb -->

                    </div>

                    <!-- End page-header -->

                    <!-- row -->

                    <div class="row">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header">

                                    <div class="card-title"><i class="typcn typcn-plus"></i> เพิ่มเบอร์ Wallet</div>

                                </div>

                                <div class="card-body">

                                    <?php

                                            if(isset($_POST['phone'])){

                                                require(dirname(__FILE__).'/../class/database.php');

                                                $mysqli = new DB();

                                                $mysqli->query("INSERT INTO `setting_wallet` VALUES (NULL,?,?,?,?,0,NULL,NULL,NULL)",$_POST['email'],$_POST['phone'],$_POST['password'],$_POST['fullname']);

                                                echo '<div class="alert alert-success" role="alert">เพิ่ม Wallet สำเร็จ</div>';

                                                $mysqli->close();

                                            }

                                    ?>

                                    <form method="POST">

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label class="form-label">เบอร์โทรศัพท์</label>

                                                    <input type="text" class="form-control" name="phone">
                                                </div>
                                                <div class="form-group">

                                                    <label class="form-label">ชื่อ - นามสกุล</label>

                                                    <input type="text" class="form-control" name="fullname">

                                                </div>

                                            </div>



                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label class="form-label">Email</label>

                                                    <input type="text" class="form-control" name="email" >

                                                </div>

                                                <div class="form-group">

                                                    <label class="form-label">รหัสผ่าน </label>

                                                    <input type="text" class="form-control" name="password">

                                                </div>



                                            </div>

                                        </div>

                                        <button class="btn btn-app btn-danger mr-2 mt-1 mb-1">

                                            <i class="fa fa-save"></i> บันทึกข้อมูล

                                        </button>

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

    <script src="/assets/plugins/horizontal-menu/horizontalmenu.js"></script>



    <!-- Sidebar Accordions js -->

    <script src="/assets/plugins/accordion1/js/easyResponsiveTabs.js"></script>



    <!-- Custom scroll bar js-->

    <script src="/assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>



    <!-- Custom js-->

    <script src="/assets/js-dark/custom.js"></script>





</body>



</html>