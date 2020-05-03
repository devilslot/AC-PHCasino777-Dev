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



    <!-- Data table css -->

    <link href="/office69/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <link href="/office69/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />

    <!---Sweetalert Css-->

    <link href="/office69/assets/plugins/sweet-alert/sweetalert.css" rel="stylesheet" />









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

                            <li class="breadcrumb-item active" aria-current="page">Witdraw List</li>

                        </ol><!-- End breadcrumb -->

                    </div>

                    <!-- End page-header -->

                    <!-- row -->

                    <div class="row">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header border-0">

                                    <h3 class="card-title">รายการ บัญชีถอน</h3>

                                    <div class="card-options">

                                        <form method="POST"><button class="btn btn-primary" name="add" value="add">เพิ่ม บัญชีถอนเงิน</button></form>

                                    </div>

                                </div>

                                <div class="table-responsive">

                                    <table class="table card-table table-vcenter text-nowrap">

                                        <thead>

                                            <tr>

                                                <th>ID</th>

                                                <th>ชื่อบัญชี</th>

                                                <th>เลขบัญชี</th>

                                                <th>Username</th>

                                                <th>Password</th>

                                                <th>เบอร์โทรศัพท์</th>

                                                <th>สถานะ</th>
                                                <th></th>
                                                <th></th>

                                            </tr>

                                        </thead>

                                        <tbody>

                                            <?php

                                            require(dirname(__FILE__).'/../../class/database.php');

                                            $mysqli = new DB();

                                            if(isset($_POST['add'])){

                                                $mysqli->query("INSERT INTO slot_bank_transfer VALUES (NULL,'','','000','','','',NULL,0)");

                                            }

                                            $data = $mysqli->query("SELECT * FROM `slot_bank_transfer`")->fetchAll();

                                            $i=1;

													foreach($data as $result){

														echo '<tr>';

														echo '<td>'.$i.'</td>';

														echo '<td>'.$result['bank_name'].'</td>';

														echo '<td>'.$result['bank_number'].'</td>';

														echo '<td>'.$result['bank_username'].'</td>';

                                                        echo '<td>'.$result['bank_password'].'</td>';

                                                        echo '<td>'.$result['bank_phone'].'</td>';
                                                        
                                                        $status = $result['bank_status']==0?'':'checked';

                                                        echo '<td><label class="custom-switch">

                                                        <input type="checkbox" '.$status.' onchange="wd_state(this,'.$result['bank_id'].')" class="custom-switch-input">

                                                        <span class="custom-switch-indicator"></span>

                                                    </label></td>';
                                                        echo '<td><a href="edit?id='.$result['bank_id'].'"><button class="btn btn-sm btn-danger">แก้ไขบัญชีถอน</button></a></td>';
                                                        
                                                        echo '<td><button class="btn btn-sm btn-danger" onclick="del_bank('.$result['bank_id'].')">ลบบัญชี</button></a></td>';
                                                       /* echo '<td><button class="btn btn-sm btn-danger" onclick="del_admin('.$result['bank_id'].')>ลบบัญชี</button></a></td>';*/

                                                        '</tr>';

                                                        $i++;

													}

												?>

                                        </tbody>

                                    </table>

                                </div>

                                <!-- table-responsive -->

                            </div>

                        </div><!-- col end -->

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

var del_bank = (id) => {

    $.post('api/del.php', {

        id: id

    });

    location.reload();

}

var wd_state = (check, id) => {

$.post('api/state.php', {

    state: check.checked,

    id: id

});

}

</script>



</body>



</html>