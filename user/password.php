<?php

session_start();

require_once '../dbmodel.php';
require_once '../function.php';

$site = include(__DIR__ . '/../config/site.php');
$pg = include(__DIR__ . '/../config/pg.php');

//include(__DIR__ . "/captcha/simple-php-captcha.php");
//require_once __DIR__ . '/captcha/simple-php-captcha.php"';
//$_SESSION['captcha'] = simple_php_captcha();

// $bank_list = $mysqli->query("SELECT * FROM m_bank ORDER BY id");
// $num_row = mysqli_num_rows($bank_list);

//print_r($bank_list);
//echo 'num_row : ' . $bank_list->num_rows;


include(__DIR__ . '/../checklogin.php');

$sql_text = "SELECT * FROM members WHERE member_login='" . trim($_SESSION['member_login']) . "'";
$row_getuser = $mysqli->query($sql_text)->fetch_assoc();

$username = '';
$uid = 0;
if ((count($row_getuser)) > 0) {
    // Found record(s) in database
} else {
    echo "<script>window.location.href = '" . $site['host'] . "'</script>";
}

//console_log($site['host']);

?>

<!DOCTYPE html>

<html lang="th">

<head>

    <?php include(__DIR__ . '/../include/head-sl66.php'); ?>

</head>

<body class="animated fadeIn fast">
    <div>
        <header class="header">
            <div class="navbar">
                <div class="container d-flex justify-content-between">
                    <div class="col-2 p-0">
                        <div class="top-nav">
                            <ul>
                                <li><a href="<?= $site['host'] ?>"><i class="far fa-home"></i>
                                        <p>หน้าแรก</p>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-8 text-center">
                        <img class="header-logo" src="<?= $site['host'] ?>/assets/sl66/images/logo-dashboard.png" alt="">
                    </div>
                    <div class="col-2 p-0">
                        <div class="top-nav">
                            <ul>
                                <li><a href="<?= $site['host'] ?>/logout"><i class="far fa-power-off"></i>
                                        <p>ออกจากระบบ</p>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section class="slide">
            <div class="slide-img d-none d-md-block"><img src="<?= $site['host'] ?>/assets/sl66/images/slide-img.jpg?v=1" alt=""></div>
            <div class="slide-img d-block d-md-none"><img src="<?= $site['host'] ?>/assets/sl66/images/slide-img-mobile.jpg?v=1" alt=""></div>
        </section>

        <div id="app">
            <main role="main">
                <div class="container content">
                    <section class="reset-password"><a href="<?= $site['host'] ?>/user/dashboard" class="float-right btn btn-outline-red"><i class="fas fa-arrow-left"></i> ย้อนกลับ</a>
                        <h4 class="mb-4 mt-1"> เปลี่ยนรหัสผ่าน</h4>
                        <hr>
                        <!-- <form method="POST" action="<?= $site['host'] ?>/user/password" accept-charset="UTF-8"> -->
                        <!-- <input name="_token" type="hidden" value="t9AUEbD5Smmzfon3lfE3V2rIuK7zM01x1e6qYMBS"> -->
                        <div class="form-group"><label>รหัสผ่านเดิม</label> <input placeholder="รหัสผ่านเดิม" minlength="4" required="required" id="current_password" name="current_password" type="password" value="" class="form-control form-control-lg"></div>
                        <div class="form-group"><label>รหัสผ่านใหม่</label> <input placeholder="รหัสผ่านใหม่" minlength="4" required="required" id="new_password" name="new_password" type="password" value="" class="form-control form-control-lg"></div>
                        <div class="form-group"><label>ยืนยันรหัสผ่านใหม่</label> <input placeholder="ยืนยันรหัสผ่านใหม่" minlength="4" required="required" id="new_password_confirmation" name="new_password_confirmation" type="password" value="" class="form-control form-control-lg"></div>
                        <div class="form-group"><button type="submit" id="submit" class="btn-red btn-lg btn-block"><i class="far fa-key"></i> เปลี่ยนรหัสผ่าน </button></div>
                        <!-- </form> -->
                    </section>
                </div>
            </main>
            <?php include(__DIR__ . '/../include/foot-nav-sl66-dashboard.php') ?>
        </div>
    </div>

    <?php include(__DIR__ . '/../include/footer-sl66.php'); ?>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#submit').click(function(e) {
                e.preventDefault();
                var c_password = $("#current_password").val();
                var n_password = $("#new_password").val();
                var nc_password = $("#new_password_confirmation").val();
                // swal.fire(c_password + " : " + n_password + " : " + nc_password, "yyyyyyy", "error");
                // exit();


                $.ajax({
                    type: "POST",
                    url: "http://ac-dev.myserver.local/exec/password.php",
                    dataType: "json",
                    data: {
                        current_password: c_password,
                        new_password: n_password,
                        new_password_confirmation: nc_password
                    },
                    success: function(data) {

                        switch (data.code) {
                            case 200:
                                swal.fire('Success!!!!', data.msg, 'success');
                                // Go to profile or dashboard page
                                setTimeout((function() {
                                    window.location.href = "<?= $site['host'] ?>/user/dashboard";
                                }), 3000);
                                break;
                            case 400:
                                swal.fire('ข้อมูลซ้ำ', data.msg, 'error');
                                break;
                            case 401:
                                swal.fire('ข้อมูลไม่สมบูรณ์', data.msg, 'error');
                                break;
                            case 402:
                                swal.fire('ข้อมูลไม่ถูกต้อง', data.msg, 'error');
                                break;
                            case 404:
                                swal.fire('ข้อมูลไม่ถูกต้อง', data.msg, 'error');
                                break;
                            default:
                                swal.fire('เกิดข้อผิดพลาด กรุณาติดต่อ Call Center', data.msg, 'error');
                                break;
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>