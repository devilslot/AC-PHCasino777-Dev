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

                            <li class="breadcrumb-item active" aria-current="page">Member</li>

                        </ol><!-- End breadcrumb -->

                    </div>

                    <!-- End page-header -->

                    <!-- row -->

                    <div class="row">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header">

                                    <div class="card-title"><i class="typcn typcn-group "></i> ข้อมูลยูสเซอร์</div>

                                </div>

                                <div class="card-body">

                                    <div class="table-responsive">

                                        <table id="member"

                                            class="table table-striped table-bordered text-nowrap w-100">

                                            <thead>

                                                <tr>

                                                    <th class="wd-15p">ยูสเซอร์เนม</th>

                                                    <th class="wd-15p">เบอร์โทร</th>

                                                    <th class="wd-15p">หมายเลขบัญชี</th>

                                                    <th class="wd-10p">ชื่อ</th>

                                                    <th class="wd-10p">นามสกุล</th>

                                                    <th class="wd-10p"></th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                                    /*require(dirname(__FILE__).'/../class/database.php');

                                                    $mysqli = new DB();

                                                    $data = $mysqli->query("SELECT * FROM `slot_member`")->fetchAll();

                                                    foreach($data as $value){?>

                                                <tr>

                                                    <td><?php echo $value['member_phone'];?></td>

                                                    <td><?php echo $value['member_username'];?></td>

                                                    <td><?php echo $value['member_bank_number'];?></td>

                                                    <td><?php echo $value['member_name'].' '.$value['member_surname'];?>

                                                    </td>

                                                    <td>

                                                        <a class="btn btn-app btn-primary btn-sm" href="edit?acc=<?php echo $value['member_username']; ?>">

                                                            <i class="fa fa-edit"></i>Edit

                                                        </a>

                                                        <a class="btn btn-app btn-gray btn-sm" href="list?acc=<?php echo $value['member_username']; ?>">

                                                            <i class="fa fa-search"></i>ฝาก-ถอน

                                                        </a>

                                                    </td>

                                                </tr>

                                                <?php

                                                    }

                                                    $mysqli->close();*/

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



    <!-- Data tables js-->

    <script src="/office69/assets/plugins/datatable/jquery.dataTables.min.js"></script>

    <script src="/office69/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="/office69/assets/plugins/datatable/dataTables.responsive.min.js"></script>



    <script>

    $(function(e) {

	    $('#member').DataTable({

        "processing": true,

        "serverSide": true,

        "ajax": "api/list.php"

        });

    } );</script>                                            

    

</body>



</html>