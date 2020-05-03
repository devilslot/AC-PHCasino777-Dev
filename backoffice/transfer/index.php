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

    <!---Sweetalert Css-->

    <link href="/office69/assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet" />





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

                            <li class="breadcrumb-item active" aria-current="page">Transfer</li>

                        </ol><!-- End breadcrumb -->

                    </div>

                    <!-- End page-header -->

                    <!-- row -->

                    <div class="row">

                        <div class="col-12">

                            <div class="card">

                                <div class="card-header">

                                    <div class="card-title"><i class="fa fa-refresh"></i> โยกเงิน</div>

                                </div>

                                <div class="card-body">

                                    <div id="results"></div>

                                    <form id="req_otp">

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label for="form-label">บัญชีต้นทาง</label>

                                                    <select name="from" class="form-control">

                                                        <?php

                                                        require(dirname(__FILE__).'/../class/database.php');

                                                        $mysqli = new DB();

                                                        $data = $mysqli->query("SELECT * FROM `slot_bank`")->fetchAll();

                                                        foreach($data as $result){

                                                            echo '<option value="'.$result['bank_id'].'">'.$result['bank_number'].' ( '.$result['bank_fullname'].' )</option>';

                                                        }

                                                        ?>

                                                    </select>

                                                </div>

                                                <div class="form-group">

                                                    <label class="form-label">ยอดเงิน</label>

                                                    <input type="text" class="form-control" name="amount"

                                                        autocomplete="off" required="">

                                                </div>

                                            </div>



                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label for="form-label">บัญชีปลายทาง</label>

                                                    <select name="to" class="form-control">

                                                        <?php

                                                        $data = $mysqli->query("SELECT * FROM `slot_bank_transfer`")->fetchAll();

                                                        foreach($data as $result){

                                                            echo '<option value="'.$result['bank_id'].'">'.$result['bank_number'].' ( '.$result['bank_name'].' )</option>';

                                                        }

                                                        ?>

                                                    </select>

                                                </div>

                                            </div>

                                        </div>

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

    <!-- Modal -->

    <div class="modal  fade" id="input_otp" tabindex="-1" role="dialog" aria-labelledby="input_otp" aria-hidden="true">

        <div class="modal-dialog modal-sm" role="document">

            <form id="confirm">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title" id="smallmodal1">ยืนยันการถอนเงิน </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                            <span aria-hidden="true">×</span>

                        </button>

                    </div>

                    <div class="modal-body">

                        <div class="alert alert-danger" role="alert" id="error" style="display: none;">

                            การทำรายการไม่สำเร็จ</div>

                        <div class="form-group">

                            <label for="recipient-name" class="form-control-label">OTP (Ref : <span id="ref"></span>)</label>

                            <input type="text" class="form-control" name="otp" autocomplete="off">

                        </div>

                    </div>

                    <div class="modal-footer">

                        <a class="btn btn-red" data-dismiss="modal">Close</a>

                        <button type="submit" class="btn btn-success">Confirm</button>

                    </div>

                </div>

            </form>

        </div>

    </div>

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

    <!-- Sweet alert js-->

    <script src="/office69/assets/plugins/sweet-alert/sweetalert.min.js"></script>

    <script>

        $("#req_otp").submit(function (e) {

            e.preventDefault();

            $.post('transfer/request_otp.php', $(this).serialize(), function (data) {

                console.log(data);

                if (data.success) {

                    $('#ref').html(data.ref);

                    $('#input_otp').modal('show');

                }

            });

        });



        $("#confirm").submit(function (e) {

            e.preventDefault();

            $.post('transfer/confirm_otp.php', $(this).serialize(), function (data) {

                console.log(data);

                if (data.success) {

                    $('#input_otp').modal('hide');

                    $('input[type=text]').val('');

                    swal("Success", "ทำรายการสำเร็จ", "success");

                } else {

                    $('#error').show();

                }

            });

        });

    </script>



</body>



</html>