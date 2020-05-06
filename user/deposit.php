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
                                <li><a href="<?=$site['host']?>"><i class="far fa-home"></i>
                                        <p>หน้าแรก</p>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-8 text-center">
                        <img class="header-logo" src="<?=$site['host']?>/assets/sl66/images/logo-dashboard.png" alt="">
                    </div>
                    <div class="col-2 p-0">
                        <div class="top-nav">
                            <ul>
                                <li><a href="<?=$site['host']?>/logout"><i class="far fa-power-off"></i>
                                        <p>ออกจากระบบ</p>
                                    </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section class="slide">
            <div class="slide-img d-none d-md-block"><img src="<?=$site['host']?>/assets/sl66/images/slide-img.jpg?v=1" alt=""></div>
            <div class="slide-img d-block d-md-none"><img src="<?=$site['host']?>/assets/sl66/images/slide-img-mobile.jpg?v=1" alt=""></div>
        </section>

        <div id="app">
            <main role="main">
                <div class="container content">
                    <div>
                        <section class="credit">
                            <div class="credit-box">
                                <div class="amount-box float-left"><small>ยอดเงินคงเหลือ</small> <small class="float-right mr-3"><i title="อัพเดทยอดเงิน" class="fas fa-sync-alt refresh pointer animated"></i></small>
                                    <p class="amount">9.50</p>
                                </div>
                                <div class="button-box float-left"><a href="<?=$site['host']?>/user/deposit" class="btn-block btn-gold"><i class="fal fa-wallet"></i> ฝากเงิน</a> <a href="<?=$site['host']?>/user/withdraw" class="btn-block btn-silver"><i class="fal fa-hand-holding-usd"></i> ถอนเงิน</a></div>
                                <div class="clearfix"></div>
                            </div>
                        </section>
                        <!---->
                    </div>
                    <section class="depositChanel mt-4 mb-4">
                        <div id="bank-button" onclick="showBank();" class="bank-box kbank"><img src="<?=$site['host']?>/assets/sl66/images/bank/kbank-logo.png" class="mw-100"></div>
                        <div id="wallet-button" onclick="showWallet();" class="wallet-box true grayscale"><img src="<?=$site['host']?>/assets/sl66/images/truewallet.png" class="mw-100"></div>
                        <div class="clearfix"></div>
                    </section>
                    <section id="bank" class="bank-info animated fadeIn" style="display: block;">
                        <div class="row">
                            <div class="col-sm-6 bank-info-text text-center"><small>ชื่อบัญชี</small>
                                <p class="bank-acc-name">ปรารถนา รอดนุช</p>
                            </div>
                            <div class="col-sm-6 bank-info-text text-center"><small>เลขบัญชีธนาคาร</small>
                                <p id="account-18" class="bank-acc-num">0653887671</p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div onclick="copyToClipboard('account-18')" class="col-12 bank-info-copy"><a class="btn-block btn-zinc copy-button text-center">
                                    <p><i class="far fa-copy"></i> คัดลอกเลขบัญชี</p>
                                </a></div>
                        </div>
                        <div class="card bank-info mt-4">
                            <h5 class="card-header">ใช้บัญชีด้านล่างสำหรับการฝากเงินเท่านั้น</h5>
                            <div class="card-body">
                                <div class="bank-user-logo"><i aria-hidden="true" class="thbanks thbanks-kbank"></i></div>
                                <div class="bank-user-info">
                                    <p id="bank-user-bankname">ธนาคาร: กสิกรไทย</p>
                                    <p id="bank-user-name">ชื่อบัญชี: กิตติศักดิ์ เหมาะสิงห์</p>
                                    <p id="bank-user-number">เลขบัญชี: 0643613921</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="wallet" class="true-wallet animated fadeIn" style="display: none;">
                        <div class="row">
                            <div class="col-sm-6 bank-info-text text-center"><small>ชื่อบัญชี</small>
                                <p class="bank-acc-name">จุฬารัตน์ สุไตทอน</p>
                            </div>
                            <div class="col-sm-6 bank-info-text text-center"><small>เบอร์ TrueWallet</small>
                                <p id="wallet-id" class="bank-acc-num truewallet-text">0972527742</p>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div onclick="copyToClipboard('wallet-id')" class="col-12 bank-info-copy"><a class="btn-block btn-zinc copy-button text-center">
                                    <p><i class="far fa-copy"></i> คัดลอกเบอร์ TrueWallet</p>
                                </a></div>
                        </div>
                        <div class="text-center wallet-announce"><a>หากยอดเงินไม่เข้าภายใน 30 วินาทีกรุณากดแจ้งฝากเงิน TrueWallet</a></div>
                        <div><a class="btn-block btn-truewallet"><i class="fal fa-wallet"></i> แจ้งฝากเงิน TrueWallet
                            </a>
                            <!---->
                        </div>
                    </section>
                    <section class="history-link mt-3">
                        <div class="row">
                            <div class="col-12 text-center"><a href="<?=$site['host']?>/user/history" class="history-link-text">ดูประวัติการฝากเงิน <i class="fal fa-list-alt"></i></a></div>
                        </div>
                    </section>
                </div>
            </main>
            <?php include(__DIR__ . '/../include/foot-nav-sl66.php') ?>
        </div>

        <script>
            function showgames() {
                var x = document.getElementById("gameslist");
                var y = document.getElementById("show");
                var z = document.getElementById("hide");
                if (x.style.display === "none") {
                    x.style.display = "block";
                    z.style.display = "block";
                    y.style.display = "none";
                } else {
                    x.style.display = "none";
                    y.style.display = "block";
                    z.style.display = "none";
                }
            }
        </script>
        <?php include(__DIR__ . '/../include/footer-sl66.php'); ?>
    </div>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script> -->

    <script>
        function copyToClipboard(elementId) {
            var aux = document.createElement("input");
            aux.setAttribute("value", document.getElementById(elementId).innerHTML);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");
            document.body.removeChild(aux);
            Swal.fire({
                type: 'success',
                title: "คัดลอกแล้ว",
                showConfirmButton: false,
                timer: 1500
            })
        }

        function showBank() {
            var v = document.getElementById("bank-button");
            var w = document.getElementById("wallet-button");
            var x = document.getElementById("bank");
            var z = document.getElementById("wallet");
            if (x.style.display === "none") {
                x.style.display = "block";
                z.style.display = "none";
                v.classList.remove("grayscale");
                w.classList.add("grayscale");
            } else {

            }
        }

        function showWallet() {
            var v = document.getElementById("bank-button");
            var w = document.getElementById("wallet-button");
            var x = document.getElementById("bank");
            var z = document.getElementById("wallet");
            if (z.style.display === "none") {
                x.style.display = "none";
                z.style.display = "block";
                v.classList.add("grayscale");
                w.classList.remove("grayscale");
            } else {

            }
        }
    </script>

</body>

</html>