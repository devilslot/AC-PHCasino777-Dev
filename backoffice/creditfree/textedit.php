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

                                <div class="table-responsive">

                                    <table class="table card-table table-vcenter text-nowrap">

                                        <thead>

                                            <tr>

                                                <th>NO</th>

                                                <th>Description</th>

                                                <!--<th>DATE/TIME</th>-->

                                                <th>Edit</th>

                                            </tr>

                                        </thead>

                                        <tbody>
                                            
                                            <?php

                                            require(dirname(__FILE__).'/../class/database.php');

                                            $mysqli = new DB();
                                            $data = $mysqli->query("SELECT * FROM `slot_text` ")->fetchAll();
                                            foreach($data as $result){     
                                                        
														echo '<tr>';
                                                        echo '<td>'.$result['text_id'].'</td>';
                                                        echo '<td>'.$result['text_description'].'</td>';
														//echo '<td>'.$result['check_date'].'</td>';
														echo '<td><button type="button" class="btn btn-outline-success" id="'.$result['text_id'].'" name="'.$result['text_id'].'" value="'.$result['text_id'].'" onclick="showpic(&#39;'.$result['text_id'].'&#39;)">แก้ไข</button></td>';
														echo '</tr>';
                                                    }
                                                
												?>
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

<!--<script>
$("button").click(function() {
    var fired_button = $(this).val(); 
    //alert(fired_button);
    let url1 = new URL('http://slot007.com/member/imgfreecredit/');
    let url2 = new URL(fired_button, url1);
    alert(url2);
});
</script>-->


<script>
function showpic(member) {
  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})
swalWithBootstrapButtons.fire({
  imageUrl: "http://slot007.com/member/imgfreecredit/"+member,
  title: 'ตรวจสอบรูปภาพ',
  text: 'คุณต้องการเพิ่มเครดิตใช่หรือไม่',
  showCancelButton: true,
  confirmButtonText: 'ทำรายการสำเร็จ',
  cancelButtonText: 'ปฏิเสธคำขอ',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
       
        $.post('api/success.php', {
            'chk_filename': member
        }, function (data) {
            //wait_list();
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
            //wait_list();
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
<!--<script>
        $("#creditfree").submit(function(e){
            e.preventDefault();
            $.post('exec/creditfree_test.php',
            $(this).serialize(),
            function(data){
                $("#alerts").html(data)
            }
            );
        });
</script>-->

