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



    <!-- Data table css -->

    <link href="/office69/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <link href="/office69/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />



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

                            <li class="breadcrumb-item active" aria-current="page">Member</li>

                        </ol><!-- End breadcrumb -->

                    </div>

                    <!-- End page-header -->

                    <!-- row -->

                    <div class="row">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header">

                                    <div class="card-title"><i class="fa fa-search" aria-hidden="true"></i> ประวัติ

                                        รับเครดิต / ถอนเครดิต</div>

                                </div>

                                <div class="card-body">

                                    <?php

                                    if (isset($_GET['acc'])) {

                                        require dirname(__FILE__) . '/../class/database.php';

                                        require dirname(__FILE__) . '/../config.php';

                                        require dirname(__FILE__) . '/../function.php';

                                        $mysqli = new DB();

                                        $data_topup = $mysqli->query("SELECT * FROM `slot_topup` WHERE `topup_username` = ?", $_GET['acc'])->fetchAll();

                                        $user = $mysqli->query("SELECT * FROM `slot_member` WHERE `member_username` = ?", $_GET['acc'])->fetchArray();

                                        $data_withdraw = $mysqli->query("SELECT * FROM `slot_withdraw` WHERE `wd_username` = ?", $_GET['acc'])->fetchAll();

                                        $sum_topup = $mysqli->query("SELECT SUM(`topup_amount`) as sum_deposit FROM `slot_topup` WHERE `topup_username` = ?", $_GET['acc'])->fetchArray();

                                        $sum_wd = $mysqli->query("SELECT SUM(`wd_amount`) as sum_withdraw FROM `slot_withdraw` WHERE `wd_username` = ?", $_GET['acc'])->fetchArray();
                                        
                                        //------bankshow------
                                          /*  if($user['member_bank_type'] == 'ไทยพาณิชย์'){
                                            $count = $mysqli->query("SELECT COUNT(*) as count FROM slot_bank WHERE bank_show = 1")->fetchArray();
                                            $bank_id = ($user['member_no']%$count['count'])+1;
                                            $bank = $mysqli->query("SELECT * FROM `slot_bank` WHERE `bank_id` = ? AND `bank_show` = 1",$bank_id)->fetchArray();
                                            } 
                                            if($user['member_bank_type'] == 'กสิกรไทย'){
                                            $count = $mysqli->query("SELECT COUNT(*) as count FROM slot_bank_kbank WHERE bank_show = 1")->fetchArray();
                                            $bank_id = ($user['member_no']%$count['count'])+1;
                                            $bank = $mysqli->query("SELECT * FROM `slot_bank_kbank` WHERE `bank_id` = ? AND `bank_show` = 1",$bank_id)->fetchArray();
                                            } 
                                            if($user['member_bank_type'] <> 'กสิกรไทย' && $user['member_bank_type'] <> 'ไทยพาณิชย์'){
                                            $count = $mysqli->query("SELECT COUNT(*) as count FROM slot_bank WHERE bank_show = 1")->fetchArray();
                                            // print_r($count['count']);
                                            // print_r($user['member_no']);
                                            $bank_id = ($user['member_no'] % $count['count'])+1;
                                            // print_r($bank_id);
                                            $bank = $mysqli->query("SELECT * FROM `slot_bank` WHERE `bank_id` = ? AND `bank_show` = 1",$bank_id)->fetchArray();
                                            }*/
                                
                                    if($user['member_level'] == 0)

                                        $credit = 0;

                                    else{
                                        $credit = json_decode(curl_get($api_url.'/new/GetCredit?username='.$user['member_username']));
                                        $credit = $credit->Credit;
                                    }

                                    if($user['member_aff'] == '')
                                        $show_aff = 'ไม่มียูสเซอร์ที่แนะนำ' ;
                                
                                    else{
                                        $show_aff = $user['member_aff'];
                                    }
                                    ?>

                                    <h5 class="text-info">ยอดเงินคงเหลือ : <?php echo $credit;?></h5>

                                    <hr/>

                                    <p>ยูสเซอร์เนม : <?php echo $user['member_username']; ?></p>

                                    <p>รหัสผ่าน : <?php echo $user['member_password']; ?></p>

                                    <p>เบอร์โทร : <?php echo $user['member_phone']; ?></p>

                                    <p>ชื่อ-นามสกุล : <?php echo $user['member_name'].' '.$user['member_surname']; ?></p>

                                    <p>เลขบัญชี : <?php echo $user['member_bank_number']; ?></p>

                                    <p>ธนาคาร : <?php echo $user['member_bank_type']; ?></p>

                                    <p>ไลน์ : <?php echo $user['member_line']; ?></p>

                                    <br>

                                    <hr/>
                    
                                    <h4 class="text-success">ยอดฝากทั้งหมด : <?php echo number_format ($sum_topup['sum_deposit']);?> บาท

                                    </h4>

                                    <h4 class="text-danger">ยอดถอนทั้งหมด : <?php echo number_format ($sum_wd['sum_withdraw']);?> บาท

                                    </h4>

                                    <hr />

                                    <h4 class="text-success">ประวัติการรับเครดิต</h4>

                                    <div class="table-responsive">

                                        <table class="table card-table table-vcenter text-nowrap  align-items-center"

                                            id="topup_list">

                                            <thead class="thead-light">

                                                <tr>

                                                    <th>วัน / เวลา</th>

                                                    <th>ช่องทาง</th>

                                                    <th>จำนวนเงิน</th>

                                                    <th>เครดิตที่ได้รับ</th>

                                                    <th>ข้อมูล</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                            <?php

                                                foreach($data_topup as $result){

                                                ?>

                                                <tr>

                                                    <td><?php echo $result['topup_datetime'];?></td>

                                                    <td><?php echo $result['topup_type'];?></td>

                                                    <td><?php echo $result['topup_amount'];?></td>

                                                    <td><?php echo $result['topup_credit'];?></td>

                                                    <td><?php echo $result['topup_info'];?></td>

                                                </tr>

                                                <?php

                                                }

                                                ?>

                                            </tbody>

                                        </table>

                                    </div>

                                    <hr />

                                    <h4 class="text-danger">ประวัติถอนเครดิต</h4>

                                    <div class="table-responsive">

                                        <table class="table card-table table-vcenter text-nowrap  align-items-center"

                                            id="wd_list">

                                            <thead class="thead-light">

                                                <tr>

                                                    <th>วัน / เวลา</th>

                                                    <th>จำนวนเงิน</th>

                                                    <th>ข้อมูล</th>

                                                    <th>สถานะ</th>

                                                    <th>วัน/เวลา ดำเนินการ</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php



                                                foreach($data_withdraw as $result){

                                                    

                                                    if($result['wd_status'] == 0)

                                                        $status = 'รอการทำรายการ';

                                                    elseif($result['wd_status'] == 1)

                                                        $status = '<span class="text-success">ทำรายการสำเร็จ</span>';

                                                    elseif($result['wd_status'] == 3)

                                                        $status = '<span class="text-info">คืนเครดิต</span>';

                                                    else

                                                        $status = '<span class="text-danger">ยกเลิกการถอน</span>';

                                                ?>

                                                <tr>

                                                    <td><?php echo $result['wd_datetime'];?></td>

                                                    <td><?php echo $result['wd_amount'];?></td>

                                                    <td><?php echo $result['wd_info'];?></td>

                                                    <td><?php echo $status; ?></td>

                                                    <td><?php echo $result['wd_transtime'];?></td>

                                                </tr>

                                                <?php

                                                }

                                                ?>

                                            </tbody>

                                        </table>

                                    </div>

                                    <?php

                                    $mysqli->close();



                                    }

                                    ?>

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

    <script src="/office69/assets/plugins/datatable/dataTables.responsive.min.js"></script>

    <script>

        $('#topup_list').DataTable({

            "order": [

                [0, "desc"]

            ]

        });

        $('#wd_list').DataTable({

            "order": [

                [0, "desc"]

            ]

        });

    </script>

</body>



</html>