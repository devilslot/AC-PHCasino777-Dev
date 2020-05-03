<?php 

    require(dirname(__FILE__).'/../../check.php');

?>

<!doctype html>

<html lang="en" dir="ltr">



<head>

    <?php 

    require(dirname(__FILE__).'/../../template/head.php');

?>



    <!-- Custom scroll bar css-->

    <link href="/office69/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />



    <!-- Horizontal-menu css -->

    <link href="/office69/assets/plugins/horizontal-menu/dropdown-effects/fade-down.css" rel="stylesheet">

    <link href="/office69/assets/plugins/horizontal-menu/dark-horizontalmenu.css" rel="stylesheet">





    <!-- Sidebar Accordions css -->

    <link href="/office69/assets/plugins/accordion1/css/dark-easy-responsive-tabs.css" rel="stylesheet">

    <!-- Date Picker css-->

    <link href="/office69/assets/plugins/date-picker/spectrum.css" rel="stylesheet" />

    <!-- Data table css -->

    <link href="/office69/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <link href="/office69/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />









<body class="app sidebar-mini rtl">







    <div class="page">

        <div class="page-main">

            <?php 

            require(dirname(__FILE__).'/../../template/menuside.php');

            ?>



            <!-- app-content-->

            <div class="container content-area">

                <div class="side-app">



                    <!-- page-header -->

                    <div class="page-header">

                        <ol class="breadcrumb">

                            <!-- breadcrumb -->

                            <li class="breadcrumb-item">Home</li>

                            <li class="breadcrumb-item active" aria-current="page">Deposit</li>

                        </ol><!-- End breadcrumb -->

                    </div>

                    <!-- End page-header -->

                    <!-- row -->

                    <div class="row">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header">

                                    <div class="card-title"><i class="fa fa-money"></i> ประวัติการทำรายการพนักงาน</div>

                                </div>

                                <div class="card-body">

                                    <?php

                                    require dirname(__FILE__) . '/../../class/database.php';

                                    $mysqli = new DB();

                                    if(isset($_POST['selectdate']))

                                        $date = $_POST['selectdate'];

                                    else

                                        $date = date('Y-m-d');

                                   $data = $mysqli->query("SELECT * FROM slot_agent WHERE DATE(`ag_datetime`) LIKE ?",$date)->fetchAll();

                                    $admin = $mysqli->query("SELECT * FROM slot_admin")->fetchAll();

                                    $num_admin = count($admin);

                                    for($i=0;$i<=$num_admin;$i++){

                                        $name[$admin[$i]['admin_user']] = $admin[$i]['admin_name'];

                                    }

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

                                        <table id="dep_list"

                                            class="table table-striped table-bordered text-nowrap w-100">

                                            <thead>

                                                <tr>

                                                    <th>DateTime</th>

                                                    <th>Username</th>

                                                    <th>Type</th>

                                                    <th>Info</th>

                                                    <th>Admin</th>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                                foreach($data as $result){

                                                

                                                ?>

                                                <tr>

                                                    <td><?php echo $result['ag_datetime'];?></td>

                                                    <td><a href="/office69/member/list?acc=<?php echo $result['ag_username'];?>"

                                                            class="text-warning" target="_blank"><?php echo $result['ag_username'];?></a>

                                                    </td>

                                                    <td><?php echo $result['ag_type'];?></td>

                                                    <td><?php echo $result['ag_info'];?></td>

                                                    <td><?php echo $result['ag_admin'].' ('.$name[$result['ag_admin']].')';?></td>



                                                </tr>

                                                <?php

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

        	require(dirname(__FILE__).'/../../template/footer.php');

    	?>



        </div>

    </div>

    <!-- End Page -->



    <!-- Back to top -->

    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>



    <?php 

        	require(dirname(__FILE__).'/../../template/js.php');

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



    <!-- Data tables js-->

    <script src="/office69/assets/plugins/datatable/jquery.dataTables.min.js"></script>

    <script src="/office69/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>

    <script src="/office69/assets/plugins/datatable/dataTables.responsive.min.js"></script>





    <script type="text/javascript">

        $(document).ready(function () {

            $('#dep_list').DataTable({

                "order": [

                    [0, "desc"]

                ]

            });



            $('.fc-datepicker').datepicker({

                showOtherMonths: true,

                selectOtherMonths: true,

                dateFormat: 'yy-mm-dd'

            });

        });

    </script>

</body>



</html>