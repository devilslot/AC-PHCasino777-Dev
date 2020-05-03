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

    <link href="/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />



    <!-- Horizontal-menu css -->

    <link href="/assets/plugins/horizontal-menu/dropdown-effects/fade-down.css" rel="stylesheet">

    <link href="/assets/plugins/horizontal-menu/dark-horizontalmenu.css" rel="stylesheet">





    <!-- Sidebar Accordions css -->

    <link href="/assets/plugins/accordion1/css/dark-easy-responsive-tabs.css" rel="stylesheet">



    <!-- Data table css -->

    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet" />

    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />



    <!-- sweetalert2s js-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


</head>



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

                            <li class="breadcrumb-item active" aria-current="page">Bank</li>

                        </ol><!-- End breadcrumb -->

                    </div>

                    <!-- End page-header -->

                    <!-- row -->
                    <div class="row">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header border-0">

                                    <h3 class="card-title">แก้ไขประกาศ</h3>

                                </div>


                                <div class="card-body">
                                <?php
                                require(dirname(__FILE__).'/../class/database.php');
                                $mysqli = new DB();
                                if(isset($_POST['desc'])){
                                    $url = '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i'; 
                                    $post = preg_replace($url, '<a href="$0" target="_blank" title="$0">$0</a>', $_POST['desc']);
                                    $post = nl2br($post);
                                    
                                    $mysqli->query("UPDATE slot_text SET text_desc = ?",$post);
                                    echo '<div class="alert alert-success" role="alert">ทำรายการสำเร็จ</div>';
                                }
                                $data = $mysqli->query("SELECT * FROM slot_text WHERE text_name = ?",'freecredit')->fetchArray(); ?>
                                <form method="POST">
                                    <textarea class="form-control" name="desc" rows="8"><?php echo $data['text_desc'];?></textarea>
                                    <br/>
                                    <button class="btn btn-success">แก้ไขข้อมูล</button>
                                </form>
                                </div>

                            </div>

                        </div><!-- col end -->

                    </div>

                    <div class="row">

                        <div class="col-md-12 col-lg-12">

                            <div class="card">

                                <div class="card-header border-0">
                                    <?php 
                                    $row_count = $mysqli->query("SELECT count(*) as count_today FROM slot_check_img WHERE check_status = 1 AND DATE(check_date) LIKE '".DATE('Y-m-d')."' ")->fetchArray();
                                    $row_free = $mysqli->query("SELECT * FROM slot_freecredit")->fetchArray();
                                    ?>
                                    <h3 class="card-title">ตรวจสอบเครดิต <span style="color:#FFC433;"> อนุมัติแล้ววันนี้ : <?php echo $row_count['count_today']?> / <?php echo $row_free['free_limit'];?>  คน</span></h3>

                                </div>

                                <div class="table-responsive">

                                    <table class="table card-table table-vcenter text-nowrap">

                                        <thead>

                                            <tr>

                                                <th>NO</th>

                                                <th>USERNAME</th>

                                                <th>DATE/TIME</th>

                                                <th>CONFIRM</th>

                                            </tr>

                                        </thead>

                                        <tbody id="wait_list">

                                        </tbody>
                                    </table>


                                </div>

                                <!-- table-responsive -->
                                <?php 
                                       
                                        //print_r($a[0]['check_no']);
                                        //print_r($a); 
                                        //print_r($result2['check_filename']); 
                                ?>
                            </div>

                        </div><!-- col end -->

                    </div>



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
    <script src="/assets/plugins/datatable/datatable.js"></script>
    <script src="/assets/plugins/datatable/dataTables.responsive.min.js"></script>

</body>



<script>

function wait_list() {

$.get('api/fetch.php',

    function (data) {

        $("#wait_list").html(data);

    });

};

wait_list();

setInterval(function () {

wait_list();

}, 30000);

    function showpic(member) {
        var newphoto = member ;
        var photo2 = newphoto.replace(".", "_2.");
        //alert(photo2);
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            imageUrl: "http://slot007.com/member/imgfreecredit/" + member + '?t=<?php echo time() ?>',
            imageHeight: 500,
            title: 'ตรวจสอบรูปภาพถัดไป',
            text: '',
            showCancelButton: true,
            confirmButtonText: 'รูปภาพถัดไป',
            cancelButtonText: 'ปฏิเสธคำขอ',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
            swalWithBootstrapButtons.fire({
                imageUrl: "http://slot007.com/member/imgfreecredit/" + photo2 + '?t=<?php echo time()?>',
                imageHeight: 500,
                title: 'คุณต้องการเพิ่มเครดิตใช่หรือไม่',
                text: '',
                showCancelButton: true,
                confirmButtonText: 'เพิ่มเครดิต',
                cancelButtonText: 'ปฏิเสธคำขอ',
                reverseButtons: true
        }).then((result) => {
            if (result.value) {

                $.post('api/success.php', {
                    'chk_filename': member
                }, function (data) {
                    wait_list();
                });


                swalWithBootstrapButtons.fire(
                    'ทำรายการเสร็จสิ้น',
                    'เพิ่มเครดิตให้ยูสเซอร์เรียบร้อย',
                    'success'
                )
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                $.post('api/delete.php', {
                    'chk_filename': member
                }, function (data) {
                    wait_list();
                });


                swalWithBootstrapButtons.fire(
                    'ปฏิเสธคำขอ',
                    'ปฏิเสธรายการขอเรียบร้อย',
                    'error'
                )
            }
        })
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                $.post('api/delete.php', {
                    'chk_filename': member
                }, function (data) {
                    wait_list();
                });


                swalWithBootstrapButtons.fire(
                    'ปฏิเสธคำขอ',
                    'ปฏิเสธรายการขอเรียบร้อย',
                    'error'
                )
            }
        })
    }
</script>

</html>
