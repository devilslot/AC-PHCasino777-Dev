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

                            <li class="breadcrumb-item active" aria-current="page">Setting</li>

                        </ol><!-- End breadcrumb -->

                    </div>

                    <!-- End page-header -->

                    <!-- row -->

                    <div class="row">

                        <div class="col-12">

                            <div class="card">

                                <div class="card-header">

                                    <div class="card-title"><i class="fa fa-cog"></i> ตั้งค่าถอนเงิน</div>

                                </div>

                                <div class="card-body">

                                    <?php 

                                    require dirname(__FILE__) . '/../class/database.php';

                                    $mysqli = new DB();

                                    $set = $mysqli->query("SELECT * FROM setting ")->fetchArray();

                                    $mysqli->close();

                                    ?>

                                    <div id="results"></div>

                                    <form id="settingwithdraw">

                                        <?php

                                        if($set['setting_wd'] == 1){

                                            ?>

                                        <p class="text-success">เปิดใช้งานระบบถอนเงิน</p>

                                        <?php }

                                        else{?>

                                        <p class="text-danger">ปิดใช้งานระบบถอนเงิน</p>



                                        <?php } ?>

                                        <button class="btn btn-app btn-danger mr-2 mt-1 mb-1">

                                            ทำรายการ

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

    <script src="/office69/assets/plugins/horizontal-menu/horizontalmenu.js"></script>



    <!-- Sidebar Accordions js -->

    <script src="/office69/assets/plugins/accordion1/js/easyResponsiveTabs.js"></script>



    <!-- Custom scroll bar js-->

    <script src="/office69/assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>



    <!-- Custom js-->

    <script src="/office69/assets/js-dark/custom.js"></script>



    <script>

        $("#settingwithdraw").submit(function (e) {

            e.preventDefault();

            $.post('api/withdrawsetting.php', $(this).serialize(), 

            function (data) {

                $("#results").html(data)

                $("#settingwithdraw").trigger('reset');

            });

        });

    </script>



</body>



</html>