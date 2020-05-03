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

    <link href="/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />



    <!-- Horizontal-menu css -->

    <link href="/assets/plugins/horizontal-menu/dropdown-effects/fade-down.css" rel="stylesheet">

    <link href="/assets/plugins/horizontal-menu/dark-horizontalmenu.css" rel="stylesheet">





    <!-- Sidebar Accordions css -->

    <link href="/assets/plugins/accordion1/css/dark-easy-responsive-tabs.css" rel="stylesheet">



    <!---Sweetalert Css-->

    <link href="/assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet" />



    <!-- Date Picker css-->

    <link href="/assets/plugins/date-picker/spectrum.css" rel="stylesheet" />

    <!-- Data table css -->

    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />





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

                                    require dirname(__FILE__) . '/../class/database.php';

                                    $mysqli = new DB();

                                    if(isset($_POST['selectdate']))

                                        $date = $_POST['selectdate'];

                                    else

                                        $date = date('Y-m-d');

                                    $bank = $mysqli->query("SELECT * FROM slot_bank WHERE bank_id = ?",'4')->fetchArray();

                                    $data = $mysqli->query("SELECT * FROM bay_transaction WHERE DATE(`auto_trans_datetime`) LIKE ?",$date)->fetchAll();

                                    /*$sum_dep = $mysqli->query("SELECT SUM(`auto_amount`) as sum FROM bay_transaction_".$_GET['id']." WHERE `auto_amount` > 0 AND DATE(`trans_datetime`) LIKE ?",$date)->fetchArray();

                                    $sum_wd = 0*/
                
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

                                                    <th>ยูสเซอร์</th>

                                                    <th>สถานะ</th>

                                                    <th></th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                                foreach($data as $result){

                                                    echo'<tr>';

                                                        $can_use = ($result['auto_amount'] < 0?false:true);

                                                        if($result['auto_status'] == 0)

                                                            $status = 'รอการทำรายการ';

                                                        elseif($result['auto_status'] == 1)

                                                            $status ='<span class="text-success">ทำรายการสำเร็จ</span>';

                                                        elseif($result['auto_status'] == 2)

                                                            $status ='<span class="text-warning">ติดสถานะรับโบนัส</span>';

                                                        elseif($result['auto_status'] == 3)

                                                            $status ='<span class="text-danger">หายูสเซอร์ไม่พบ</span>';

                                                        elseif($result['auto_status'] == 4)

                                                            $status ='<span class="text-danger">ทำรายการผิดพลาด</span>';

                                                        elseif($result['auto_status'] == 5)

                                                            $status ='<span class="text-info">กำลังทำรายการ</span>';

                                                        echo '<td>'.$result['auto_trans_datetime'].'</td>';

                                                        echo '<td>'.$result['auto_bank_type'].'</td>';

                                                        echo '<td><span class="'.(!$can_use?'text-danger':'').'">'.$result['auto_amount'].'</span></td>';

                                                        echo '<td>'.$result['auto_bank_id'].'</td>';

                                                        echo '<td><a href="/member/list?acc='.$result['auto_username'].'" class="text-warning">'.$result['auto_username'].'</a></td>';



                                                        echo '<td>'.($can_use?$status:'').'</td>';

                                                        echo '<td>';

                                                        if($can_use AND ($result['auto_status'] != 1)){

                                                            if(!isset($result['auto_username']) OR ($result['auto_username'] == 0))

                                                                echo '<button class="btn btn-sm bg-gray" onclick="use_bank_bay(\''.$_GET['id'].'\',\''.$result['auto_id'].'\')"> ยังไม่ได้ใช้งาน </button>';

                                                        }

                                                        echo '</td>';

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

require dirname(__FILE__) . '/../template/footer.php';

?>



        </div>

    </div>

    <!-- End Page -->



    <!-- Back to top -->

    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>



    <?php

require dirname(__FILE__) . '/../template/js.php';

?>



    <!-- Horizontal-menu js -->

    <script src="/assets/plugins/horizontal-menu/horizontalmenu.js"></script>



    <!-- Sidebar Accordions js -->

    <script src="/assets/plugins/accordion1/js/easyResponsiveTabs.js"></script>



    <!-- Custom scroll bar js-->

    <script src="/assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>

    <!-- Datepicker js -->

    <script src="/assets/plugins/date-picker/jquery-ui.js"></script>

    <script src="/assets/plugins/input-mask/jquery.maskedinput.js"></script>



    <!-- Custom js-->

    <script src="/assets/js-dark/custom.js"></script>



    <!-- Sweet alert js-->

    <script src="/assets/plugins/sweet-alert/sweetalert.min.js"></script>



    <!-- Data tables js-->

    <script src="/assets/plugins/datatable/jquery.dataTables.min.js"></script>

    <script src="/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="/assets/plugins/datatable/dataTables.responsive.min.js"></script>



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

        var use_bank_bay = (id, trans_no) => {

            swal({

                title: "Username",

                text: 'กรอกยูสเซอร์ที่ต้องการเติมเงิน',

                type: "input",

                showCancelButton: true,

                closeOnConfirm: false,

            }, function (inputValue) {

                if (inputValue === false) return false;

                if (inputValue === "") {

                    swal.showInputError("กรุณากรอกยูสเซอร์เนม");

                    return false

                } else {

                    $.post('api/use_bank_bay.php', {

                        'username': inputValue,

                        'id': id,

                        'trans_no': trans_no

                    }, function (data) {

                        console.log(data);

                        if (data.status) {

                            swal({

                                    title: "Success",

                                    text: "ใช้ยอด ธนาคาร สำเร็จ",

                                    type: "success"

                                },

                                function () {

                                    location.reload();

                                });

                        } else

                            swal({

                                title: "Error",

                                text: "ไม่สามารถใช้ยอด ธนาคาร ได้",

                                type: "error"

                            });

                    });

                }

            });

        };

    </script>



</body>



</html>