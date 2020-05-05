<?php

session_start();


require_once 'dbmodel.php';
require_once 'function.php';

$site = include(__DIR__ . '/config/site.php');
$pg = include(__DIR__ . '/config/pg.php');

include(__DIR__ . "/captcha/simple-php-captcha.php");
//require_once __DIR__ . '/captcha/simple-php-captcha.php"';
$_SESSION['captcha'] = simple_php_captcha();

$bank_list = $mysqli->query("SELECT * FROM master_bank ORDER BY id");
$num_row = mysqli_num_rows($bank_list);

?>

<!DOCTYPE html>
<html class="js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" lang="th">

<head>
    <!-- Title -->
    <title>
        <?= $site['title'] ?>
    </title>

    <!-- ************************* CSS Files ************************* -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="/assets/css/font-awesome.min.css"> -->

    <!-- Elegent Icon CSS -->
    <link rel="stylesheet" href="/assets/css/elegent-icons.css">

    <!-- All Plugins CSS css -->
    <link rel="stylesheet" href="/assets/css/plugins.css">

    <!-- style css -->
    <link rel="stylesheet" href="/assets/css/main.css">

    <!-- toastr css -->
    <link rel="stylesheet" href="/assets/css/toastr.min.css">

    <!-- SweetAlert2 <link rel="stylesheet" href="/assets/css/sweetalert2.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.js"></script>

    <!-- jQuery <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>

    <style>
        .field-icon {
            float: right;
            margin-left: 0px;
            margin-top: -38px;
            position: relative;
            z-index: 2;
        }
    </style>
</head>

<body>
    <!-- Main Wrapper Start -->
    <div class="wrapper bg--shaft">
        <!-- 1st Main Content Wrapper Start -->
        <div class="main-content-wrapper ">
            <div class="container login-register-area">
                <form id="register_form">
                    <div class="form-group">
                        <label for="phone">เบอร์โทรศัพท์</label>
                        <input type="text"  class="form__input form__input--2" id="phone" name="phone" maxlength="10" placeholder="กรุณากรอกเบอร์โทรศัพท์">
                    </div>
                    <div class="form-group">
                        <label for="password" onclick="showPassword()">รหัสผ่าน</label>
                        <input type="password"  class="form__input form__input--2" id="password-field" maxlength="24" name="password" placeholder="โปรดใส่รหัสผ่าน">
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password fa-2x"></span>
                        <!--
                        <input id="password-field" type="password" class="form-control" name="password" value="secret">
                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                        -->
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="name">ชื่อ</label>
                            <input type="text"  class="form__input form__input--2" id="firstname" name="firstname" placeholder="ชื่อจริง">
                        </div>
                        <div class="col">
                            <label for="name">นามสกุล</label>
                            <input type="text"  class="form__input form__input--2" id="lastname" name="lastname" placeholder="นามสกุล">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="banknumber">หมายเลขบัญชีธนาคาร</label>
                        <input type="text" class="form__input form__input--2" id="bankaccount" maxlength="15"  name="bankaccount" placeholder="หมายเลขบัญชีธนาคาร">
                        <small id="infomation" class="form-text text-muted ">
                            ชื่อและนามสกุลของบัญชีต้องตรงกับที่กรอกมา
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="banktype">ธนาคาร</label>
                        <select class="form__input form__input--2" id="bankcode"  name="bankcode">
                            <?php
                                foreach ($bank_list as $row) {
                                    echo '<option value="' . $row['bank_code'] . '">' . $row['short_name'] . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lineid">Line ID</label>
                        <input type="text" class="form__input form__input--2" id="lineid"  name="lineid" placeholder="หากไม่มีไลน์ ให้ใส่เบอร์มือถือแทน">
                    </div>
                    <div class="form-group">
                        <label for="captcha">
                            <img src="<?= $_SESSION['captcha']['image_src'] ?>" class="img-fluid">
                        </label> CAPTCHA
                        <input type="text" class="form__input form__input--2" id="captcha"  name="captcha" placeholder="กรอกตัวอักษร (CAPTCHA) ในรูปที่ท่านเห็น">
                    </div>
                    <input type="hidden" name="aff" value="">
                    <button type="submit" class="btn btn-style-2">ลงทะเบียน</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Main Wrapper End -->

    <!-- ************************* JS Files ************************* -->

    <?php
    include(__DIR__ . '/include/footer_js.php');
    ?>

    <script>
        $("#register_form").submit(function(e) {
            //sayHi();
            e.preventDefault();
            $.post('/exec/register.php', $(this).serialize(), function(data) {
                $("#alerts").html(data)
            });
            return false;
        });
    </script>
    <script>
        function showPassword() {
            var x = document.getElementById("password-field");

            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
    <script>
        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var passValue = document.getElementById("password-field");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

    </script>

</body>

</html>