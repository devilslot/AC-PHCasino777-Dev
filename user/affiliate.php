<?php

session_start();
include(__DIR__ . '/../checklogin.php');

require_once '../dbmodel.php';
require_once '../function.php';

$site = include(__DIR__ . '/../config/site.php');
$pg = include(__DIR__ . '/../config/pg.php');

// if ($_GET['task'] !== NULL) {
//     $aff_task = $_GET('task');
// }

$sql_text = "SELECT * FROM members WHERE member_login='" . trim($_SESSION['member_login']) . "'";
$row_getuser = $mysqli->query($sql_text)->fetch_assoc();
$aff_link = $site['host'] . "/register?aff=" . $row_getuser['member_login'];

?>

<!DOCTYPE html>

<html lang="th" style="background-image: url(<?= $site['host'] ?>/assets/sag66/images/bg-sa-1.jpg);
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-position: center top;">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Sagame66 คาสิโนออนไลน์ สล็อตออนไลน์ ฝาก-ถอน AUTO 30 วินาที</title>

    <link rel="shortcut icon" type="image/png" href="<?= $site['host'] ?>/assets/sag66/images/logo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="ตัวแทนตรง SAgaming รวมคาสิโนออนไลน์ บาคาร่า เสือมังกร ไฮโล รูเล็ต สล็อต slot  live casino กำถั่ว คาสิโนสด ฝาก-ถอนระบบอัติโนมัติ ดีที่สุด sagame66 ระบบเล่นง่าย แจกเป็นล้านทุกวัน">
    <meta property="og:type" content="Game">
    <meta property="og:title" content="Sagame66 คาสิโนออนไลน์ สล็อตออนไลน์ ฝาก-ถอน AUTO 30 วินาที">
    <meta property="og:description" content="ตัวแทนตรง SAgaming รวมคาสิโนออนไลน์ บาคาร่า เสือมังกร ไฮโล รูเล็ต สล็อต slot  live casino กำถั่ว คาสิโนสด ฝาก-ถอนระบบอัติโนมัติ ดีที่สุด sagame66 ระบบเล่นง่าย แจกเป็นล้านทุกวัน">
    <meta property="og:site_name" content="SAGAME66 คาสิโนที่ดีที่สุด สมัครเล่นรับโบนัสทันที 50%">
    <meta property="og:image" content="<?= $site['host'] ?>/assets/sag66/images/img_sagame66.png">
    <meta property="og:image:secure_url" content="<?= $site['host'] ?>/assets/sag66/images/img_sagame66.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Sagame66 คาสิโนออนไลน์ สล็อตออนไลน์ ฝาก-ถอน AUTO 30 วินาที">
    <meta name="twitter:description" content="ตัวแทนตรง SAgaming รวมคาสิโนออนไลน์ บาคาร่า เสือมังกร ไฮโล รูเล็ต สล็อต slot  live casino กำถั่ว คาสิโนสด ฝาก-ถอนระบบอัติโนมัติ ดีที่สุด sagame66 ระบบเล่นง่าย แจกเป็นล้านทุกวัน">
    <meta name="twitter:image" content="<?= $site['host'] ?>/assets/sag66/images/img_sagame66.png">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css" integrity="sha256-2bAj1LMT7CXUYUwuEnqqooPb1W0Sw0uKMsqNH0HwMa4=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" integrity="sha256-Vzbj7sDDS/woiFS3uNKo8eIuni59rjyNGtXfstRzStA=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt:200,400,600&amp;display=swap">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= $site['host'] ?>/assets/sag66/css/icons/icon.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= $site['host'] ?>/assets/sag66/dist/style.css">
    <link rel="stylesheet" type="text/css" href="<?= $site['host'] ?>/assets/sag66/css/parsley.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">
</head>

<body onload="getAffInfo()">
    <header class="head-logo">
        <hgroup>
            <a href="https://sagame66.com/"><img class="mw-100 " src="<?= $site['host'] ?>/assets/sag66/images/logo_last.png" alt="เว็บคาสิโนออนไลน์ที่ดีที่สุด SAGAME66" style="height: 115px;"></a>

            <a href="https://sagame66.com/"><img src="<?= $site['host'] ?>/assets/sag66/images/AUTO.png" alt="เว็บคาสิโนออนไลน์ที่ดีที่สุด SAGAME66" class="sec30" style="float: right; width: 30%"></a>
        </hgroup>
    </header>

    <nav>
        <span class="triangle-left"></span>
        <span class="navl"></span>
        <span class="call">
            <a href="play.php" target="blank" class="btn btn-green menu-demo"><i class="fas fa-play"></i> เข้าเล่น</a>
            <a href="login.php" class="btn btn-gold"><i class="fas fa-user"></i> ข้อมูลสมาชิก</a>
            <a href="logout.php" class="btn btn-silver"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
        </span>

        <ul class="desktop-menu">
            <li class="page_home "><a href="dashboard"><i class="fas fa-home"></i> หน้าหลัก</a></li>
            <li class="page_item "><a href="promotion.php"><i class="fas fa-gift"></i> โปรโมชั่น</a></li>
            <li class="page_item "><a href="affiliate"><i class="fas fa-users"></i> แนะนำเพื่อน</a></li>
            <li class="page_home "><a href="/game" target="_blank" class="playgame"><i class="fas fa-play"></i> เข้าเล่น</a></li>
            <li class="page_item "><a href="contact.php"><i class="fas fa-phone"></i> ติดต่อเรา</a></li>
            <li class="page_item btn-logout"><a href="/logout">ออกจากระบบ <i class="fas fa-sign-out-alt"></i></a></li>
        </ul>

        <span class="triangle-right"></span>
    </nav>
    <div class="container">
        <div class="row mt-2 mb-4">
            <div class="col-12">
                <a href="play.php" target="blank" class="btn btn-block menu-demo-mobile btn-menu-demo-mobile"><i class="fas fa-play"></i> เข้าเล่น</a>
            </div>
        </div>
    </div>


    <div>
        <div class="jR3DCarouselGallery"></div>
    </div>
    <script type="text/javascript">
        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
    </script>
    <!--  -->


    <article>
        <section id="post-1" class="post-1 post type-post status-publish format-standard hentry category-home">
            <h1 class="entry-title"><span class="icon-bar"></span>แนะนำเพื่อน รับทันที <?= $site['aff_comm_level_1'] ?>% ของยอดได้เสียของคนแนะนำ</h1>



            <div class="col-md-12 xcol-md-offsetx-2">
                <div class="card card-primary">
                    <div class="card-header ]-info" style="background: #479988; color: white">
                        แนะนำเพื่อน อัพเดทล่าสุด 2020-02-04 08:36:50 </div>
                    <div class="card-body">


                        <!-- <div id="linkaff_" style="display: none;"><?=$aff_link?></div> -->
                        <form method="POST">
                            <input type="hidden" name="task" value="aff_to">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Link แนะนำ </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="aff_link" value="<?=$aff_link?>" readonly="readonly" onclick="cpToClipboard()">
                                </div>
                                <div class="col-sm-2">
                                    <a style="displayx: none; color: white" class="btn btn-block btn-dark-green btn- lg btn-co py ml-0" onclick="cpToClipboard()"><i class="far fa-copy"></i> คัดลอก link</a>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">จำนวนเพื่อนที่แนะนำ ลำดับที่ 1</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="count_l1" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">จำนวนเพื่อนที่แนะนำ ลำดับที่ 2</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="count_l2" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">จำนวนเครดิตแนะนำ</label>
                                <div class="col-sm-10">
                                    <input type="text" id="aff_total" class="form-control" readonly="readonly">
                                </div>
                            </div>

                            <center>
                                <button type="button" class="btn btn-danger" onclick="getAffInfo();" style=" font-size: 18px;">อัพเดตยอดแนะนำ</button>
                                <div id="countDownDiv" />
                                <!-- id="aff_refresh" -->
                            </center>
                            <br>

                            <center> <b style="color: red">ต้องมี จำนวนเครดิตแนะนำ มากกว่า 500 จะโอนเงินเข้ากระเป๋าหลักได้คะ</b></center>



                        </form>

                        <center style=" : none;"><a href="banner.php" class="btn btn-info" style="color: white; font-size: 18px; margin-top: 5px;"> &gt;&gt; รับ banner ไปโปรโมท &lt;&lt; </a></center>
                        <div style="font-size: 20px; text-align:center;display: none;">
                            ระบบแนะนำเพื่อนรับ <span style="color: green; font-weight: bold;font-size: 20px">0%</span> สูงสุดรายการละ <span style="color: red; font-weight: bold;font-size: 20px">0</span> บาท
                            <br>
                            <span style="color: red; font-weight: bold;font-size: 20px">*รับได้ทุกวัน ได้รับทุกยอด เมื่อคนที่คุณแนะนำมากดรับโบนัส แนะนำทีเดียวกินระยะยาว ช่วยกันบอกต่อ</span>
                            <br>
                            <br>
                            <span style="color: red; font-weight: bold;font-size: 12px">"หากพบเห็นตั้งใจปั้มแนะนำเพื่อนไม่ว่าจะกรณีใดก็ตามทางทีมงานมีสิทธิยกเลิกโปรโมชั่นนี้ทันที"</span>
                        </div>

                        <table style="width: 100%;    border: none;">
                            <tbody>
                                <tr>
                                    <td class="tt_l tt_full fr_tx1" style="width: 33%;colzozr: white; border: none;">
                                        <center>
                                            <a class="afflink1" href="https://social-plugins.line.me/lineit/share?url=<?=$aff_link?>" style="    text-decoration: none;colssor: white" target="b_">
                                                <img src="<?= $site['host'] ?>/assets/sag66/images/line-icon.png" style="max-width: 80%;width: 100px;">
                                                <br>แนะนำผ่าน LINE
                                            </a>
                                        </center>
                                    </td>
                                    <td class="tt_l tt_full fr_tx1" style="width: 33%;cozlozr: white; border: none;">
                                        <center>
                                            <a class="afflink2" href="fb-messenger://share/?link=<?=$aff_link?>" style="    text-decoration: none;cossslor: white" target="b_">
                                                <img src="<?= $site['host'] ?>/assets/sag66/images/facebook-messenger-icon.png" style="max-width: 80%;width: 100px;">
                                                <br>แนะนำผ่าน Messenger
                                            </a>
                                        </center>
                                    </td>
                                    <td class="tt_l tt_full fr_tx1" style="width: 33%;colzzor: white; border: none;">
                                        <center>
                                            <a class="afflink3" href="https://www.facebook.com/sharer/sharer.php?u=<?=$aff_link?>" style="    text-decoration: none;colossr: white" target="b_">
                                                <img src="<?= $site['host'] ?>/assets/sag66/images/facebook_circle-512.png" style="max-width: 80%;width: 100px;">
                                                <br>แนะนำผ่าน Facebook
                                            </a>
                                        </center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>




                        <p style="  color: black"><b style="font-size: 22px; color: black">ลิ้งค์ช่วยแชร์รับ <span style="color: red;font-size: 22px;"><?= $site['aff_comm_level_1'] ?>% </span> ฟรี </b> (แค่ก๊อปปี้ลิ้งค์ไปแชร์ก็ได้เงินแล้ว) ยิ่งแชร์มากยิ่งได้มาก<br><br>
                            <b style="font-size: 15px;color: black"> ท่านสามารถนำลิ้งค์ด้านล่างนี้หรือนำป้ายแบนเนอร์ ไปแชร์ในช่องทางต่างๆ ไม่ว่าจะเป็น เว็บไชต์ส่วนตัว, Blog, Facebook หรือ Social Network อื่นๆ หากมีการสมัครสมาชิกโดยคลิกผ่านลิ้งค์ของท่านเข้ามา ลูกค้าที่สมัครเข้ามาก็จะอยู่ภายให้เครือข่ายของท่านทันที และหากลูกค้าภายใต้เครือข่ายของท่านมีการเดิมพันเข้ามา ทุกยอดการเดิมพัน ท่านจะได้รับส่วนแบ่งในการแนะนำ <?= $site['aff_comm_level_1'] ?>% ทันทีโดยไม่มีเงื่อนไข</b>
                            <br><br><u style="  font-size: 15px;color: black">ตัวอย่างเช่น...</u></p>

                        <b style="  font-size: 12px;color: black"> เพื่อนลำดับที่ 1</b><br> ท่านจะได้รับส่วนแบ่ง เริ่มต้นในขั้นแรก <b style="  color: red"><?= $site['aff_comm_level_1'] ?>%</b> ตัวอย่างเช่น
                        <br>
                        <ul>
                            <li style="  font-size: 12px;color: black; padding-left: 5px;">- ลูกค้าท่าน 1 คน แทง 1,000 บาท ท่านจะได้ 6 บาท (ท่านจะได้ทุกรายการแทงของลูกค้า)</li>
                        </ul>
                        <br>
                        <b style="  color: font-size: 12px;black"> เพื่อนลำดับที่ 2<br> ท่านจะได้รับส่วนแบ่ง เริ่มต้นในขั้นแรก <b style="  color: red"><?= $site['aff_comm_level_2'] ?>%</b> ตัวอย่างเช่น </b>

                        <ul>
                            <li style="  font-size: 12px;color: black;padding-left: 5px;">- ลูกค้าท่าน 1 คน แทง 10,000 บาท ท่านจะได้ 6 บาท (ท่านจะได้ทุกรายการแทงของลูกค้า)</li>
                        </ul>
                        <br>
                        <b style="font-size: 22px;color: black">สามารถทำรายได้เดือน 100,000 บาทง่าย ๆ เลยทีเดียว</b> และรายได้ทุกบาททุกสตางค์ของท่านสามารถตรวจสอบได้ทุกขั้นตอน งานนี้แจกจริง จริงจ่าย ที่นี้ที่เดียวที่ให้คุณมากกว่าใคร ก๊อปปี้ลิ้งค์และข้อความด้านล่างนี้ นำไปแชร์ได้เลย
                        <br><br>
                        <a href="https://sagame66.com/affiliate_3.php" target="blank_"><img src="<?= $site['host'] ?>/assets/sag66/images/ads1040-42.png" width="100%"></a>
                        <center><iframe title="sagame66" src="https://www.youtube.com/embed/rpWRs2I0xzc" width="100%" height="500px" frameborder="0" allowfullscreen="allowfullscreen"></iframe></center><br>
                        <a href="https://sagame66.com/affiliate_3.php" target="blank_"><img src="<?= $site['host'] ?>/assets/sag66/images/ads1040-25.png" width="100%"></a>
                        <a href="https://sagame66.com/affiliate_3.php" target="blank_"><img src="<?= $site['host'] ?>/assets/sag66/images/howto770x289-new.gif" width="100%"></a><br>
                        <!-- หมายเหตุ: รายได้การช่วยแชร์ช่วยแนะนำของท่านสามารถแจ้งถอนได้ทุกเวลา หากมียอดรายได้มากกว่า 500 บาทขึ้นไป -->
                        <p></p>

                        <!-- <style type="text/css">
                            .table tr th {
                                background-color: #479988;
                                color: #FFF;
                                text-align: center;
                                font-size: 13px;
                            }

                            .table tr td {
                                vertical-align: middle;
                                font-size: 12px;
                            }
                        </style> -->
                    </div>
                </div>
            </div>


        </section>
    </article>
    <footer style="margin-bottom: 80px;">
        <div class="triangle-foot">
            <span class="triangle-foot-left"></span>
            <span class="triangle-foot-right"></span>
        </div>
        <section class="foot-bk" style="height: auto;">
            <div class="row p-3">
                <div class="col-sm-4 col-md-5 footer-logo">
                    <a href="<?= $site['host'] ?>"><img class="mw-100" src="<?= $site['host'] ?>/assets/sag66/images/logo_last.png" alt="Logo Sagame66"></a>
                </div>
                <div class="col-sm-8 col-md-7 footer-text text-white">
                    <h4>อยากเล่นคาสิโนออนไลน์ เครดิตฟรี ต้องที่ SAGAME66</h4>
                    <strong>SAGAME66.COM</strong> เราคือเว็บคาสิโนออนไลน์ ที่มีทีมดูแลลูกค้าทุกวัน 7 วัน 24 ชั่วโมง ไม่มีวันหยุด (7x24hr) <u>คาสิโนออนไลน์</u> จากฟิลิปปินส์ รวมเกมให้เล่นเยอะที่สุด ไม่ว่าจะเป็น บาคาร่าออนไลน์ รูเล็ต ไฮโล เสือมังกร คาสิโนสด live casino ถ่ายทอดสดส่งตรงจากฟิลิปปินส์ มั่นใจเรื่องความเสถียรในการเล่น<strong>ระบบสตรีมคาสิโนสดประสบการ์ณนับ 10 ปี</strong> บริการด้วยทีมงานมืออาชีพ ตลอด 24 ชม. สนุกสนานไปกับ สล็อตออนไลน์ แจ็ตพอตแตกแจกเป็นล้านทุกวัน หน้าตาเว็บสวยงาม เปรียบเสมือนท่านได้มาเดิมพันที่บ่อนเองเลยเกมคาสิโนมีระบบสถิตินับว่าไพ่เปิดฝั่งไหนชนะไปเท่าไรแล้ว รองรับทั้ง คอมพิวเตอร์ แท็บเล็ต รวมถึงมือถือ ios android เล่นเกมส์ง่ายผ่าน HTML5 ไม่ต้องดาวน์โหลด SA Gaming สามารถทดลองเล่น DEMO ก่อนได้
                </div>
            </div>
        </section>
    </footer>
    <div class="modal fade" id="notice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">ประกาศ
                </div>
                <div class="modal-body text-center">
                    <font color="red" size="5">ทางเรายกเลิกบัญชีกสิกร เซระ และ กสิกร บอย ห้ามลูกค้าโอนเข้านะคะ ทางเราจะไม่รับผิดชอบค่ะ</font>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">ปิดหน้าต่าง</button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js" integrity="sha256-2RS1U6UNZdLS0Bc9z2vsvV4yLIbJNKxyA4mrx5uossk=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha256-pEdn/pJ2tyT37axbEIPkyUUfuG1yXR0+YV+h+jphem4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha256-yt2kYMy0w8AbtF89WXb2P1rfjcP/HTHLT7097U8Y5b8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="<?= $site['host'] ?>/assets/sag66/dist/i18n/th.js"></script>
    <script type="text/javascript" src="<?= $site['host'] ?>/assets/sag66/js/html5.js"></script>
    <script type="text/javascript" src="<?= $site['host'] ?>/assets/sag66/js/vticker.min.js"></script>
    <script type="text/javascript" src="<?= $site['host'] ?>/assets/sag66/js/jR3DCarousel.min.js"></script>
    <script type="text/javascript" src="<?= $site['host'] ?>/assets/sag66/js/api.js"></script>
    <!-- <script src="https://sagame66.com/cdn-cgi/bm/cv/2181903173/api.js"></script> -->

    <!-- <script type="text/javascript">
        $(document).ready(function() {
            /*	$('#notice').modal({
                           backdrop: 'static',
                           keyboard: true 
                        });*/
            $('.navl').click(function() {
                $('nav>ul>li').toggle();
                $('.list-info').toggle();
            });
            var slides = [{
                    src: 'slide/SA_1.jpg'
                },
                {
                    src: 'slide/SA_2.jpg'
                },
                {
                    src: 'slide/SA_3.jpg'
                },
                {
                    src: 'slide/SA_4.jpg'
                },
                {
                    src: 'slide/SA_5.jpg'
                },
                {
                    src: 'slide/SA_6.jpg'
                }
            ]

        });
    </script> -->

    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
    <script>

    </script>


    <script>
        function getAffInfo() {
            // e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?= $site['host'] ?>/exec/aff-calculate.php",
                dataType: "json"
            }).done(function(data) {
                var nxx = numeral(data.level2).format('0,0.00');
                document.getElementById("aff_total").value = numeral(data.total_comm).format('0,0.00');
                document.getElementById("count_l1").value = data.count_l1 + " คน";
                document.getElementById("count_l2").value = data.count_l2 + " คน";

                let timerInterval;
                Swal.fire({
                    title: 'กำลังอัพเดทยอดแนะนำ รอซักครู่ค่ะ',
                    timer: 2000,
                    timerProgressBar: true,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                        timerInterval = setInterval(() => {}, 100)
                    },
                    onClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        // window.location.href = "<?= $site['host'] ?>/user/dashboard";
                    }
                })
            });

            setTimeout(function() {
                // count_down--;
                // document.getElementById("count_down").innerHTML = count_down;
                getAffInfo();

            }, 1000 * countDown(<?=$site['countdown_refresh_aff']?>));

        }
    </script>

    <script>
        function countDown(i) {
            var int = setInterval(function() {
                document.getElementById("countDownDiv").innerHTML = i;
                i-- || clearInterval(int); //if i is 0, then stop the interval
            }, 1000);
            return i;
        }
    </script>


    <script>
        function cpToClipboard() {
            /* Get the text field */
            var copyText = document.getElementById("aff_link");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /*For mobile devices*/

            /* Copy the text inside the text field */
            document.execCommand("copy");

            /* Alert the copied text */
            // alert("คัดลอก Link แนะนำสำเร็จแล้ว \r\n\r\n" + copyText.value);
            swal.fire('คัดลอก Link แนะนำสำเร็จแล้ว', copyText.value, 'success');
        }


        function CopyToClipboard(containerid) {
            if (document.selection) {
                var range = document.body.createTextRange();
                range.moveToElementText(document.getElementById(containerid));
                range.select().createTextRange();
                document.execCommand("copy");

            } else if (window.getSelection) {
                var range = document.createRange();
                range.selectNode(document.getElementById(containerid));
                window.getSelection().addRange(range);
                document.execCommand("copy");
                alert("คัดลอกเลขบัญชีสำเร็จแล้ว")
            }
        }

        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
            alert("คัดลอกเลขบัญชีสำเร็จแล้ว")
        }
    </script>

    <!-- 
    <script type="text/javascript">
        function updatebalance() {
            jQuery.get("?task=updatebalance", function(data) {
                setTimeout(function() {
                    updatebalance()
                }, 60000 * 3);
            });
        }

        setTimeout(function() {
            updatebalance()
        }, 10000);


        var last = false;

        function lastst() {
            jQuery.get("api.php?lastst=lastst", function(data) {

                if (data == null || data == 'null') {
                    last = 1;
                    setTimeout(function() {
                        lastst();
                    }, 1000 * 5);
                    return false;
                }

                data = JSON.parse(data);

                if (last != false) {
                    if (last != data.id) {
                        console.log(last);
                        Swal.fire(
                            'เติมเงินสำเร็จ!',
                            data.detail,
                            'success'
                        ).then((result) => {
                            if (result.value) {
                                var str = window.location.href;
                                var n = str.indexOf("login.php");

                                if (n != -1) {
                                    window.location.href = window.location.href;
                                }


                            }
                        });
                    }
                }

                last = data.id;

                setTimeout(function() {
                    lastst();
                }, 1000 * 5);
            });
        }

        lastst();
    </script> -->

    <!--Log In-->
    <!--Desktop-->
    <!-- <div class="fix_footer d-none d-sm-none d-md-block">
        <a href="../login.php"><i class="fas fa-user"></i> <strong>ข้อมูลสมาชิก</strong></a>
        <a href="../play.php" class="playgame"><i class="fas fa-play"></i> <strong>เข้าเล่น</strong></a>
        <a href="../deposite.php"><i class="fas fa-credit-card"> </i> <strong> ฝากเงิน</strong></a>
        <a href="../withdraw.php"><i class="fas fa-hand-holding-usd"></i> <strong> ถอนเงิน
                <span class="s_count" id="u_0_6" style=" 
             displayx: none; 
              vertical-align: super;
              position: relative;
              vertical-align: super;
              
              /* padding-top: 3px; */
              padding-left: 2px;
              height: 10p;
              line-height: 14px;
              /* font-size: 15px; */
              padding-bottom: 5px;
              top: -7px;
              padding-right: 3px;
              background-color: #fa3e3e;
                  min-width: 15px;
              border-radius: 4px;
             /* right: -10px;*/
              color: white;
            ">0</span>
            </strong></a>
        <a class="last" href="../contact.php"><i class="fas fa-phone"></i> <strong> ติดต่อเรา</strong></a>
    </div> -->
    <!--Mobile-->
    <!-- <div class="fix_footer d-block d-sm-block d-md-none">
        <a href="../login.php"><i class="fas fa-user"></i><br><strong>ข้อมูลสมาชิก</strong></a>
        <a href="../play.php"><i class="fas fa-play"></i><br><strong>เข้าเล่น</strong></a>
        <a href="../deposite.php"><i class="fas fa-credit-card"> </i><br><strong> ฝากเงิน</strong></a>
        <a href="../withdraw.php"><i class="fas fa-hand-holding-usd"></i><br><strong> ถอนเงิน
                <span class="s_count" id="u_0_6" style=" 
             displayx: none; 
              vertical-align: super;
              position: relative;
              vertical-align: super;
              
              /* padding-top: 3px; */
              padding-left: 2px;
              height: 10p;
              line-height: 14px;
              /* font-size: 15px; */
              padding-bottom: 5px;
              top: -7px;
              padding-right: 3px;
              background-color: #fa3e3e;
                  min-width: 15px;
              border-radius: 4px;
             /* right: -10px;*/
              color: white;
            ">0</span>
            </strong></a>
        <a class="last" href="../contact.php"><i class="fas fa-phone"></i><br><strong> ติดต่อเรา</strong></a>
    </div> -->
    <!--Log In-->

    <!-- <div id="ft" name="" style="display: none;">__<div>

            <script>
                function showmsg(title, game_message) {
                    Swal.fire(
                        title,
                        game_message,
                        'error'
                    ).then((result) => {
                        // if (result.value) {
                        //var str = window.location.href;
                        //var n = str.indexOf("login.php");
                        //if (n!=-1) {
                        // window.location.href = window.location.href;
                        //}
                        // window.location.href = window.location.href;
                        // }
                    });
                }
            </script>

            <div id="results" style="display: none;"></div>
            <script type="text/javascript">
                function update_aff() {
                    Swal.fire({
                        text: 'กำลังทำการอัพเดต กรุณาอย่าปิดหน้านี้',
                        showConfirmButton: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                        allowOutsideClick: false
                    });

                    $.post('?updateaff=1588838958', function(data) {
                        swal.close();
                        $("#results").html(data)
                    }).done(function(msg) {
                        setTimeout(function() {
                            window.location.href = window.location.href;
                        }, 2000);
                    }).fail(function(xhr, textStatus, errorThrown) {
                        setTimeout(function() {
                            window.location.href = window.location.href;
                        }, 2000);
                    });
                }
            </script>
        </div>
    </div> -->
</body>

</html>