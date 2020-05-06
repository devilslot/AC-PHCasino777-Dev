<?php

session_start();

require_once 'dbmodel.php';
require_once 'function.php';

$site = include(__DIR__ . '/config/site.php');
$pg = include(__DIR__ . '/config/pg.php');

//include(__DIR__ . "/captcha/simple-php-captcha.php");
//require_once __DIR__ . '/captcha/simple-php-captcha.php"';
//$_SESSION['captcha'] = simple_php_captcha();

$bank_list = $mysqli->query("SELECT * FROM m_bank ORDER BY id");
$num_row = mysqli_num_rows($bank_list);

$aff_upline = $_GET['aff'];

// echo "AFF => $aff_upline";
//print_r($bank_list);
//echo 'num_row : ' . $bank_list->num_rows;
// exit();

?>

<!DOCTYPE html>

<html lang="th">

<head>

    <?php include(__DIR__ . '/include/head-sl66.php'); ?>
    <style>
        /* Start Youtube */
        .embed-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            max-width: 100%;
        }

        .embed-container iframe,
        .embed-container object,
        .embed-container embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        /* End Youtube */
    </style>

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
                                <li><a href="<?= $site['host'] ?>/login"><i class="far fa-user-plus"></i>
                                        <p>เข้าสู่ระบบ</p>
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
                    <section class="register"><a href="<?= $site['host'] ?>/login" class="float-right btn btn-outline-red"><i class="far fa-sign-in-alt"></i>
                            เข้าสู่ระบบ </a>
                        <h4 class="mb-4 mt-1">สมัครสมาชิก</h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <form method="POST" action="<?= $site['host'] ?>/register" accept-charset="UTF-8" class="login row">
                                    <!-- <input name="_token" type="hidden" value="t9AUEbD5Smmzfon3lfE3V2rIuK7zM01x1e6qYMBS"> -->
                                    <div class="form-group col-12 mb-1">
                                        <label>เบอร์มือถือ</label>
                                        <input placeholder="เบอร์มือถือ" maxlength="10" required="required" id="phone" name="phone" type="text" class="form-control form-control-lg">
                                    </div>
                                    <div class="form-group col-12 pr-2">
                                        <label>รหัสผ่าน <small>(อย่างน้อย 8 ตัวอักษร)</small></label>
                                        <input placeholder="รหัสผ่าน" minlength="6" required="required" id="password" name="password" type="password" value="" class="form-control form-control-lg">
                                    </div>
                                    <!-- <div class="form-group col-6 pl-2">
                                        <label>ยืนยันรหัสผ่าน</label>
                                        <input placeholder="ยืนยันรหัสผ่าน" minlength="4" required="required" name="password_confirmation" type="password" value="" class="form-control form-control-lg">
                                    </div> -->
                                    <div class="form-group col-12 mb-1">
                                        <label>เลขบัญชีธนาคาร <small>(เฉพาะตัวเลข)</small></label>
                                        <input placeholder="เลขบัญชีธนาคาร" required="required" id="bank_account" name="bank_account" type="text" class="form-control form-control-lg">
                                    </div>
                                    <div class="form-group col-12 mb-1"><label>ธนาคาร</label>
                                        <select required="required" id="bank_code" name="bangk_code" class="custom-select custom-select-lg">
                                            <option selected="selected" value="">-- เลือก --</option>
                                            <?php
                                            foreach ($bank_list as $row) {
                                                echo '<option value="' . $row['bank_code'] . '">' . $row['short_name'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label>ชื่อในสมุดบัญชีธนาคาร</label>
                                        <input placeholder="(ไม่ต้องใส่คำนำหน้า) ชื่อ" required="required" id="first_name" name="first_name" type="text" class="form-control form-control-lg">
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label>นามสกุล</label> <input placeholder="นามสกุล" required="required" id="last_name" name="last_name" type="text" class="form-control form-control-lg">
                                    </div>
                                    <div class="form-group col-12 mb-1">
                                        <label>ไลน์ไอดี</label>
                                        <input placeholder="ถ้าไม่มีเว้นว่างไว้ได้เลย" id="line_id" name="line_id" type="text" class="form-control form-control-lg">
                                    </div>
                                    <div class="form-group col-12 mb-3">
                                        <label>รู้จักเว็บเราจากที่ไหน?</label>
                                        <select required="required" id="source" name="source" class="custom-select custom-select-lg">
                                            <option selected="selected" value="">-- เลือก --</option>
                                            <option value="google">Google</option>
                                            <option value="facebook">Facebook</option>
                                            <option value="ads">ป้ายโฆษณา</option>
                                            <option value="friend">เพื่อนแนะนำ</option>
                                            <option value="other">อื่นๆ</option>
                                        </select>
                                    </div>
                                    <input name="aff_upline" id="aff_upline" type="hidden" value="<?= $aff_upline ?>">
                                    <div class="form-group col-12">
                                        <button type="submit" id="submit" class="btn-red btn-lg btn-block"><i class="far fa-user-plus"></i> สมัครสมาชิก </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-6 mt-3">
                                <div class="embed-container">
                                    <!-- <iframe src="https://www.youtube.com/embed/MW9Zj9qH8Ng?rel=0&amp;autoplay=1&amp;controls=1&amp;modestbranding=1&amp;autohide=1" frameborder="0" allow="autoplay" allowfullscreen="allowfullscreen"></iframe> -->
                                </div>
                                <div class="clearfix"></div> <img src="<?= $site['host'] ?>/assets/sl66/images/3step.jpg" class="w-100">
                            </div>
                        </div>
                    </section>
                </div>
            </main>
            <?php include(__DIR__ . '/include/foot-nav-sl66.php'); ?>
        </div>
    </div>

    <?php include(__DIR__ . '/include/footer-sl66.php'); ?>

    <script type="text/javascript">
        $(document).ready(function() {

            $('#submit').click(function(e) {
                e.preventDefault();

                var phone = $("#phone").val();
                var password = $("#password").val();
                var bank_account = $("#bank_account").val();
                var bank_code = $("#bank_code").val();
                var first_name = $("#first_name").val();
                var last_name = $("#last_name").val();
                var line_id = $("#line_id").val();
                var source = $("#source").val();
                var aff_upline = $("#aff_upline").val();

                $.ajax({
                    type: "POST",
                    url: "/exec/register.php",
                    dataType: "json",
                    data: {
                        phone: phone,
                        password: password,
                        bank_account: bank_account,
                        bank_code: bank_code,
                        first_name: first_name,
                        last_name: last_name,
                        line_id: line_id,
                        source: source,
                        aff_upline: aff_upline
                    },
                    success: function(data) {
                        switch (data.code) {
                            case 200:

                                let timerInterval
                                Swal.fire({
                                    title: 'สมัครสมาชิกเรียบร้อย!!!<BR><BR>ยินดีต้อนรับสมาชิกใหม่ค่ะ<BR>',
                                    html: '<img src="http://ac-dev.myserver.local/assets/sl66/images/right-bar-aff.gif"><BR><BR>กำลังเข้าสู่เว็บไซต์...',
                                    timer: 3000,
                                    timerProgressBar: true,
                                    onBeforeOpen: () => {
                                        Swal.showLoading()
                                        timerInterval = setInterval(() => {
                                            // const content = Swal.getContent()
                                            // if (content) {
                                            //     const b = content.querySelector('b')
                                            //     if (b) {
                                            //         b.textContent = Swal.getTimerLeft()
                                            //     }
                                            // }
                                        }, 100)
                                    },
                                    onClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                }).then((result) => {
                                    /* Read more about handling dismissals below */
                                    if (result.dismiss === Swal.DismissReason.timer) {
                                        window.location.href = "<?= $site['host'] ?>/user/dashboard";
                                    }
                                })
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