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





<body class="app sidebar-mini rtl">







    <div class="page">

        <div class="page-main">f

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

                                    <div class="card-title"><i class="typcn typcn-group "></i> แก้ไขข้อมูลยูสเซอร์</div>

                                </div>

                                <div class="card-body">

                                    <?php

                                    if (isset($_GET['acc'])) {

                                        require dirname(__FILE__) . '/../class/database.php';

                                        require dirname(__FILE__) . '/../function.php';

                                        $mysqli = new DB();

                                        $data = $mysqli->query("SELECT * FROM `slot_member` WHERE `member_username` = ?", $_GET['acc'])->fetchArray();
                                        $can_edit = false;
                                        $detail = '';
                                        $bank_name = '';
                                        if(isset($_POST['action'])){
                                            if($_POST['action'] == 'confirm'){
                                                $can_edit = true;
                                                $_POST = $_SESSION['postdata']['data'];
                                                $detail = $_SESSION['postdata']['detail'];
                                                $bank_name = $_SESSION['postdata']['bankname'];
                                            }
                                            else{
                                                unset($_SESSION['postdata']);
                                            }
                                        }
                                        if (isset($_POST['edit'])) {
                                            unset($_SESSION['postdata']);

                                            $bank_name = bank_type_rename(trim($_POST['bank_type']));


                                            if($data['member_phone'] != trim($_POST['phone'])){

                                                $detail .= 'เบอร์โทร : '.$data['member_phone'].' > '.$_POST['phone'].' ';

                                            }

                                            if($data['member_name'] != trim($_POST['name'])){

                                                $detail .= 'ชื่อ : '.$data['member_name'].' > '.$_POST['name'].' ';

                                            }

                                            if($data['member_surname'] != trim($_POST['surname'])){

                                                $detail .= 'นามสกุล : '.$data['member_surname'].' > '.$_POST['surname'].' ';

                                            }

                                            if($data['member_password'] != trim($_POST['password'])){

                                                $detail .= 'รหัสผ่าน : '.$data['member_password'].' > '.$_POST['password'].' ';

                                            }

                                            if($data['member_bank_number'] != trim($_POST['bank_number'])){

                                                $detail .= 'เลขบัญชี : '.$data['member_bank_number'].' > '.$_POST['bank_number'].' ';

                                            }

                                            if($data['member_bank_type'] != trim($bank_name)){

                                                $detail .= 'ธนาคาร : '.$data['member_bank_type'].' > '.$bank_name.' ';

                                            }
                                            $find_dup = $mysqli->query("SELECT `member_username` FROM `slot_member` WHERE (`member_bank_number` LIKE ? AND `member_bank_type` LIKE ?) OR `member_phone` LIKE ?", $_POST['bank_number'],$bank_name,$_POST['phone'])->fetchAll();
                                            
                                            if(count($find_dup) > 1){
                                                $_SESSION['postdata']['data'] = $_POST;
                                                $_SESSION['postdata']['bankname']= $bank_name;
                                                $_SESSION['postdata']['detail'] = $detail;?>
                                                <h4>ข้อมูลที่ต้องการเปลี่ยน</h4><br/>
                                                <?php echo $detail; ?><br />
                                                <br /><h4>เบอร์หรือเลขบัญชีซ้ำกับยูสต่อไปนี้</h4>
                                                <?php
                                                foreach($find_dup as $data){
                                                    if($data['member_username'] != $_GET['acc'])
                                                    echo '<br/><a href="list?acc='.$data['member_username'].'" class="text-warning" target="_blank"> - '.$data['member_username'].'</a>';
                                                }
                                                ?>
                                                <br /><br />
                                                <form method="POST">
                                                    <button class="btn btn-sm btn-success mr-2 mt-1 mb-1" type="submit" name="action" value="confirm">
                                                        <i class="fa fa-save"></i> บันทึกข้อมูล
                                                    </button>
                                                    <button class="btn btn-sm btn-danger mr-2 mt-1 mb-1" type="submit" name="action" value="cancel">
                                                        <i class="fa fa-times"></i> ยกเลิก
                                                    </button>

                                                </form>
                                        <?php
                                            }else{
                                                $can_edit = true;
                                            }
                                        }
                                        if($can_edit == true){
                                            unset($_POST['edit']);
                                            $mysqli->query("UPDATE `slot_member` SET `member_phone` = ?,`member_name` = ? , `member_surname` = ? , `member_password` = ? , `member_bank_number` = ? , `member_bank_type` = ? WHERE `member_username` = ?",trim($_POST['phone']), trim($_POST['name']), trim($_POST['surname']), trim($_POST['password']), trim($_POST['bank_number']),$bank_name, $_GET['acc']);
                                            $mysqli->query("INSERT INTO `slot_agent` (ag_datetime, ag_username, ag_type, ag_amount, ag_info, ag_admin) VALUES (?,?,?,?,?,?)",date('Y-m-d H:i:s'), $_GET['acc'],'EditProfile',0,$detail,$_SESSION['admin']['admin_user']);
                                            echo '<div class="alert alert-success" role="alert">แก้ไขข้อมูลสำเร็จ</div>';
                                        }

                                        $data = $mysqli->query("SELECT * FROM `slot_member` WHERE `member_username` = ?", $_GET['acc'])->fetchArray();

                                        $mysqli->close();
                                        if(!isset($_POST['edit'])){

    ?>

                                    <form method="POST">

                                        <div class="row">

                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label class="form-label">เบอร์โทรศัพท์</label>

                                                    <input type="text" class="form-control" name="phone"
                                                        value="<?php echo $data['member_phone']; ?>">

                                                </div>

                                                <div class="form-group">

                                                    <label class="form-label">ชื่อ</label>

                                                    <input type="text" class="form-control" name="name"
                                                        value="<?php echo $data['member_name']; ?>">

                                                </div>

                                                <div class="form-group">

                                                    <label class="form-label">หมายเลขบัญชี</label>

                                                    <input type="text" class="form-control" name="bank_number"
                                                        value="<?php echo $data['member_bank_number']; ?>">

                                                </div>

                                            </div>



                                            <div class="col-md-6">

                                                <div class="form-group">

                                                    <label class="form-label">รหัสผ่าน</label>

                                                    <input type="text" class="form-control" name="password"
                                                        value="<?php echo $data['member_password']; ?>">

                                                </div>



                                                <div class="form-group">

                                                    <label class="form-label">นามสกุล</label>

                                                    <input type="text" class="form-control" name="surname"
                                                        value="<?php echo $data['member_surname']; ?>">

                                                </div>

                                                <div class="form-group">

                                                    <label class="form-label">ธนาคาร</label>

                                                    <select class="form-control" id="banktype" required=""
                                                        name="bank_type">



                                                        <?php

                                                        $options = ['000',

                                                                '002',

                                                                '004',

                                                                '006',

                                                                '034',

                                                                '011',

                                                                '070',

                                                                '071',

                                                                '017',

                                                                '018',

                                                                '020',

                                                                '022',

                                                                '024',

                                                                '025',

                                                                '030',

                                                                '031',

                                                                '039',

                                                                '033',

                                                                '073',

                                                                '065',

                                                                '067',

                                                                '069',

                                                                '066'];



                                                            $output = '';
                                        
                                                            for ($i = 0; $i < count($options); $i++) {
                                                                $bank_name = bank_type_rename($options[$i]);
                                                                $output .= '<option '.($data['member_bank_type'] == $bank_name ? 'selected="selected"' : '') . ' value="' . $options[$i] . '">'. bank_type_rename($options[$i]). '</option>';
                                                            }

                                                            echo $output;

                                                            ?>

                                                    </select>

                                                </div>

                                            </div>

                                            <input type="hidden" name="userno"
                                                value="<?php echo $data['member_username']; ?>">
                                            <input type="hidden" name="edit"
                                                value="true">

                                        </div>

                                        <button class="btn btn-app btn-danger mr-2 mt-1 mb-1">

                                            <i class="fa fa-save"></i> บันทึกข้อมูล

                                        </button>

                                    </form>

                                    <?php
                                    }

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





</body>



</html>