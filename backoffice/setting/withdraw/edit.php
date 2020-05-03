<?php

require dirname(__FILE__) . '/../../check.php';



?>

<!doctype html>

<html lang="en" dir="ltr">



<head>

    <?php

require dirname(__FILE__) . '/../../template/head.php';

?>



    <!-- Custom scroll bar css-->

    <link href="/office69//assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet" />



    <!-- Horizontal-menu css -->

    <link href="/office69//assets/plugins/horizontal-menu/dropdown-effects/fade-down.css" rel="stylesheet">

    <link href="/office69//assets/plugins/horizontal-menu/dark-horizontalmenu.css" rel="stylesheet">





    <!-- Sidebar Accordions css -->

    <link href="/office69//assets/plugins/accordion1/css/dark-easy-responsive-tabs.css" rel="stylesheet">





<body class="app sidebar-mini rtl">







    <div class="page">

        <div class="page-main">

            <?php

require dirname(__FILE__) . '/../../template/menuside.php';

?>



<?php

   

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

                                    <div class="card-title"><i class="typcn typcn-group "></i> แก้ไขข้อมูลบัญชีถอนเงิน</div>

                                </div>

                                <div class="card-body">

                                    <?php

                                    if (isset($_GET['id'])) {

                                        require dirname(__FILE__) . '/../../class/database.php';

                                        require dirname(__FILE__) . '/../../function.php';

                                        //scb

                                        require_once dirname(__FILE__) . '/function/simple_html_dom.php'; 

                                        require_once dirname(__FILE__) . '/function/function.php';

                                        $PATH = dirname(__FILE__) . '/';

                                        $COOKIEFILE = $PATH . 'protect/scb-cookies';

                                        //scb

                                    

                                        $mysqli = new DB();

                                        $data = $mysqli->query("SELECT * FROM `slot_bank_transfer` WHERE `bank_id` = ?", $_GET['id'])->fetchArray();

                                        if (isset($_POST['username'])) {

                                            //$bank_name = bank_type_rename(trim($_POST['bank_type']));

                                            $detail = '';

                                            if($data['bank_name'] != trim($_POST['name'])){

                                                $detail .= 'ชื่อบัญชี : '.$data['bank_name'].' > '.$_POST['name'].' ';

                                            }

                                            if($data['bank_number'] != trim($_POST['bank_num'])){

                                                $detail .= 'หมายเลขบัญชี : '.$data['bank_number'].' > '.$_POST['bank_num'].' ';

                                            }

                                            if($data['bank_username'] != trim($_POST['username'])){

                                                $detail .= 'ยูสเซอร์เนม : '.$data['bank_username'].' > '.$_POST['username'].' ';

                                            }

                                            if($data['bank_password'] != trim($_POST['password'])){

                                                $detail .= 'พาสเวิร์ด : '.$data['bank_password'].' > '.$_POST['password'].' ';

                                            }

                                            if($data['bank_phone'] != trim($_POST['phone'])){

                                                $detail .= 'OTP : '.$data['bank_phone'].' > '.$_POST['phone'].' ';

                                            }

                                            //update phone

                                            $ch = curl_init();

                                            require('curl_header.php');

                                            // grab login

                                            curl_setopt($ch, CURLOPT_URL, 'https://m.scbeasy.com/online/easynet/mobile/login.aspx');

                                            curl_setopt($ch, CURLOPT_POST, false);

                                            $data = curl_exec($ch);

                                            $html = str_get_html($data);

                                            $form_field = array();

                                            foreach ($html->find('form input') as $element) {

                                                $form_field[$element->name] = $element->value;

                                            }

                                            $form_field['tbUsername'] = $_POST['username'];

                                            $form_field['tbPassword'] = $_POST['password'];

                                        

                                            $post_string = '';

                                            foreach ($form_field as $key => $value) {

                                                $post_string .= $key . '=' . urlencode($value) . '&';

                                            }

                                            $post_string = substr($post_string, 0, -1);

                                            //start login

                                            curl_setopt($ch, CURLOPT_URL, 'https://m.scbeasy.com/online/easynet/mobile/login.aspx');

                                            curl_setopt($ch, CURLOPT_POST, true);

                                            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);

                                            $data = curl_exec($ch);

                                        

                                            //grab transfer scb

                                            curl_setopt($ch, CURLOPT_URL, 'https://m.scbeasy.com/online/easynet/mobile/transfers/another-account-noProfile.aspx');

                                            curl_setopt($ch, CURLOPT_POST, false);

                                            $data = curl_exec($ch);

                                        

                                            $rx='/<option value=\"([0-9])\">XX-([0-9]{3})/';

                                            preg_match_all($rx,$data,$match);

                                        

                                            $phone = substr($_POST['phone'],-3);

                                            foreach($match as $key => $value){

                                                $bank_phone = array_search($phone,$value);

                                            }

                                            $phone_id = $match[1][$bank_phone];

                                            /// end phone

                                            $mysqli->query("UPDATE `slot_bank_transfer` SET `bank_name` = ? , `bank_number` = ? , `bank_username` = ? , `bank_password` = ? , `bank_phone` = ? , `bank_phone_id` = ?  WHERE `bank_id` = ?", trim($_POST['name']), trim($_POST['bank_num']), trim($_POST['username']), trim($_POST['password']), trim($_POST['phone']), trim($phone_id), $_GET['id']);

                                            //$mysqli->query("INSERT INTO `slot_agent` (ag_datetime, ag_username, ag_type, ag_amount, ag_info, ag_admin) VALUES (?,?,?,?,?,?)",date('Y-m-d H:i:s'),$_GET['id'],'EditBankWD',0,$detail,$_SESSION['admin']['admin_user']);

                                            echo '<div class="alert alert-success" role="alert">แก้ไขข้อมูลสำเร็จ</div>';

                                        }

                                        $data = $mysqli->query("SELECT * FROM `slot_bank_transfer` WHERE `bank_id` = ?", $_GET['id'])->fetchArray();

                                        $mysqli->close();

    ?>

                                    <form method="POST">

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label class="form-label">หมายเลขบัญชี</label>

                                                    <input type="text" class="form-control" name="bank_num"

                                                        value="<?php echo $data['bank_number']; ?>">

                                                </div>



                                                <div class="form-group">

                                                    <label class="form-label">ยูสเซอร์เนม</label>

                                                    <input type="text" class="form-control" name="username"

                                                        value="<?php echo $data['bank_username']; ?>">

                                                </div>

                                                <div class="form-group">

                                                    <label class="form-label">ลำดับเบอร์ OTP</label>

                                                    <input type="text" class="form-control" name="phone"

                                                        value="<?php echo $data['bank_phone']; ?>">

                                                </div>

                                            </div>



                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label class="form-label">ชื่อบัญชี</label>

                                                    <input type="text" class="form-control" name="name"

                                                        value="<?php echo $data['bank_name']; ?>">

                                                </div>

                                                <div class="form-group">

                                                    <label class="form-label">พาสเวิร์ด</label>

                                                    <input type="text" class="form-control" name="password"

                                                        value="<?php echo $data['bank_password']; ?>">

                                                </div>



                                            </div>

                                            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                                        </div>

                                        <button class="btn btn-app btn-danger mr-2 mt-1 mb-1">

                                            <i class="fa fa-save"></i> บันทึกข้อมูล

                                        </button>

                                    </form>

                                    <?php

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

require dirname(__FILE__) . '/../../template/footer.php';

?>



        </div>

    </div>

    <!-- End Page -->



    <!-- Back to top -->

    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>



    <?php

require dirname(__FILE__) . '/../../template/js.php';

?>



    <!-- Horizontal-menu js -->

    <script src="/office69//assets/plugins/horizontal-menu/horizontalmenu.js"></script>



    <!-- Sidebar Accordions js -->

    <script src="/office69//assets/plugins/accordion1/js/easyResponsiveTabs.js"></script>



    <!-- Custom scroll bar js-->

    <script src="/office69//assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>



    <!-- Custom js-->

    <script src="/office69//assets/js-dark/custom.js"></script>





</body>



</html>