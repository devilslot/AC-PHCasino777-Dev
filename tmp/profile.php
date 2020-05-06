<?php

session_start();


require_once 'dbmodel.php';
require_once 'function.php';

$site = include(__DIR__ . '/config/site.php');
$pg = include(__DIR__ . '/config/pg.php');
include(__DIR__ . '/checklogin.php');

$data_members = $mysqli->query("SELECT * FROM members WHERE member_login = '" . $_SESSION['member_login'] . "'")->fetch_assoc();

if (count($data_members) > 0) {
    //echo "<BR>".$data_members['member_login']."<BR>";
} else {
    exit();
}
$_SESSION['level'] = $data_members['member_level'];
$_SESSION['member_no'] = $data_members['member_no'];

$web_lobby_url = "";
$web_lobby_url .= $pg['web_lobby'];
$web_lobby_url .= "operator_token=" . $pg['operator_token'] . "&";
$web_lobby_url .= "operator_player_session=" . urlencode($_SESSION['member_login']) . "&";
$web_lobby_url .= "language=" . $pg['language'];
$web_lobby_url .= "";

$data_member_wallet = $mysqli->query("SELECT * FROM member_wallet WHERE member_no = " . $data_members['member_no'])->fetch_assoc();

$total_wallet = $data_member_wallet['main_wallet'] + $data_member_wallet['bonus_wallet'] + $data_member_wallet['commission_wallet'];
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <?php
    include(__DIR__ . '/include/head.php');
    ?>
    <link rel="stylesheet" href="/assets/css/style.min.css">
</head>

<body>
    <!-- Header -->
    <button onclick="window.location.href='<?php echo $site['host'] . '/logout' ?>';">ออกจากระบบ</button>
    <button onclick="window.open('<?php echo $site['host'] . '/trial-lobby' ?>','_blank');">ทางเข้าเล่น</button>
    <button onclick="window.location.href='<?php echo $site['host'] . '/promo' ?>';">โปรโมชั่น</button>
    <BR>

    <!-- Main -->
    <main class="main">
        <!-- Banner -->
        <!-- Content -->
        <section class="content">
            <div class="container">
                <div class="card card-content">
                    <!-- profile -->
                    <div class="profile card-body">
                        <h3 class="card-title">ข้อมูลบัญชี</h3>
                        <!-- Show Credit-->
                        <?php
                        //include(__DIR__.'/include/show_credit.php');
                        ?>
                        <div class="card card-body card-form p-lg-5">
                            <p class="text-center " style="color:#495057">เครดิตคงเหลือ : <?= $total_wallet ?></p>
                        </div>
                        <form action="/" class="card card-body card-form p-lg-5">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><img src="./assets/images/password.png" alt=""></span>
                                </div>
                                <span class="form-control">ยูสเซอร์ :</span>
                                <input type="text" class="form-control" value="<?php echo $data_members['member_username']; ?>" disabled>
                            </div>
                            <div class="input-group mb-3" onclick="passwordToggle()">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><img src="./assets/images/password.png" alt=""></span>
                                </div>
                                <span class="form-control">พาสเวิร์ด :</span>
                                <input id="passwordInput" type="password" class="form-control" value="<?php echo $data_members['member_password']; ?>" disabled>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><img src="./assets/images/plus.png" alt=""></span>
                                </div>
                                <span class="form-control">ชื่อ-นามสกุล :</span>
                                <input type="text" class="form-control" value="<?php echo $data_members['member_name'] . ' ' . $data_members['member_surname']; ?>" disabled>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><img src="./assets/images/phone.png" alt=""></span>
                                </div>
                                <span class="form-control">เบอร์โทร :</span>
                                <input type="tel" class="form-control" value="<?php echo $data_members['member_phone']; ?>" disabled>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><img src="./assets/images/bank-number.png" alt=""></span>
                                </div>
                                <span class="form-control">เลขบัญชี :</span>
                                <input type="text" class="form-control" value="<?php echo $data_members['member_bank_number']; ?>" disabled>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><img src="./assets/images/bank.png" alt=""></span>
                                </div>
                                <span class="form-control">ธนาคาร :</span>
                                <input type="text" class="form-control" value="<?php echo bank_name($data_members['member_bank_name']); ?>" disabled>
                            </div>
                        </form>
                    </div>
                    <div class="transaction card-body">
                        <h3 class="card-title">ลิงค์แนะนำเพื่อน</h3> <?= $site['host'] ?>/aff?<?= $_SESSION['member_login'] ?>
                    </div>
                    <div class="transaction card-body">
                        <h3 class="card-title">โปรโมชั่น</h3>
                        <input type="button" onclick="location.href='<?= $site['host'] ?>/promo';" value="เลือกโปรโมชั่น" />
                    </div>
                </div>
            </div>
        </section>


    </main>

    <!-- JS -->
    <?php
    include(__DIR__ . '/include/footer_js.php');
    ?>


    <script src="/util/utility.js"></script>

    <script>
        $("#register_form").submit(function(e) {
            e.preventDefault();
            $.post('/exec/register.php', $(this).serialize(), function(data) {
                $("#alerts").html(data)
            });
            return false;
        });
    </script>


    <script>
        function passwordToggle() {
            var x = document.getElementById("passwordInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>



</body>

</html>