<?php

require dirname(__FILE__) . '/../check.php';

?>

<!doctype html>

<html lang="en" dir="ltr">



<head>

    <?php

require dirname(__FILE__) . '/../template/head.php';

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

require dirname(__FILE__) . '/../template/menuside.php';

?>



            <!-- app-content-->

            <div class="container content-area">

                <div class="side-app">



                    <!-- page-header -->

                    <div class="page-header">

                        <ol class="breadcrumb">

                            <!-- breadcrumb -->

                            <li class="breadcrumb-item">Home</li>

                            <li class="breadcrumb-item active" aria-current="page">Withdraw</li>

                        </ol><!-- End breadcrumb -->

                    </div>

                    <!-- End page-header -->

                    <!-- row -->

                    <div class="row">

                        <div class="col-12">

                            <div class="card shadow">

                                <div class="card-header bg-transparent border-0">
                                <?php 
                                    require(dirname(__FILE__).'/../class/database.php');
                                    $mysqli = new DB();
                                    $count_status = $mysqli->query("SELECT COUNT(*) as count from slot_withdraw WHERE `wd_status` = 0")->fetchArray();
                                    
                                ?>

                                    <h3 class="card-title mb-0">รอทำรายการถอนเงิน <span class="text-warning"><?php echo $count_status['count'];?></span> รายการ</h3>
                                    <div class="card-options">
                                        <button class="btn btn-sm"
                                            onclick="delete_otp()"><i
                                                class="fa fa-pencil-square-o mr-1"></i>แก้ไข OTP ไม่มา</button>
                                    </div>

                                </div>

                                <div class="">

                                    <div class="grid-margin">

                                        <div class="">

                                            <div class="table-responsive">

                                                <table

                                                    class="table card-table table-vcenter text-nowrap  align-items-center">

                                                    <thead class="thead-light">

                                                        <tr>

                                                            <th>DateTime</th>

                                                            <th>Username</th>

                                                            <th>Credit</th>

                                                            <th>Name</th>

                                                            <th>Bank</th>

                                                            <th></th>

                                                        </tr>

                                                    </thead>

                                                    <tbody id="wait_list">



                                                    </tbody>

                                                </table>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- section-wrapper -->

                        </div>

                    </div>

                    <!-- row end -->





                </div>

                <!--End side app-->

            </div>

            <div class="results">



            </div>

            <!-- End app-content-->

            <?php

require dirname(__FILE__) . '/../template/footer.php';

?>

        </div>



        <!-- Modal -->

        <div class="modal  fade" id="input_otp" tabindex="-1" role="dialog" aria-labelledby="input_otp"

            aria-hidden="true">

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

                            <label class="form-control-label">OTP (Ref : <span id="ref"></span> ) <br/>ชื่อ : <span id="name"></span></label>

                                <input type="text" class="form-control" name="otp" autocomplete="off">

                                <input type="hidden" class="form-control" name="wd_id" id="wd_id" autocomplete="off"

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

    <!-- End Page -->



    <!-- Back to top -->

    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>



    <?php

require dirname(__FILE__) . '/../template/js.php';

?>

    <script>

        function wait_list() {

            $.get('api/wait.php?id=<?php echo $_GET['id']; ?>',

                function (data) {

                    $("#wait_list").html(data);

                    console.log('fetch');

                });

        };

        wait_list();

        setInterval(function () {

            wait_list();

        }, 10000);



        var cancel = (id) => {

            $.post('api/cancel.php', {

                'wd_id': id

            }, function (data) {

                swal("Success", "ยกเลิกการถอนสำเร็จ", "success");

                wait_list();



            });

        }

        var success = (id) => {

            $.post('api/success.php', {

                'wd_id': id

            }, function (data) {

                swal("Success", "การถอนเงินสำเร็จ", "success");

                wait_list();

            });

        }

        var return_credit = (id) => {

            $.post('api/return.php', {

                'wd_id': id

            }, function (data) {

                console.log(data);

                if (data.success) {

                    swal("Success", "คืนเครดิตสำเร็จ", "success");

                }else{

                    swal("Error", "คืนเครดิตไม่สำเร็จ", "error");

                }

                wait_list();

            });

        }

        var req_otp = (bank_num, bank_code, amount, id ,bank_id) => {

            $.post('transfer/request_otp.php', {
                'bank_id' : bank_id,
                
                'bank_num': bank_num,

                'bank_type': bank_code,

                'amount': amount

            }, function (data) {

                console.log(data);

                $('#ref').html(data.ref);

                $('#wd_id').val(id);
                $('#name').html(data.name);

                $('#input_otp').modal('show');

            });

        };



        $("#confirm").submit(function (e) {

            e.preventDefault();

            $.post('transfer/confirm_otp.php', $(this).serialize(), function (data) {

                console.log(data);

                if (data.success) {

                    wait_list();

                    $('#input_otp').modal('hide');

                    $('input[type=text]').val('');

                    swal("Success", "ทำรายการสำเร็จ", "success");

                } else {

                    $('#error').show();

                }

            });

        });

        var delete_otp = () => {
                    swal({
                        title: "กรอกเลขบัญชีที่ต้องการแก้ไข",
                        text: "ตัวอย่าง SCB-2 ให้กรอกเลข 2 ",
                        type: "input",
                        showCancelButton: true,
                        closeOnConfirm: false,
                    }, function (inputValue) {
                        if (inputValue === false) return false;
                        if (inputValue === "") {
                            swal.showInputError("กรุณากรอกบัญชี");
                            return false
                        } else {
                            $.post('api/delete_otp.php', {
                                'bank_no': inputValue
                            }, function (data) {
                                console.log(data);
                                if (data.status) {
                                    swal({
                                            title: "Success",
                                            text: "แก้ไข OTP สำเร็จ กรุณารอสักครู่",
                                            type: "success"
                                        });
                                } else
                                    swal({
                                        title: "Error",
                                        text: "ไม่สามารถแก้ไข OTP ได้",
                                        type: "error"
                                    });
                            });
                        }
                    });
                };

    </script>



    <!-- Horizontal-menu js -->

    <script src="/office69/assets/plugins/horizontal-menu/horizontalmenu.js"></script>



    <!-- Sidebar Accordions js -->

    <script src="/office69/assets/plugins/accordion1/js/easyResponsiveTabs.js"></script>



    <!-- Custom scroll bar js-->

    <script src="/office69/assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>



    <!-- Custom js-->

    <script src="/office69/assets/js-dark/custom.js"></script>



    <script src="/office69/assets/plugins/jquery.playSound.js"></script>

    <!-- Sweet alert js-->

    <script src="/office69/assets/plugins/sweet-alert/sweetalert.min.js"></script>







</body>



</html>