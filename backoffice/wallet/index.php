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



    <!-- Data table css -->

    <link href="/office69/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <link href="/office69/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />

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

                            <li class="breadcrumb-item active" aria-current="page">Wallet</li>

                        </ol><!-- End breadcrumb -->

                    </div>

                    <!-- End page-header -->

                    <!-- row -->

                    <div class="row">

                        <div class="col-md-12 col-lg-12">
                        <?php
                        require(dirname(__FILE__).'/../class/database.php');
                        $mysqli = new DB();
                        if(isset($_POST['desc'])){
                            if($_POST['state'] == 'on')
                                $state = 1;
                            else
                                $state = 0;
                            $mysqli->query("UPDATE slot_popup SET popup_status = ? , popup_desc = ? WHERE popup_name= 'wallet'",$state,$_POST['desc']);
                            ?>
                            <div class="alert alert-success" role="alert">
                            บันทึกข้อมูล Popup เรียบร้อยแล้ว
                            </div>
                        <?php
                        }
                        
                        ?>
                            <div class="card">

                                <div class="card-header border-0">

                                    <h3 class="card-title">รายการ Wallet</h3>

                                    <div class="card-options">

                                        <a href="add" class="btn btn-primary"><i class="si si-eye mr-1"></i>เพิ่ม

                                            Wallet</a>

                                    </div>

                                </div>

                                <div class="table-responsive">

                                    <table class="table card-table table-vcenter text-nowrap">

                                        <thead>

                                            <tr>

                                                <th>ID</th>
                                                <th>Email</th>

                                                <th>Phone</th>


                                                <!-- <th>Pass</th> -->

                                                <th>Name</th>

                                                <th>Status</th>

                                                <th></th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php

                                            $data = $mysqli->query("SELECT * FROM `setting_wallet`")->fetchAll();

													foreach($data as $result){

														echo '<tr>';

														echo '<td>'.$result['wallet_no'].'</td>';
                                                        
                                                        echo '<td>'.$result['wallet_phone'].'</td>';
                                                        
														echo '<td>'.$result['wallet_show'].'</td>';

														// echo '<td>'.$result['wallet_pass'].'</td>';

                                                        echo '<td>'.$result['wallet_name'].'</td>';

                                                        $status = $result['wallet_status']==0?'':'checked';

                                                        echo '<td><label class="custom-switch">

                                                        <input type="checkbox" '.$status.' onchange="wallet_state(this,'.$result['wallet_no'].')" class="custom-switch-input">

                                                        <span class="custom-switch-indicator"></span>

                                                    </label></td>';

                                                        echo '<td>

                                                        <a class="btn btn-sm btn-gray" href="list?id='.$result['wallet_no'].'">

                                                        <i class="fa fa-list"></i> List

                                                        </a>

                                                    <button class="btn btn-sm btn-info" onclick="req_otp('.$result['wallet_no'].')">

                                                        <i class="fa fa-sign-in"></i> Login

                                                    </button>

                                                    

                                                    <button class="btn btn-sm btn-danger float-right" onclick="del_wallet('.$result['wallet_no'].')">

                                                        <i class="fa fa-close"></i> Delete

                                                    </button></td>



														</tr>';

                                                    }

                                                    /*<a class="btn btn-sm btn-gray" href="list_sms?id='.$result['wallet_no'].'">

                                                            <i class="fa fa-list"></i> Sms

                                                        </a>*/

												?>

                                        </tbody>

                                    </table>

                                </div>

                                <!-- table-responsive -->

                            </div>

                        </div><!-- col end -->

                    </div>

                    <!-- row end -->

 <!-- row -->
                 <!--   <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title">Popup Wallet</h3>
                                </div>
                                <div class="card-body">
                                    <?php
                                    //$popup = $mysqli->query("SELECT * FROM slot_popup WHERE popup_name = 'wallet'")->fetchArray();
                                    //$status = $popup['popup_status']==0?'':'checked';?>
                                    <form method="POST">
                                        <label>ข้อความ Popup</label>
                                        <input type="text" class="form-control" placeholder="ใส่ข้อความ" name="desc" value="<?php //echo $popup['popup_desc'];?>"/>
                                        <br />
                                        <label>สถานะ Popup</label>
                                        <br/>
                                        <label class="custom-switch">
                                            <input type="checkbox" <?php //echo $status; ?>
                                                class="custom-switch-input" name="state">
                                            <span class="custom-switch-indicator"></span>
                                        </label>
                                        <br/>
                                        <br/>
                                        <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                                    </form>
                                </div>
                            </div>
                        </div>  col end 
                    </div> -->
                    <!-- row end -->




                </div>

                <!--End side app-->

            </div>

            <!-- End app-content-->

            <?php 

        	require(dirname(__FILE__).'/../template/footer.php');

    	?>

            <!-- Modal -->

            <div class="modal  fade" id="input_otp" tabindex="-1" role="dialog" aria-labelledby="input_otp"

                aria-hidden="true">

                <div class="modal-dialog modal-sm" role="document">

                    <form id="confirm">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title" id="smallmodal1">ยืนยัน OTP </h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                    <span aria-hidden="true">×</span>

                                </button>

                            </div>

                            <div class="modal-body">

                                <div class="alert alert-danger" role="alert" id="error" style="display: none;">

                                    การทำรายการไม่สำเร็จ</div>

                                <div class="form-group">

                                    <label for="recipient-name" class="form-control-label">OTP (Ref : <span

                                            id="ref"></span>

                                        )</label>

                                    <input type="text" class="form-control" name="otp" autocomplete="off">
                                    <input type="hidden" class="form-control" name="ref" id="ref2" autocomplete="off" value="">
                                    <input type="hidden" class="form-control" name="id" id="id" autocomplete="off"

                                        value="">

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



    <!-- Data tables js-->

    <script src="/office69/assets/plugins/datatable/jquery.dataTables.min.js"></script>

    <script src="/office69/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="/office69/assets/plugins/datatable/datatable.js"></script>

    <script src="/office69/assets/plugins/datatable/dataTables.responsive.min.js"></script>

    <!-- Sweet alert js-->

    <script src="/office69/assets/plugins/sweet-alert/sweetalert.min.js"></script>



    <script>

        var wallet_state = (check, id) => {

            $.post('api/state.php', {

                state: check.checked,

                id: id

            });

        }

        var del_wallet = (id) => {

            $.post('api/del.php', {

                id: id

            });

            location.reload();

        }

        var req_otp = (wallet_no) => {

            $.post('wallet_api/login.php', {

                'wallet_no': wallet_no

            }, function (res) {
                console.log(res);
                //console.log(data.data.otp_reference);

                $('#ref').html(res.data.otp_reference);

                $('#ref2').val(res.data.otp_reference);

                $('#id').val(wallet_no);

                $('#input_otp').modal('show');

            });

        };

        $("#confirm").submit(function (e) {

            e.preventDefault();

            $.post('wallet_api/login_otp.php', $(this).serialize(), function (data) {

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