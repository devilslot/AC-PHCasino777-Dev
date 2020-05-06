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
    $_SESSION['pwd'] = $row_getuser['member_password'];
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
            <div class="slide-img d-none d-md-block"><img src="<?= $site['host'] ?>/assets/sl66/images/slide-img.jpg" alt=""></div>
            <div class="slide-img d-block d-md-none"><img src="<?= $site['host'] ?>/assets/sl66/images/slide-img-mobile.jpg" alt=""></div>
        </section>

        <div id="app">
            <main role="main">
                <div class="container content">

                    <section class="user-infor text-center">
                        <div class="user-info-desktop d-none d-md-block"><a>รหัสสมาชิกของคุณคือ: <?= $row_getuser['member_username'] ?></a> <br> <span onclick="window.location.href = '<?= $site['host'] ?>/user/password';" class="reset-password"><i class="far fa-key"></i> เปลี่ยนรหัสผ่าน</span></div>
                        <div class="user-info-mobile d-block d-sm-block d-md-none"><a>รหัสสมาชิกของคุณคือ: <?= $row_getuser['member_username'] ?></a> <br> <span onclick="window.location.href = '<?= $site['host'] ?>/user/password';" class="reset-password"><i class="far fa-key"></i> เปลี่ยนรหัสผ่าน</span></div>
                    </section>
                    <div>
                        <section class="credit">
                            <div class="credit-box">
                                <div class="amount-box float-left"><small>ยอดเงินคงเหลือ</small> <small class="float-right mr-3"><i title="อัพเดทยอดเงิน" class="fas fa-sync-alt refresh pointer animated"></i></small>
                                    <p class="amount">9.50</p>
                                </div>
                                <div class="button-box float-left"><a href="<?= $site['host'] ?>/user/deposit" class="btn-block btn-gold"><i class="fal fa-wallet"></i> ฝากเงิน</a> <a href="<?= $site['host'] ?>/user/withdraw" class="btn-block btn-silver"><i class="fal fa-hand-holding-usd"></i> ถอนเงิน</a></div>
                                <div class="clearfix"></div>
                            </div>
                        </section>
                        <!---->
                    </div>



                    <section class="navigation">
                        <div class="nav-play-button"><a href="<?= $site['host'] ?>/game" class="btn-block play-button text-center hvr-buzz-out"><i class="far fa-play"></i>
                                <p>เข้าเล่นเกมส์</p>
                            </a></div>
                        <div class="nav-other-button">
                            <div class="other-list other-list-full"><a href="<?= $site['host'] ?>/user/affiliate" class="btn-dark-tri hvr-buzz-out"><i class="fal fa-users"></i>
                                    <p>แนะนำเพื่อนรับค่าคอม</p>
                                </a></div>
                            <div class="other-list other-list-1"><a href="<?= $site['host'] ?>/user/bonus" class="btn-dark-tri hvr-buzz-out"><i class="fal fa-gift"></i>
                                    <p>รับโบนัสพิเศษ</p>
                                </a></div>
                            <div class="other-list other-list-2"><a href="<?= $site['host'] ?>/user/reward" class="btn-dark-tri hvr-buzz-out"><i class="fas fa-star"></i>
                                    <p>รางวัลประจำเดือน</p>
                                </a></div>
                            <div class="other-list other-list-1"><a href="<?= $site['host'] ?>/user/refund" class="btn-dark-tri hvr-buzz-out"><i class="fas fa-donate"></i>
                                    <p>รับเงินคืน</p>
                                </a></div>
                            <div class="other-list other-list-2"><a class="btn-dark-tri hvr-buzz-out"><i class="fas fa-spade"></i>
                                    <p>เปิดไพ่ลุ้นรางวัล</p>
                                </a></div>
                            <div class="other-list other-list-3"><a href="<?= $site['host'] ?>/user/history" class="btn-dark-tri hvr-buzz-out"><i class="fal fa-list-alt"></i>
                                    <p>ประวัติการเงิน</p>
                                </a></div>
                            <div class="other-list other-list-4"><a href="<?= $site['host'] ?>/user/line" class="btn-dark-tri hvr-buzz-out"><i class="fab fa-line"></i>
                                    <p>ติดต่อเจ้าหน้าที่</p>
                                </a></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </section>
                    <div></div>
                </div>
            </main>
            <?php include(__DIR__ . '/../include/foot-nav-sl66-dashboard.php') ?>
        </div>
    </div>
    <?php include(__DIR__ . '/../include/footer-sl66.php'); ?>
</body>

</html>