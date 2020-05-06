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
                    <section class="user-infor text-center">
                        <div class="user-info-desktop mb-1"><a>รหัสสมาชิกของคุณคือ: SLG6678563</a> <br></div>
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
                        <div></div>
                        <div>
                            <div class="games-nav mt-3">
                                <div class="games-nav-list games-nav-list-first "><img src="/public/images/games-nav/nav-slot-red.png" class="w-100 pointer"></div>
                                <div class="games-nav-list"><img src="/public/images/games-nav/nav-fish.png" class="w-100 pointer"></div>
                                <div class="games-nav-list"><img src="/public/images/games-nav/nav-casino.png" class="w-100 pointer"></div>
                                <div class="games-nav-list games-nav-list-last "><img src="/public/images/games-nav/nav-sport.png" class="w-100 pointer"></div>
                                <div class="clearfix"></div>
                            </div>
                            <section class="select-game mt-3 animated fadeIn">
                                <div class="select-game-list mb-3"><a class="hvr-buzz-out pointer"><img src="/public/images/games-launcher/play-slot-gss.jpg" class="w-100"></a></div>
                                <div class="select-game-list mb-3"><a class="hvr-buzz-out pointer"><img src="/public/images/games-launcher/play-slot-pg.jpg" class="w-100"></a></div>
                                <div class="select-game-list mb-3"><a class="hvr-buzz-out pointer"><img src="/public/images/games-launcher/play-slot-sa.jpg" class="w-100"></a></div>
                                <div class="select-game-list"><a class="hvr-buzz-out pointer"><img src="/public/images/games-launcher/play-slot-ag.jpg" class="w-100"></a></div>
                                <div class="clearfix"></div>
                            </section>
                            <section class="select-game mt-3 animated fadeIn" style="display: none;">
                                <div class="select-game-list mb-3"><a class="hvr-buzz-out pointer"><img src="/public/images/games-launcher/play-fish-pg.jpg" class="w-100"></a></div>
                                <div class="select-game-list"><a class="hvr-buzz-out pointer"><img src="/public/images/games-launcher/play-fish-sa.jpg" class="w-100"></a></div>
                                <div class="clearfix"></div>
                            </section>
                            <section class="select-game mt-3 animated fadeIn" style="display: none;">
                                <div class="select-game-list mb-3"><a class="hvr-buzz-out pointer"><img src="/public/images/games-launcher/play-casino-ag.jpg" class="w-100"></a></div>
                                <div class="select-game-list mb-3"><a class="hvr-buzz-out pointer"><img src="/public/images/games-launcher/play-casino-sexy.jpg" class="w-100"></a></div>
                                <div class="select-game-list mb-3"><a class="hvr-buzz-out pointer"><img src="/public/images/games-launcher/play-casino-sa.jpg" class="w-100"></a></div>
                                <div class="select-game-list"><a class="hvr-buzz-out pointer"><img src="/public/images/games-launcher/play-casino-pretty.jpg" class="w-100"></a></div>
                                <div class="clearfix"></div>
                            </section>
                            <section class="select-game mt-3 animated fadeIn" style="display: none;">
                                <div class="select-game-list"><a class="hvr-buzz-out pointer"><img src="/public/images/games-launcher/play-sport-bti.jpg" class="w-100"></a></div>
                                <div class="clearfix"></div>
                            </section>
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
                            <li><a href="<?=$site['host']?>/user/dashboard" class="hvr-buzz-out"><i class="fal fa-user-secret"></i>
                                    <p>ข้อมูลสมาชิก</p>
                                </a></li>
                            <li><a href="<?=$site['host']?>/user/deposit" class="hvr-buzz-out"><i class="fal fa-wallet"></i>
                                    <p>ฝากเงิน</p>
                                </a></li>
                            <li><a href="<?=$site['host']?>/user/withdraw" class="hvr-buzz-out"><i class="fal fa-hand-holding-usd"></i>
                                    <p>ถอนเงิน</p>
                                </a></li>
                            <li class="fix-nav-bottom-active"><a href="<?=$site['host']?>/game" class="hvr-buzz-out"><i class="fal fa-play"></i>
                                    <p>เข้าเล่นเกมส์</p>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
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


        <!-- Bootstrap core JavaScript
================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script>
            window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')
        </script>
        <script src="<?=$site['host']?>/assets/sl66/js/vendor/popper.min.js"></script>
        <script src="<?=$site['host']?>/assets/sl66/js/bootstrap.min.js"></script>
        <script src="<?=$site['host']?>/assets/sl66/js/vendor/holder.min.js"></script>
        <script src="<?=$site['host']?>/assets/sl66/js/v14/app.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.0-beta/js/bootstrap-select.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics 
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154712426-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-154712426-1');
</script>
-->
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-155235476-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-155235476-1');
        </script>




    </div>

</body>

</html>