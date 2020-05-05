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

//print_r($bank_list);
//echo 'num_row : ' . $bank_list->num_rows;



?>

<!DOCTYPE html>

<html lang="th">

<head>
    <title><?= $site['title'] ?></title>
    <meta charset="utf-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="สล็อต, สล็อตออนไลน์, เกมสล็อตมือถือ, สล็อตแจกเครดิตฟรี, เกมสล็อต, slotgame66, เกมส์slot, สล็อตออนไลน์ฟรี, เกมส์สล็อตมือถือ, สล็อตฟรีเครดิต, แจกเครดิตฟรีเล่นสล็อต, สล็อต, slot, สล็อตออโต้, สล็อตระบบออโต้, slot auto, sagame, sagaming, slotpg, gamingsoft, คาสิโน, คาสิโนออนไลน์, sexy baccarat">
    <meta name="description" content="slotgame66 เราคือเจ้าแรกที่ทำระบบ สล็อตออนไลน์ ไม่ต้องโหลดแอพ เล่นได้ทันทีฝาก-ถอน AUTO แจกเครดิตฟรี 500 user ทุกวัน เกมส์สล็อต บนมือถือ">
    <meta name="author" content="SLOTGAME66">
    <link rel="icon" type="image/ico" href="<?= $site['host'] ?>/assets/sl66/images/icon.png"> -->
    <!--Cache-->
    <!-- <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0"> -->
    <!-- Facebook OG -->
    <!-- <meta property="og:url" content="<?= $site['host'] ?>">
    <meta property="og:type" content="game">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">
    <link rel="icon" href="<?= $site['host'] ?>/assets/img/favicons/favicon.ico">
    <meta name="csrf-token" content="t9AUEbD5Smmzfon3lfE3V2rIuK7zM01x1e6qYMBS"> -->

    <!-- core CSS -->
    <!-- Online CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.16/css/bootstrap-select.min.css" integrity="sha256-g19F2KOr/H58l6XdI/rhCdEK3NmB8OILHwP/QYBQ8M4=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" integrity="sha256-PHcOkPmOshsMBC+vtJdVr5Mwb7r0LkSVJPlPrp/IMpU=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3/dist/vue-loading.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" integrity="sha256-2bAj1LMT7CXUYUwuEnqqooPb1W0Sw0uKMsqNH0HwMa4=" crossorigin="anonymous" />

    <!-- Local CSS -->
    <link rel="stylesheet" href="<?= $site['host'] ?>/assets/sl66/icons/icon.min.css">
    <link rel="stylesheet" href="<?= $site['host'] ?>/assets/sl66/css/thbank/thbanklogos.css">
    <link rel="stylesheet" href="<?= $site['host'] ?>/assets/sl66/css/thbank/thbanklogos-colors.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= $site['host'] ?>/assets/sl66/css/style-dashboardv5.css">


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
                                <li><a href="<?= $site['host'] ?>/auth/login"><i class="far fa-user-plus"></i>
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
                    <section class="register"><a href="<?= $site['host'] ?>/auth/login" class="float-right btn btn-outline-red"><i class="far fa-sign-in-alt"></i>
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
                                    <input name="aff_upline" id="aff_upline" type="hidden">
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
            <footer class="text-muted">
                <div class="container text-center">
                    <p>CopyRight © 2019, Slotgame66.com</p>
                </div>
            </footer>
            <div class="fix-nav-bottom">
                <div class="fix-nav-bottom">
                    <div class="scroll-text">
                        <marquee scrolldelay="100" onmouseover="this.stop();" onmouseout="this.start();" behavior="" direction=""><a>เกมส์สล๊อตออนไลน์ เกมส์ออนไลน์ ได้เงินจริงได้เงินไว เกมส์สล๊อตออนไลน์ที่ดีที่สุดตอนนี้ SLOTGAME66.COM ภาพเกมส์แบบใหม่ที่ภาพกราฟฟิคสวยงามสมจริง สามารถเล่นผ่านเว็บบราวเซอร์</a></marquee>
                    </div>
                    <div class="container pr-0 pl-0">
                        <ul>
                            <li><a href="<?= $site['host'] ?>" class="hvr-buzz-out"><i class="fal fa-home"></i>
                                    <p>หน้าแรก</p>
                                </a></li>
                            <li><a href="<?= $site['host'] ?>/promotion" class="hvr-buzz-out"><i class="fal fa-gift"></i>
                                    <p>โปรโมชั่น</p>
                                </a></li>
                            <li class="fix-nav-bottom-play"><a href="<?= $site['host'] ?>/demo" class="hvr-buzz-out"><i class="fal fa-play"></i>
                                    <p>ทดลองเล่น</p>
                                </a></li>
                            <li><a href="<?= $site['host'] ?>" class="hvr-buzz-out"><i class="fab fa-line"></i>
                                    <p>ติดต่อเรา</p>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.7/holder.min.js" integrity="sha256-CPLvnJ0LSBm+lJAUh4bBMpJ1lUa3QsTfdgCAUHyBv2w=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.16/js/bootstrap-select.min.js" integrity="sha256-COIM4OdXvo3jkE0/jD/QIEDe3x0jRuqHhOdGTkno3uM=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js" integrity="sha256-zUQGihTEkA4nkrgfbbAM1f3pxvnWiznBND+TuJoUv3M=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3.3.2/dist/vue-loading.min.js" integrity="sha256-Ku+FjJnSLHZRaPUDmql8GAnZVGyzfyZQeM6S32ISNII=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js" integrity="sha256-2RS1U6UNZdLS0Bc9z2vsvV4yLIbJNKxyA4mrx5uossk=" crossorigin="anonymous"></script>
    <script src="<?= $site['host'] ?>/assets/sl66/js/v14/app.js"></script>

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
                        source: source
                    },
                    success: function(data) {
                        if (data.code == "200") {
                            swal.fire('Success!!!!', 'ยินดีต้อนรับสมาชิกใหม่ค่ะ', 'success');
                            setTimeout((function() {
                                window.location.href = "<?=$site['host']?>/user/dashboard";                                                           
                            }), 3000);
                            //location.reload();
                            // Go to profile or dashboard page
                            // Coding here...
                        }                        
                        if (data.code == "400") {
                            swal.fire('ข้อมูลซ้ำ', data.msg, 'error');
                        } 
                        if (data.code == "401") {
                            swal.fire('ข้อมูลไม่สมบูรณ์', data.msg, 'error');
                        } 
                        if (data.code == "402") {
                            swal.fire('ข้อมูลไม่ถูกต้อง', data.msg, 'error');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>