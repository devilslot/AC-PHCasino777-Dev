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

                                    Affiliate </div>

                                </div>

                                <div class="card-body">

                                    <?php

                                    if (isset($_GET['acc'])) {

                                        require dirname(__FILE__) . '/../class/database.php';

                                        require dirname(__FILE__) . '/../config.php';

                                        require dirname(__FILE__) . '/../function.php';

                                        $mysqli = new DB();

                                        $user = $mysqli->query("SELECT * FROM `slot_member` WHERE `member_username` = ?", $_GET['acc'])->fetchArray();

                                        $user_aff = $mysqli->query("SELECT * FROM `slot_member` WHERE `member_aff` = ?", $_GET['acc'])->fetchAll();

                                    if($user['member_aff'] == '')

                                        $show_aff = 'ไม่มียูสเซอร์ที่แนะนำ' ;
                                
                                    else{
                                        $show_aff = $user['member_aff'];
                                    }
                                    ?>  

                                    <h4 class = "text-success">ถูกแนะนำโดย : <?php echo $show_aff; ?></h4>

                                    <hr>

                                    <h4 class = "text-warning">รายการที่ : <?php echo $_GET['acc']?> แนะนำทั้งหมด</h4>

                                    <div class="table-responsive">

                                        <table class="table card-table table-vcenter text-nowrap  align-items-center"

                                            id="aff_list">

                                            <thead class="thead-light">

                                                <tr>

                                                    

                                                    <th>ยูสเซอร์</th>


                                                </tr>

                                            </thead>

                                            <tbody>

                                            <?php

                                                foreach($user_aff as $result){

                                                ?>

                                                <tr>

                                                    <td><?php echo $result['member_username'];?></td>

                                                </tr>

                                                <?php

                                                }

                                                ?>

                                            </tbody>

                                        </table>

                                    </div>

                                    <hr />

                                    

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

    <script src="/assets/plugins/horizontal-menu/horizontalmenu.js"></script>



    <!-- Sidebar Accordions js -->

    <script src="/assets/plugins/accordion1/js/easyResponsiveTabs.js"></script>



    <!-- Custom scroll bar js-->

    <script src="/assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>



    <!-- Custom js-->

    <script src="/assets/js-dark/custom.js"></script>



    <!-- Data tables js-->

    <script src="/assets/plugins/datatable/jquery.dataTables.min.js"></script>

    <script src="/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="/assets/plugins/datatable/dataTables.responsive.min.js"></script>

    <script>

        $('#aff_list').DataTable({

            "order": [

                [0, "desc"]

            ]

        });

    </script>

</body>



</html>