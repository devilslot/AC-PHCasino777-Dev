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

                            <li class="breadcrumb-item active" aria-current="page">Wallet</li>

                        </ol><!-- End breadcrumb -->

                    </div>

                    <!-- End page-header -->

                    <!-- row -->

                    <div class="row">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header">

                                    <div class="card-title"><i class="fa fa-list "></i> ข้อมูล Wallet</div>

                                </div>

                                <div class="card-body">

                                    <?php

                                    require dirname(__FILE__) . '/../class/database.php';

                                    require dirname(__FILE__) . '/../class/truewallet_test.php';

                                    if(isset($_POST['selectdate']))

                                        $start_date = $_POST['selectdate'];

                                    else

                                        $start_date = date('Y-m-d');

                                    $end_date = date("Y-m-d",strtotime("+1 days",strtotime($start_date)));

                                    $mysqli = new DB();

                                    $data = $mysqli->query("SELECT * FROM `setting_wallet` WHERE `wallet_no` = ?", $_GET['id'])->fetchArray();

                                    $tw = new TrueWallet($data['wallet_show'],$data['wallet_pass'],$data['wallet_access']);

                                    $transactions = $tw->getTransactions($start_date,$end_date);

                                    $profile = $tw->GetProfile()['data'];
                                    $balance = $tw->getBalance()['data']['current_balance'];
                                    $get_rep = $mysqli->query("SELECT `Wallet_ReportID`,`Wallet_Username` FROM `truewallet` WHERE  `Wallet_Date` = ?",$start_date)->fetchAll();

                                    $check_use = array();

                                    $used_by = array();

                                    foreach($get_rep as $value){
                                        if (strpos($value['Wallet_ReportID'], 'umk') === false) {
                                            $check_use[] = 'umk'.$value['Wallet_ReportID'];
                                        }else{
                                            $check_use[] = $value['Wallet_ReportID'];
                                        }
                                        $used_by[$value['Wallet_ReportID']] = $value['Wallet_Username'];
                                    }
                                    //print_r($used_by);
                                    //print_r($check_use);

                                    ?>

                                    <h3>เลือกวันที่</h3>

                                    <form method="POST">

                                        <div class="input-group">

                                            <div class="input-group-prepend">

                                                <div class="input-group-text">

                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>

                                                </div>

                                            </div><input class="form-control fc-datepicker" placeholder="YYYY-MM-DD"

                                                type="text" name="selectdate" value="<?php echo $start_date; ?>"

                                                onchange="this.form.submit()" autocomplete="off">

                                        </div>

                                    </form>

                                    <hr />

                                    <div class="table-responsive">

                                        <table class="table table-striped table-bordered text-nowrap w-100">

                                            <thead>

                                                <tr>

                                                    <th>เบอร์โทร</th>

                                                    <th>ชื่อ</th>

                                                    <th>Email</th>

                                                    <th>ยอดเงิน</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <tr>

                                                    <td><?php echo $profile['mobile_number']; ?></td>

                                                    <td><?php echo $profile['full_name']; ?></td>

                                                    <td><?php echo $profile['email']; ?></td>

                                                    <td><?php echo number_format($balance,2)  ; ?>

                                                    </td>

                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                    <div class="table-responsive">

                                        <table class="table table-striped table-bordered text-nowrap w-100"

                                            id="wallet_list">

                                            <thead>

                                                <tr>

                                                    <th class="wd-15p">วัน / เวลา</th>

                                                    <th class="wd-15p">ช่องทาง</th>

                                                    <th class="wd-15p">เบอร์โทร</th>

                                                    <th class="wd-20p">ยอดเงิน</th>

                                                    <th class="wd-10p">สถานะ</th>

                                                    <th class="wd-10p">ยูสเซอร์เนม</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                                $i=0;

                                                foreach ($transactions["data"]["activities"] as $value) {

                                                    $status = '';

                                                    if(substr($value['amount'],0,1) == '+'){

                                                        $status = '<button class="btn btn-sm bg-gray" onclick="use_wallet(\''.$_GET['id'].'\',\''.$value['report_id'].'\')"> ยังไม่ได้ใช้งาน </button>';

                                                        $find = array_search($value['report_id'],$check_use);

                                                        if($find !== false){

                                                            $status = '<span class="text-success">ใช้งานแล้ว</span>';

                                                        }

                                                    }

                                                    echo '<tr>';

                                                    echo '<td>' . $value['date_time'] . '</td>';

                                                    echo '<td>' . $value['title'] . '</td>';

                                                    echo '<td>' . $value['sub_title'] . '</td>';

                                                    echo '<td>' . $value['amount'] . '</td>';

                                                    echo '<td>'.$status.'</td>';

                                                    echo '<td>' . $used_by[$value['report_id']] . '</td>';

                                                    echo '</tr>';

                                                    $i++;

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



    <!-- Custom js-->

    <script src="/assets/js-dark/custom.js"></script>



    <!-- Sweet alert js-->

    <script src="/assets/plugins/sweet-alert/sweetalert.min.js"></script>

    <!-- Datepicker js -->

    <script src="/assets/plugins/date-picker/jquery-ui.js"></script>

    <script src="/assets/plugins/input-mask/jquery.maskedinput.js"></script>

    <!-- Data tables js-->

    <script src="/assets/plugins/datatable/jquery.dataTables.min.js"></script>

    <script src="/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="/assets/plugins/datatable/dataTables.responsive.min.js"></script>

    <script>

        // Datepicker

        $('.fc-datepicker').datepicker({

            showOtherMonths: true,

            selectOtherMonths: true,

            dateFormat: 'yy-mm-dd'

        });

        $('#wallet_list').DataTable({

            "order": [

                [0, "desc"]

            ]

        });

        var use_wallet = (id, rep_id) => {

            swal({

                title: "Username",

                text: "กรอกยูสเซอร์ที่ต้องการเติมเงิน",

                type: "input",

                showCancelButton: true,

                closeOnConfirm: false,

            }, function (inputValue) {

                if (inputValue === false) return false;

                if (inputValue === "") {

                    swal.showInputError("กรุณากรอกยูสเซอร์เนม");

                    return false

                } else {

                    $.post('api/use_wallet.php', {

                        'username': inputValue,

                        'id': id,

                        'report_id': rep_id

                    }, function (data) {

                        console.log(data);

                        if (data.status) {

                            swal({

                                    title: "Success",

                                    text: "ใช้ยอด Wallet สำเร็จ",

                                    type: "success"

                                },

                                function () {

                                    location.reload();

                                });

                        } else

                            swal({

                                title: "Error",

                                text: "ไม่สามารถใช้ยอด Wallet ได้",

                                type: "error"

                            });

                    });

                }

            });

        };

    </script>



</body>



</html>