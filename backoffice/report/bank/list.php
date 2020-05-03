<?php

require dirname(__FILE__) . '/../../check.php';

?>

<!doctype html>

<html lang="en" dir="ltr">



<head>

    <?php

require dirname(__FILE__) . '/../../template/head.php';

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



    <!-- Date Picker css-->

    <link href="/office69/assets/plugins/date-picker/spectrum.css" rel="stylesheet" />

    <!-- Data table css -->

    <link href="/office69/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <link href="/office69/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />





<body class="app sidebar-mini rtl">







    <div class="page">

        <div class="page-main">

            <?php

require dirname(__FILE__) . '/../../template/menuside.php';

?>



            <!-- app-content-->

            <div class="container content-area">

                <div class="side-app">



                    <!-- page-header -->

                    <div class="page-header">

                        <ol class="breadcrumb">

                            <!-- breadcrumb -->

                            <li class="breadcrumb-item">Home</li>

                            <li class="breadcrumb-item active" aria-current="page">Bank</li>

                        </ol><!-- End breadcrumb -->

                    </div>

                    <!-- End page-header -->

                    <!-- row -->

                    <div class="row">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header">

                                    <h3 class="card-title">รายการ ธนาคาร</h3>

                                </div>

                                <div class="card-body">

                                    <?php

                                    require dirname(__FILE__) . '/../../class/database.php';

                                    $mysqli = new DB();

                                    if(isset($_POST['selectdate']))

                                        $date = $_POST['selectdate'];

                                    else

                                        $date = date('Y-m-d');

                                    $bank = $mysqli->query("SELECT * FROM slot_bank WHERE bank_id = ?",$_GET['id'])->fetchArray();

                                    $data = $mysqli->query("SELECT * FROM scb_transaction_".$_GET['id']." WHERE DATE(`trans_datetime`) LIKE ? AND trans_amount < 0",$date)->fetchAll();

                                    $sum_dep = $mysqli->query("SELECT SUM(`trans_amount`) as sum FROM scb_transaction_".$_GET['id']." WHERE `trans_amount` > 0 AND DATE(`trans_datetime`) LIKE ?",$date)->fetchArray();

                                    $sum_wd = $mysqli->query("SELECT SUM(`trans_amount`) as sum FROM scb_transaction_".$_GET['id']." WHERE `trans_amount` < 0 AND DATE(`trans_datetime`) LIKE ?",$date)->fetchArray();

                                    ?>

                                    <h3>เลือกวันที่</h3>

                                    <form method="POST">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <div class="input-group-text">

                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>

                                                </div>

                                            </div><input class="form-control fc-datepicker" placeholder="YYYY-MM-DD"

                                                type="text" name="selectdate" value="<?php echo $date; ?>"

                                                onchange="this.form.submit()" autocomplete="off">

                                        </div>

                                    </form>

                                    <hr />

                                    <div class="table-responsive">

                                        <table class="table table-striped table-bordered text-nowrap w-100">

                                            <thead>

                                                <tr>

                                                    <th>ชื่อบัญชี</th>

                                                    <th>เลขบัญชี</th>

                                                    <th class="text-success"><i class="fa fa-plus-circle"

                                                            aria-hidden="true"></i> รวมเงินเข้า</th>

                                                    <th class="text-danger"><i class="fa fa-minus-circle"

                                                            aria-hidden="true"></i> รวมเงินออก</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <tr>

                                                    <td><?php echo $bank['bank_fullname']; ?></td>

                                                    <td><?php echo $bank['bank_number']; ?></td>

                                                    <td class="text-success"><?php echo $sum_dep['sum']; ?></td>

                                                    <td class="text-danger"><?php echo $sum_wd['sum']; ?></td>

                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                    <div class="table-responsive">

                                        <table class="table table-striped table-bordered text-nowrap w-100" id="scb">

                                            <thead>

                                                <tr>

                                                    <th>วัน / เวลา</th>

                                                    <th>ช่องทาง</th>

                                                    <th>ยอดเงิน</th>

                                                    <th>ข้อมูล</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                                foreach($data as $result){

                                                    echo'<tr>';

                                                        echo '<td>'.$result['trans_datetime'].'</td>';

                                                        echo '<td>'.$result['trans_type'].'</td>';

                                                        echo '<td><span class="text-danger">'.$result['trans_amount'].'</span></td>';

                                                        echo '<td>'.$result['trans_info'].'</td>';

                                                    echo'</tr>';



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

require dirname(__FILE__) . '/../../template/footer.php';

?>



        </div>

    </div>

    <!-- End Page -->



    <!-- Back to top -->

    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>



    <?php

require dirname(__FILE__) . '/../../template/js.php';

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



    <!-- Sweet alert js-->

    <script src="/office69/assets/plugins/sweet-alert/sweetalert.min.js"></script>



    <!-- Data tables js-->

    <script src="/office69/assets/plugins/datatable/jquery.dataTables.min.js"></script>

    <script src="/office69/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="/office69/assets/plugins/datatable/dataTables.responsive.min.js"></script>



    <script>

        $('#scb').DataTable({

            "order": [

                [0, "desc"]

            ]

        });

        // Datepicker

        $('.fc-datepicker').datepicker({

            showOtherMonths: true,

            selectOtherMonths: true,

            dateFormat: 'yy-mm-dd'

        });

    </script>



</body>



</html>