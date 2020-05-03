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
                            <li class="breadcrumb-item active" aria-current="page">Agent</li>
                        </ol><!-- End breadcrumb -->
                    </div>
                    <!-- End page-header -->
                    <!-- row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title"><i class="fa fa-refresh"></i> เพิ่มเครดิต</div>
                                </div>
                                <div class="card-body">
                                    <div id="results"></div>
                                    <form id="add_credit">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">ยูสเซอร์เนม</label>
                                                    <input type="text" class="form-control" id="username" name="username"
                                                        autocomplete="off" required="">
                                                </div>
                                                </div> 
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">ยอดเงิน</label>
                                                    <input type="text" class="form-control" id="amount" name="amount"
                                                        autocomplete="off" required="" onchange="showbonus()">
                                                </div>                                                
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="form-label">ช่องทาง</label>
                                                    <select name="type" class="form-control">
                                                        <option value="admin">Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">หมายเหตุ</label>
                                                    <textarea class="form-control" id="info" name="info" rows="2"
                                                        placeholder="หมายเหตุ..." autocomplete="off"
                                                        required=""></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                            <div class="form-group">
                                                    <label for="bonus">โบนัส</label>
                                                    <select class="form-control" id="bonus" name="bonus" onchange="showbonus()">
                                                        <?php
                                                            require(dirname(__FILE__).'/../class/database.php');
                                                            $mysqli = new DB();
                                                            $result = $mysqli->query("SELECT * FROM `slot_bonus` WHERE `bonus_status` = 1")->fetchAll();
                                                            foreach($result as $data) {?>
                                                            <option value="<?php echo $data['bonus_id']?>">
                                                            <?php echo $data['bonus_name']?>
                                                            </option>
                                                            <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <h5 class="text-muted">เครดิตที่จะได้รับ :
                                                    <span id="showcredit" class="text-warning">0</span> เครดิต</h5>
                                                <h5 class="text-muted">ยอดเงินขั้นต่ำที่แจ้งถอนได้ :
                                                    <span id="min_money" class="text-warning">0</span> โบนัส</h5>
                                            </div>
                                            <input type="hidden" name="credit" id="credit"/>
                                        </div>
                                        <button class="btn btn-app btn-danger mr-2 mt-1 mb-1">
                                            ทำรายการ
                                        </button>
                                    </form>
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

    <script>
    function showbonus() {
            var bonus = $('#bonus').val();
            var amount = $('#amount').val();
            $.get("api/show_add_credit.php", {
                amount: amount,
                bonus: bonus
            }, function (data) {
                $('#showcredit').text(data.credit);
                $('#min_money').text(data.min_money);
                $('#credit').val(data.credit);
            });
        }
        $("#add_credit").submit(function (e) {
            e.preventDefault();
            $.post('api/add_credit.php', $(this).serialize(), 
            function (data) {
                $("#results").html(data)
                $("#add_credit").trigger('reset');
            });
        });
    </script>

</body>

</html>