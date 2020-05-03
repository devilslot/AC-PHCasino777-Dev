<?php

session_start();

$site = include(__DIR__ . '/config/site.php');
$pg = include(__DIR__ . '/config/pg.php');

?>

<!DOCTYPE html>
<html lang="th" class="">

<head>
    <?php include(__DIR__ . '/include/header01.php'); ?>
</head>

<body>

    <nav class="x-header navbar bg-transparent navbar-expand-lg -anon">
        <div class="container align-items-center">
            <div id="headerBrand">
                <a class="navbar-brand" href="/">
                    <img class="-logo mt-1 mt-md-0" src="/build/web/all-casino/img/logo.png" alt="All Casino">
                </a>
            </div>

            <div id="headerContent">
                <ul class="navbar-nav ml-auto">
                    <div class="d-flex">
                        <a href="/lobby" target="_blank" class="btn btn-primary d-lg-block d-none mt-3 mr-3">
                            <div class="d-flex">
                                <i class="fas fa-play-circle mr-2"></i>
                                <div class="my-auto">
                                    ทดลองเล่น
                                </div>
                            </div>
                        </a>
                        <button type="button" class="-header-login-btn btn btn-primary px-4 px-lg-5 mt-lg-3" data-toggle="modal" data-target="#loginModal">
                            เข้าสู่ระบบ
                        </button>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
    <div id="main__content" class="x-main-content-container">
        <section class="x-index-top-container">
            <div class="-bg-container">
                <img src="/build/web/all-casino/img/bg-allcasino-1.png" alt="icon chip" class="-bg-1">
                <img src="/build/web/all-casino/img/bg-allcasino-2.png" alt="icon chip" class="-bg-2">
                <img src="/build/web/all-casino/img/bg-allcasino-3.png" alt="icon chip" class="-bg-3">
            </div>

            <div class="x-contact-us 1">
                <div class="-line-container">
                    <a href="https://lin.ee/hGWtbsg" target="_blank">
                        <img src="/build/web/all-casino/img/ic_line.png" alt="All Casino ติดต่อเรา" class="-img-default">
                        <img src="/build/web/all-casino/img/ic_line_hover.png" alt="All Casino ติดต่อเรา" class="-img-hover">
                    </a>
                </div>
                <div class="-line-detail-container">
                    <a href="https://lin.ee/hGWtbsg" target="_blank">
                        Line : @allcasino
                    </a>
                </div>
            </div>

            <div class="container -inner-wrapper">
                <div>
                    <div class="-title" data-animatable="fadeInUp" data-delay="500">
                        <img src="/build/web/all-casino/img/logo.gif" alt="All Casino logo" class="-logo-title">
                        <img src="/build/web/all-casino/img/coin.gif" alt="All Casino logo" class="-logo-coin">
                    </div>
                    <div>
                        <h2 data-animatable="fadeInUp" data-delay="500" class="text-white mt-2 mb-0 h5 -sub-title text-center font-weight-normal">บาคาร่า คาสิโนออนไลน์ sagaming wmcasino sexygaming</h2>
                    </div>
                </div>
                <div class="x-modal modal" id="registerModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".modal-body" data-ajax-modal-always-reload="true" data-ajax-modal="/_ajax_/register" data-container="#registerModal">
                    <div class="modal-dialog -modal-size " role="document">
                        <div class="modal-content -modal-content">
                            <img src="/build/web/all-casino/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
                            <button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
                                <h3 class="x-title-modal font-weight-normal d-inline-block m-auto text-white">
                                    <span></span>
                                    <hr class="x-hr-border-glow">
                                </h3>
                            </div>
                            <div class="modal-body">
                                <div class="js-modal-content">
                                </div>
                            </div>
                            <img src="/build/web/all-casino/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
                        </div>
                    </div>
                </div>
                <!--
                <div class="x-modal modal show" id="registerModal" tabindex="-1" role="dialog" data-loading-container=".modal-body" data-ajax-modal-always-reload="true" data-ajax-modal="/_ajax_/register" data-container="#registerModal" style="display: block; padding-right: 8px;" aria-modal="true">
                    <div class="modal-dialog -modal-size " role="document" style="margin-top: 159.992px;">
                        <div class="modal-content -modal-content">
                            <img src="/build/web/all-casino/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
                            <button type="button" class="close f-1 " data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="modal-body">
                                <div class="x-form-register mt-0">
                                    <div class="row -animatable-container">
                                        <div class="col order-1 text-center mx-auto js-slide-term-and-condition-content x-slide-left-content x-slide-left-content-term -hide">
                                            <h3 class="x-title-modal mx-auto text-center d-inline-block text-white mt-3">
                                                Term and condition
                                                <hr class="x-hr-border-glow">
                                            </h3>

                                            <div class="-term-and-condition-content js-term-and-condition px-3">
                                                <div class="x-term-and-condition">
                                                    <div class="-block-content-term-and-condition -register-modal -real-content">

                                                    </div>

                                                    <div class="text-center d-lg-none">
                                                        <a href="#close-term-and-condition" class="js-get-term-and-condition btn -submit btn-primary my-0 my-lg-3 f-5 f-lg-6">
                                                            <span>ย้อนกลับ</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-animatable="fadeInRegister" data-offset="0" class="col-lg order-lg-2 -form order-0 animated fadeInRegister">
                                            <form novalidate="" name="request_otp" method="post" data-ajax-form="/_ajax_/request-otp" data-container="#registerModal">

                                                <div class="text-center d-flex flex-column">
                                                    <h3 class="x-title-modal mx-auto text-center d-inline-block text-white mt-3">
                                                        สมัครสมาชิก
                                                        <hr class="x-hr-border-glow">
                                                    </h3>


                                                    <div class="x-step-register">
                                                        <div class="d-block">
                                                            <div class="col-7 m-auto row px-0">
                                                                <div class="col-auto px-0 my-auto">
                                                                    <div class="-step-box-outer m-auto step-active">
                                                                        <div class="--step-box-inner text-center f-9">
                                                                            1
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="-border">
                                                                    <hr>
                                                                </div>
                                                                <div class="col-auto px-0 my-auto">
                                                                    <div class="-step-box-outer m-auto ">
                                                                        <div class="--step-box-inner text-center f-9">
                                                                            2
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="-border">
                                                                    <hr>
                                                                </div>
                                                                <div class="col-auto px-0 my-auto">
                                                                    <div class="-step-box-outer m-auto ">
                                                                        <div class="--step-box-inner text-center f-9">
                                                                            3
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="text-center">
                                                        <img src="/build/web/all-casino/img/ic_register.png" alt="สมัครสมาชิก" class="img-fluid -ic-register my-3" width="100">
                                                    </div>

                                                    <div class="-x-input-icon mb-3 flex-column text-center">
                                                        <img src="/build/web/all-casino/img/ic_phone.png" class="-icon" alt="" width="12">

                                                        <input type="text" id="request_otp_phoneNumber" name="request_otp[phoneNumber]" required="required" pattern="[0-9]*" class="x-form-control form-control" placeholder="กรุณากรอกเบอร์โทรศัพท์" autofocus="autofocus" autocomplete="on">
                                                    </div>

                                                    <div class="d-flex flex-column m-auto -term-and-condition-check-box ">
                                                        <div class="x-checkbox-primary d-flex justify-content-center mt-3">
                                                            <div class="form-check"> <input type="checkbox" id="request_otp_termAndCondition" name="request_otp[termAndCondition]" class="x-form-control js-term-check-box form-check-input" value="1">
                                                                <label class="form-check-label" for="request_otp_termAndCondition"> </label></div>

                                                            <span class="x-text-with-link-component">
                                                                <label class="-text-message mt-1" for="request_otp_termAndCondition">ยอมรับเงื่อนไข</label>
                                                                <a href="#term-and-condition" class="-link-message js-get-term-and-condition" target="_self">
                                                                    <span>Term and condition</span>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="text-center">
                                                        <button type="submit" class="btn -submit js-submit-accept-term btn-primary my-lg-3 mt-0 f-5 f-lg-6" disabled="">
                                                            ยืนยัน
                                                        </button>
                                                    </div>


                                                    <div class="x-admin-contact ">
                                                        <span class="x-text-with-link-component">
                                                            <label class="-text-message ">พบปัญหา</label>
                                                            <a href="https://lin.ee/hGWtbsg" class="-link-message " target="_blank">
                                                                <span>ติดต่อฝ่ายบริการลูกค้า</span>
                                                            </a>
                                                        </span>
                                                    </div>

                                                    <input type="hidden" id="request_otp__token" name="request_otp[_token]" value="RPQmuzcnR_juebQ_b3lNA4NhJElcPVFAXx0vCrCwTpw">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img src="/build/web/all-casino/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
                        </div>
                    </div>
                </div>
                -->

                <div class="x-modal modal" id="resetPasswordModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".modal-body" data-ajax-modal-always-reload="true" data-ajax-modal="/_ajax_/reset-password" data-container="#resetPasswordModal">
                    <div class="modal-dialog -modal-size " role="document">
                        <div class="modal-content -modal-content">
                            <img src="/build/web/all-casino/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
                            <button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
                                <h3 class="x-title-modal font-weight-normal d-inline-block m-auto text-white">
                                    <span></span>
                                    <hr class="x-hr-border-glow">
                                </h3>
                            </div>
                            <div class="modal-body">
                                <div class="js-modal-content">
                                </div>
                            </div>
                            <img src="/build/web/all-casino/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
                        </div>
                    </div>
                </div>

                <div class="row mt-3 -btn-actions justify-content-center" data-animatable="fadeInUp" data-delay="700">
                    <div class="col-7 col-sm-5 col-lg-3">
                        <!-- Registration -->
                        <!--
                        <button type="button" class="btn btn-primary btn-block -register-button" data-toggle="modal" data-target="#registerModal">สมัครสมาชิก
                        </button>
                        -->
                        <button type="button" class="btn btn-primary btn-block -register-button" onclick="location.href='/register';">สมัครสมาชิก</button>
                    </div>
                    <div class="col-8 col-md-4 col-lg-3 offset-2 offset-md-4 offset-lg-0 d-none d-lg-block">
                        <a href="/trial-lobby" target="_blank" class="btn btn-primary btn-block -demo-top-button">
                            <img src="/build/web/all-casino/img/ic-blackjack.png" alt="All casino blackjack png" class="-icon-blackjack"> ทดลองเล่น
                        </a>
                    </div>
                </div>

                <div class="-lobby-logo-section" data-animatable="fadeInUp" data-delay="900">

                    <ul class="-nav-container">
                        <li class="-nav-item">
                            <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/sa-gaming-logo-circle.png" class="-logo" alt="sa-gaming logo png">
                        </li>
                        <li class="-nav-item">
                            <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/wm-logo-circle.png" class="-logo" alt="wm logo png">
                        </li>
                        <li class="-nav-item">
                            <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/bbin-logo-circle.png" class="-logo" alt="bbin logo png">
                        </li>
                        <li class="-nav-item">
                            <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/sexy-bac-logo-circle.png" class="-logo" alt="sexy-bac logo png">
                        </li>
                        <li class="-nav-item">
                            <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/netent-live-logo-circle.png" class="-logo" alt="netent-live logo png">
                        </li>
                        <li class="-nav-item">
                            <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/dream-gaming-logo-circle.png" class="-logo" alt="dream-gaming logo png">
                        </li>
                        <li class="-nav-item">
                            <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/asia-gaming-logo-circle.png" class="-logo" alt="asia-gaming logo png">
                        </li>
                    </ul>
                </div>
            </div>

            <div class="x-service-wrapper">
                <div class="container">
                    <div class="row -service-inner-wrapper justify-content-center">
                        <div class="col-11 col-sm-9 col-md-4 mb-lg-0 mb-2 text-center -box d-flex align-items-start d-md-block -box">
                            <a href="#0" class="d-flex flex-md-column flex-row" data-toggle="modal" data-target="#registerModal">
                                <div class="-ic-wrapper">
                                    <img src="/build/web/all-casino/img/ic_deposit_withdraw.png" alt="icon register" class="-ic-register">
                                </div>
                                <div class="text-left text-md-center">
                                    <h3 class="text-gray-lighter"><span class="d-inline-block d-md-none">1.</span> ฝาก - ถอน เร็ว</h3>
                                    <hr class="x-hr-border-glow">

                                    <span class="d-none d-lg-block text-muted-lighter f-5">รวดเร็วทันใจ <br> สนุกได้ทุกเวลา</span>
                                    <span class="d-block d-lg-none text-muted-lighter f-5">รวดเร็วทันใจ สนุกได้ทุกเวลา</span>
                                </div>
                            </a>
                        </div>

                        <div class="col-11 col-sm-9 col-md-4 mb-lg-0 mb-2 text-center -box d-flex align-items-start d-md-block -box">
                            <div class="-ic-wrapper">
                                <img src="/build/web/all-casino/img/ic_service_24_7.png" alt="icon register" class="-ic-otp">
                            </div>
                            <div class="text-left text-md-center">
                                <h3 class="text-gray-lighter"><span class="d-inline-block d-md-none">2.</span> บริการลูกค้า</h3>
                                <hr class="x-hr-border-glow">

                                <span class="d-none d-lg-block text-muted-lighter f-5">บริการด้วยใจ <br> พร้อมดูแล 24 ชั่วโมง</span>
                                <span class="d-block d-lg-none text-muted-lighter f-5">บริการด้วยใจ พร้อมดูแล 24 ชั่วโมง</span>
                            </div>
                        </div>

                        <div class="col-11 col-sm-9 col-md-4 mb-lg-0 mb-2 text-center -box d-flex align-items-start d-md-block -box">
                            <div class="-ic-wrapper">
                                <img src="/build/web/all-casino/img/ic_consistency.png" alt="icon register" class="-ic-bank">
                            </div>
                            <div class="text-left text-md-center">
                                <h3 class="text-gray-lighter"><span class="d-inline-block d-md-none">3.</span> ความมั่นคง</h3>
                                <hr class="x-hr-border-glow">

                                <span class="d-none d-lg-block text-muted-lighter f-5">เท่าไหร่ก็จ่าย <br> ไม่มีลิมิตต่อวัน</span>
                                <span class="d-block d-lg-none text-muted-lighter f-5">เท่าไหร่ก็จ่าย ไม่มีลิมิตต่อวัน</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="x-index-tab-container">
                <div class="container">
                    <ul class="nav nav-tabs x-tab py-3">
                        <img src="/build/web/all-casino/img/line-long-glow.png" alt="Line long glow png" class="-line-glow">
                        <li class="nav-item  active -index js-tab-scrolled" id="tab-index">
                            <a data-toggle="tab" href="#tab-content-index" class="nav-link active">
                                <img src="/build/web/all-casino/img/tab_index.png" alt="logo_index" class="-ic">
                                <br>
                                <span class="d-sm-none d-inline-block mt-2 text-gray-lighter">Casino</span>
                                <span class="d-sm-inline-block d-none mt-2 text-gray-lighter">All Casino</span>
                                <hr class="x-hr-border-glow mb-0">
                            </a>
                        </li>
                        <li class="nav-item   -promotion js-tab-scrolled" id="tab-promotion">
                            <a data-toggle="tab" href="#tab-content-promotion" class="nav-link ">
                                <img src="/build/web/all-casino/img/tab_promotion.png" alt="logo_promotion" class="-ic">
                                <br>
                                <span class="d-sm-none d-inline-block mt-2 text-gray-lighter">โปรโมชั่น</span>
                                <span class="d-sm-inline-block d-none mt-2 text-gray-lighter">โปรโมชั่น</span>
                                <hr class="x-hr-border-glow mb-0">
                            </a>
                        </li>
                        <li class="nav-item   -manual js-tab-scrolled" id="tab-manual">
                            <a data-toggle="tab" href="#tab-content-manual" class="nav-link ">
                                <img src="/build/web/all-casino/img/tab_manual.png" alt="logo_manual" class="-ic">
                                <br>
                                <span class="d-sm-none d-inline-block mt-2 text-gray-lighter">แนะนำ</span>
                                <span class="d-sm-inline-block d-none mt-2 text-gray-lighter">แนะนำการใช้งาน</span>
                                <hr class="x-hr-border-glow mb-0">
                            </a>
                        </li>
                        <li class="nav-item   -event js-tab-scrolled" id="tab-event">
                            <a data-toggle="tab" href="#tab-content-event" class="nav-link ">
                                <img src="/build/web/all-casino/img/tab_event.png" alt="logo_event" class="-ic">
                                <br>
                                <span class="d-sm-none d-inline-block mt-2 text-gray-lighter">กิจกรรม</span>
                                <span class="d-sm-inline-block d-none mt-2 text-gray-lighter">กิจกรรม</span>
                                <hr class="x-hr-border-glow mb-0">
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab-content-index">
                        <div class="x-tab-index">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6 -description">
                                        <div class="-logo-wrapper">
                                            <img src="/build/web/all-casino/img/logo-coin.png" alt="Allcasino logo png" class="-logo-coin">
                                            <img src="/build/web/all-casino/img/logo-text.png" alt="Allcasino logo png" class="-logo-text">
                                        </div>
                                        <h3>คาสิโนออนไลน์ที่ให้บริการ Casino Online ยอดนิยมครบจบที่สุดในไทย</h3>
                                        <p>มีให้ท่านหลายแบรนด์ ทั้ง SA Gaming, Sexy Gaming, WM Casino และ DG Casino, คาสิโนสดมากมาย เกมสล็อต และ เดิมพันกีฬา รวบรวมผู้ให้บริการระดับโลกมาอยู่ในมือของท่าน แบบ All-In-One ให้ท่านได้สนุก ครบ จบ ในที่เดียว ภายใต้การดูแลบริการตลอด 24 ชั่วโมง</p>
                                    </div>
                                    <div class="col-lg-6 text-center position-relative">
                                        <div class="-bg-lighting-gift">
                                            <img src="/build/web/all-casino/img/bg_lighting_gift.png" alt="All Casino" class="img-fluid ">
                                        </div>
                                        <div class="-snippet-container">
                                            <img src="/build/web/all-casino/img/box-up.png" alt="All Casino" class="-banner -box-up">
                                            <img src="/build/web/all-casino/img/box-main.png" alt="All Casino" class="-banner -box-main">
                                            <img src="/build/web/all-casino/img/box-coin-1.png" alt="All Casino" class="-banner -box-coin-1">
                                            <img src="/build/web/all-casino/img/box-coin-2.png" alt="All Casino" class="-banner -box-coin-2">
                                            <img src="/build/web/all-casino/img/box-sign-1.png" alt="All Casino" class="-banner -box-sign-1">
                                            <img src="/build/web/all-casino/img/box-sign-2.png" alt="All Casino" class="-banner -box-sign-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="-middle-wrapper">
                                <div class="container">
                                    <h2 class="-title">ขั้นตอนการสมัครสมาชิก All Casino</h2>

                                    <div class="row -box-wrapper">
                                        <div class="col-md-4">
                                            <div class="-box">
                                                <div class="-content">
                                                    <img src="/build/web/all-casino/img/ic_register.png" alt="Allcasino icon png" class="-ic-register">
                                                    <div class="-desc-wrap">
                                                        <div class="-title">1. สมัครสมาชิก</div>
                                                        <div class="-description">กรอกเบอร์โทรศัพท์ของคุณให้ถูกต้อง</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="-box">
                                                <div class="-content">
                                                    <img src="/build/web/all-casino/img/ic_otp.png" alt="Allcasino icon png" class="-ic-otp">
                                                    <div class="-desc-wrap">
                                                        <div class="-title">2. รอรับ SMS</div>
                                                        <div class="-description">กรอกเลข OTP ให้ถูกต้องพร้อมตั้งรหัสเข้าเล่น</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="-box">
                                                <div class="-content">
                                                    <img src="/build/web/all-casino/img/ic_bank.png" alt="Allcasino icon png" class="-ic-bank">
                                                    <div class="-desc-wrap">
                                                        <div class="-title">3. ใส่เลขบัญชีและชื่อบัญชี</div>
                                                        <div class="-description">กรอกเลขบัญชีของคุณพร้อมชื่อให้ถูกต้อง เข้าร่วมสนุกกับ <span class='text-warning'>Allcasino</span> ได้ทันที</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="-before-bottom-wrapper">
                                <div class="container-fluid px-0 -middle-content-bg-outer" style="background-image: url('/build/web/all-casino/img/bg_index_middle_content.png')">
                                    <div class="container">
                                        <div class="-middle-header text-center col-md-8 col-sm-10 m-auto">
                                            <h2 class="-title">Play Smart, Play ALLCASINO</h2>
                                            <div class="-sub-title">เปิดประสบการณ์สนุกไปอีกขั้น กับคาสิโนออนไลน์ที่เหนือระดับ ทางเลือกของคนยุคใหม่ ที่จะทำให้คุณบอกลาเว็ปแบบเดิมๆ เพลิดเพลินไปกับการเดิมพันได้อย่างมั่นใจ เล่นทั้งที เล่นเว็บตรง CASINO ตัวจริงต้อง ออลล์คาสิโนเท่านั้น</div>
                                        </div>
                                        <div class="row -middle-content text-center">

                                            <div class="col-md-4 col-10 -middle-content-bg-inner">
                                                <img class="img-fluid -img-element -item-1" src="/build/web/all-casino/img/index_middle_element_01.png" alt="All casino image png">
                                                <div class="-content">All Casino บริการคาสิโนสดและสล็อตชั้นนำการันตี รวดเร็ว มั่นคง ปลอดภัย เท่าไหร่ก็จ่าย</div>
                                            </div>
                                            <div class="col-md-4 col-10 -middle-content-bg-inner">
                                                <img class="img-fluid -img-element -item-2" src="/build/web/all-casino/img/index_middle_element_02.png" alt="All casino image png">
                                                <div class="-content">โปรโมชั่นดี พร้อมฝ่ายบริการมืออาชีพคอยดูแลทักได้ตลอด 24ชั่วโมง โปรดีๆ เครดิตฟรี มีทุกวัน!</div>
                                            </div>
                                            <div class="col-md-4 col-10 -middle-content-bg-inner">
                                                <img class="img-fluid -img-element -item-3" src="/build/web/all-casino/img/index_middle_element_03.png" alt="All casino image png">
                                                <div class="-content">ให้ความสำคัญกับความปลอดภัย และ ความเป็นส่วนตัวของท่านให้คุณสบายใจ มีเวลาไปชนะมากขึ้นกับเกมส์คาสิโนของเรา</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="-bottom-wrapper" style="background-image: url('/build/web/all-casino/img/bg_index_lobby.png')">
                                <div class="container">
                                    <div class="-lobby-header text-center">
                                        <a href="/lobby">ทางเข้าเล่นคาสิโน</a>
                                        <div>All CAINO ตัวจริง SA Gaming ︱Sexy Gaming︱WM Casino︱DG Casino︱AG Casino</div>
                                    </div>
                                    <div class="-lobby-logo-section">

                                        <ul class="-nav-container-casino">
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/sa-gaming-logo-circle.png" class="-logo" alt="sa-gaming logo png">
                                            </li>
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/wm-logo-circle.png" class="-logo" alt="wm logo png">
                                            </li>
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/bbin-logo-circle.png" class="-logo" alt="bbin logo png">
                                            </li>
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/sexy-bac-logo-circle.png" class="-logo" alt="sexy-bac logo png">
                                            </li>
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/netent-live-logo-circle.png" class="-logo" alt="netent-live logo png">
                                            </li>
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/dream-gaming-logo-circle.png" class="-logo" alt="dream-gaming logo png">
                                            </li>
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/asia-gaming-logo-circle.png" class="-logo" alt="asia-gaming logo png">
                                            </li>
                                        </ul>
                                        <ul class="-nav-container-slot">
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/skill-game-cover-vertical.png" class="-logo" alt="skill-game logo png">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/skill-game-logo-horizontal.png" class="-logo mt-2" alt="skill-game logo png">
                                            </li>
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/evo-play-cover-vertical.png" class="-logo" alt="evo-play logo png">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/evo-play-logo-horizontal.png" class="-logo mt-2" alt="evo-play logo png">
                                            </li>
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/netent-slot-cover-vertical.png" class="-logo" alt="netent-slot logo png">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/netent-slot-logo-horizontal.png" class="-logo mt-2" alt="netent-slot logo png">
                                            </li>
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/sp-cover-vertical.png" class="-logo" alt="sp logo png">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/sp-logo-horizontal.png" class="-logo mt-2" alt="sp logo png">
                                            </li>
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/habanero-cover-vertical.png" class="-logo" alt="habanero logo png">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/habanero-logo-horizontal.png" class="-logo mt-2" alt="habanero logo png">
                                            </li>
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/joker-cover-vertical.png" class="-logo" alt="joker logo png">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/joker-logo-horizontal.png" class="-logo mt-2" alt="joker logo png">
                                            </li>
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/ps-cover-vertical.png" class="-logo" alt="ps logo png">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/ps-logo-horizontal.png" class="-logo mt-2" alt="ps logo png">
                                            </li>
                                        </ul>
                                        <ul class="-nav-container-other">
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/pinnacle-cover-vertical.png" class="-logo" alt="pinnacle logo png">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/pinnacle-logo-horizontal.png" class="-logo mt-2" alt="pinnacle logo png">
                                            </li>
                                            <li class="-nav-item">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/imsb-cover-vertical.png" class="-logo" alt="imsb logo png">
                                                <img src="<?= $site['host'] ?>/build/admin/img/lobby_main/imsb-logo-horizontal.png" class="-logo mt-2" alt="imsb logo png">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="tab-content-promotion">
                        <div data-tab-loader="/_ajax_/promotions"></div>
                    </div>
                    <div class="tab-pane " id="tab-content-manual">

                        <div class="x-tab-manual">

                            <div class="container -container-wrapper pt-4">
                                <ul class="nav nav-tabs -tabs d-flex justify-content-center -video-tab-wrapper">
                                    <li class="nav-item  active -register" id="tab-register">
                                        <a data-toggle="tab" href="#tab-content-register" class="nav-link active">
                                            วิธีการสมัคร
                                            <img src="/build/web/all-casino/img/line-glow.png" alt="Line glow png" class="-line">
                                        </a>
                                    </li>
                                    <li class="nav-item   -deposit" id="tab-deposit">
                                        <a data-toggle="tab" href="#tab-content-deposit" class="nav-link ">
                                            วิธีการฝากเงิน
                                            <img src="/build/web/all-casino/img/line-glow.png" alt="Line glow png" class="-line">
                                        </a>
                                    </li>
                                    <li class="nav-item   -withdraw" id="tab-withdraw">
                                        <a data-toggle="tab" href="#tab-content-withdraw" class="nav-link ">
                                            วิธีการถอนเงิน
                                            <img src="/build/web/all-casino/img/line-glow.png" alt="Line glow png" class="-line">
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content text-center mt-4">
                                    <div class="tab-pane active x-video-container" id="tab-content-register">

                                        <div class="x-service-wrapper">

                                            <div class="row justify-content-center">
                                                <div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
                                                    <a href="#0" class="d-flex flex-md-column flex-row" data-toggle="modal" data-target="#registerModal">
                                                        <div class="-ic-wrapper">
                                                            <img src="/build/web/all-casino/img/ic_register.png" alt="icon register" class="-ic-register">
                                                        </div>
                                                        <div class="text-left text-md-center">
                                                            <h3 class="text-gray-lighter"><span class="d-inline-block d-md-none">1.</span> สมัครสมาชิก</h3>
                                                            <hr class="x-hr-border-glow">

                                                            <span class="d-none d-lg-block text-muted-lighter f-5">กรอกเบอร์โทรศัพท์มือถือ ของคุณให้ถูกต้อง</span>
                                                            <span class="d-block d-lg-none text-muted-lighter f-5">กรอกเบอร์โทรศัพท์มือถือ ของคุณให้ถูกต้อง</span>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
                                                    <div class="-ic-wrapper">
                                                        <img src="/build/web/all-casino/img/ic_otp.png" alt="icon register" class="-ic-otp">
                                                    </div>
                                                    <div class="text-left text-md-center">
                                                        <h3 class="text-gray-lighter"><span class="d-inline-block d-md-none">2.</span> รอรับ SMS ยืนยัน</h3>
                                                        <hr class="x-hr-border-glow">

                                                        <span class="d-none d-lg-block text-muted-lighter f-5">กรอกเลข OTP ให้ถูกต้อง พร้อมตั้งรหัสเข้าเล่น</span>
                                                        <span class="d-block d-lg-none text-muted-lighter f-5">กรอกเลข OTP ให้ถูกต้อง พร้อมตั้งรหัสเข้าเล่น</span>
                                                    </div>
                                                </div>

                                                <div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
                                                    <div class="-ic-wrapper">
                                                        <img src="/build/web/all-casino/img/ic_bank.png" alt="icon register" class="-ic-bank">
                                                    </div>
                                                    <div class="text-left text-md-center">
                                                        <h3 class="text-gray-lighter"><span class="d-inline-block d-md-none">3.</span> ใส่เลขบัญชีและชื่อบัญชี</h3>
                                                        <hr class="x-hr-border-glow">

                                                        <span class="d-none d-lg-block text-muted-lighter f-5">กรอกเลขบัญชีของคุณพร้อมชื่อให้ถูกต้อง เข้าร่วมสนุกกับ All Casino ได้ทันที !</span>
                                                        <span class="d-block d-lg-none text-muted-lighter f-5">กรอกเลขบัญชีของคุณพร้อมชื่อให้ถูกต้อง เข้าร่วมสนุกกับ All Casino ได้ทันที !</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane  x-video-container" id="tab-content-deposit">

                                        <div class="x-service-wrapper">

                                            <div class="row justify-content-center">
                                                <div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
                                                    <a href="#0" class="d-flex flex-md-column flex-row" data-toggle="modal" data-target="#depositModal">
                                                        <div class="-ic-wrapper">
                                                            <img src="/build/web/all-casino/img/ic_step_deposit.png" alt="icon register" class="-ic">
                                                        </div>
                                                        <div class="text-left text-md-center">
                                                            <h3 class="text-gray-lighter"><span class="d-inline-block d-md-none">1.</span> กด &quot;ฝากเงิน&quot;</h3>
                                                            <hr class="x-hr-border-glow">

                                                            <span class="d-none d-lg-block text-muted-lighter f-5">"กรอกจำนวนเงิน" กด "ต้องการรับโปรโมชั่น" เพื่อรับโบนัสที่ต้องการ และกด "ยืนยัน"</span>
                                                            <span class="d-block d-lg-none text-muted-lighter f-5">"กรอกจำนวนเงิน" กด "ต้องการรับโปรโมชั่น" เพื่อรับโบนัสที่ต้องการ และกด "ยืนยัน"</span>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
                                                    <div class="-ic-wrapper">
                                                        <img src="/build/web/all-casino/img/ic_step_deposit_add.png" alt="icon register" class="-ic">
                                                    </div>
                                                    <div class="text-left text-md-center">
                                                        <h3 class="text-gray-lighter"><span class="d-inline-block d-md-none">2.</span> โอนเงิน</h3>
                                                        <hr class="x-hr-border-glow">

                                                        <span class="d-none d-lg-block text-muted-lighter f-5">สามารถ Scan QR Code เพื่อโอน หรือกด "คัดลอก" เลขบัญชี เพื่อโอนได้เช่นกัน</span>
                                                        <span class="d-block d-lg-none text-muted-lighter f-5">สามารถ Scan QR Code เพื่อโอน หรือกด "คัดลอก" เลขบัญชี เพื่อโอนได้เช่นกัน</span>
                                                    </div>
                                                </div>

                                                <div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
                                                    <div class="-ic-wrapper">
                                                        <img src="/build/web/all-casino/img/ic_step_deposit_done.png" alt="icon register" class="-ic">
                                                    </div>
                                                    <div class="text-left text-md-center">
                                                        <h3 class="text-gray-lighter"><span class="d-inline-block d-md-none">3.</span> กด &quot;โอนแล้ว&quot;</h3>
                                                        <hr class="x-hr-border-glow">

                                                        <span class="d-none d-lg-block text-muted-lighter f-5">ส่งรายการฝาก ระบบจะตรวจสอบเงิน และ เติมเงินทันที</span>
                                                        <span class="d-block d-lg-none text-muted-lighter f-5">ส่งรายการฝาก ระบบจะตรวจสอบเงิน และ เติมเงินทันที</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane  x-video-container" id="tab-content-withdraw">

                                        <div class="x-service-wrapper">

                                            <div class="row justify-content-center">
                                                <div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
                                                    <a href="#0" class="d-flex flex-md-column flex-row" data-toggle="modal" data-target="#withdrawModal">
                                                        <div class="-ic-wrapper">
                                                            <img src="/build/web/all-casino/img/ic_step_withdraw.png" alt="icon register" class="-ic">
                                                        </div>
                                                        <div class="text-left text-md-center">
                                                            <h3 class="text-gray-lighter"><span class="d-inline-block d-md-none">1.</span> กด &quot;ถอนเงิน&quot;</h3>
                                                            <hr class="x-hr-border-glow">

                                                            <span class="d-none d-lg-block text-muted-lighter f-5">"กรอกจำนวนเงิน ถอน" และกด "ยืนยัน"</span>
                                                            <span class="d-block d-lg-none text-muted-lighter f-5">"กรอกจำนวนเงิน ถอน" และกด "ยืนยัน"</span>
                                                        </div>
                                                    </a>
                                                </div>

                                                <div class="col-11 col-sm-9 col-md-4 text-center -box d-flex align-items-start d-md-block -box">
                                                    <div class="-ic-wrapper">
                                                        <img src="/build/web/all-casino/img/ic_step_withdraw_done.png" alt="icon register" class="-ic">
                                                    </div>
                                                    <div class="text-left text-md-center">
                                                        <h3 class="text-gray-lighter"><span class="d-inline-block d-md-none">2.</span> ยืนยัน</h3>
                                                        <hr class="x-hr-border-glow">

                                                        <span class="d-none d-lg-block text-muted-lighter f-5">รอเงินเข้าภายใน 3 - 10 นาที</span>
                                                        <span class="d-block d-lg-none text-muted-lighter f-5">รอเงินเข้าภายใน 3 - 10 นาที</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="tab-content-event">
                        <div class="container text-center py-3">

                            <h3 class="text-white">กิจกรรม</h3>

                            <span class="text-white">ยังไม่มีข้อมูลในส่วนนี้</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="x-button-actions">
                <a href="/lobby" target="_blank" class="btn btn-lg btn-primary btn-block pb-0 -demo-bottom">
                    <img src="/build/web/all-casino/img/ic-google-play.png" alt="Allcasino icon google play png" class="-ic-google"> ทดลองเล่น
                </a>
            </div>
        </section>

        <div class="x-logged-sidebar-mobile">
            <div class="-inner-wrapper">
                <div class="-heading d-flex align-items-center justify-content-between p-3">
                    <img src="/build/web/all-casino/img/logo.png" alt="Sa Gaming logo">
                    <i class="fas fa-times text-primary js-close-sidebar"></i>
                </div>

                <div class="px-3">
                    <div class="x-profile-dropdown-menu px-3">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#account" class="nav-link js-close-sidebar" data-toggle="modal" data-target="#accountModal">
                                    <i class="fas fa-user mr-3 f-9"></i>ข้อมูลบัญชี
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#promotion-active" class="nav-link js-close-sidebar" data-toggle="modal" data-target="#joinPromotionModal">
                                    <i class="fas fa-gift mr-3 f-9"></i>โปรโมชั่นที่เข้าร่วม
                                </a>
                            </li>
                            <li class="nav-item js-close-sidebar">
                                <a href="/logout" class="nav-link js-require-confirm" data-title="ต้องการออกจากระบบ ?">
                                    <i class="fas fa-sign-out-alt mr-3 f-9"></i>ออกจากระบบ
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="-overlay js-close-sidebar"></div>
        </div>

        <div class="x-modal modal" id="alertModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
            <div class="modal-dialog -modal-size " role="document">
                <div class="modal-content -modal-content">
                    <img src="/build/web/all-casino/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
                    <button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
                        <h3 class="x-title-modal font-weight-normal d-inline-block m-auto text-white">
                            <span>แจ้งเตือน</span>
                            <hr class="x-hr-border-glow">
                        </h3>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <img src="/build/web/all-casino/img/ic_check.png" alt="SUCCESS" width="90px" class="js-ic-success img-fluid">
                            <img src="/build/web/all-casino/img/ic_cross.png" alt="FAIL" width="90px" class="js-ic-fail img-fluid">
                        </div>

                        <div class="js-modal-content text-primary text-center f-4">

                        </div>
                    </div>
                    <img src="/build/web/all-casino/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
                </div>
            </div>
        </div>

        <div id="alerts"></div>

        <div class="x-modal modal" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true" data-loading-container=".js-modal-content" data-ajax-modal-always-reload="true">
            <div class="modal-dialog -modal-size " role="document">
                <div class="modal-content -modal-content">
                    <img src="/build/web/all-casino/img/border-modal.png" class="img-fluid d-lg-block d-none -border-top-modal" alt="">
                    <button type="button" class="close f-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-header border-bottom-0 mt-3 pb-0 d-flex flex-column-reverse">
                        <h3 class="m-auto text-white d-inline-block">
                            เข้าสู่ระบบ
                            <hr class="x-hr-border-glow">
                        </h3>
                    </div>
                    <div class="modal-body">
                        <div class="x-login-form">
                            <div data-animatable="fadeInModal" data-offset="0" class="-animatable-container">
                                <form method="POST" id="login_form"> <!-- class="js-login-form x-header-login-form"> -->
                                    <div class="-x-input-icon mb-3 flex-column">
                                        <img src="/build/web/all-casino/img/ic_phone.png" class="-icon" alt="login" width="12">
                                        <input type="text" id="username" name="username" pattern="[0-9]*" autofocus class="form-control x-form-control" placeholder="เบอร์โทรศัพท์">
                                    </div>
                                    <div class="-x-input-icon flex-column">
                                        <img src="/build/web/all-casino/img/ic_lock_input.png" class="-icon" alt="password" width="13">
                                        <input type="password" id="password" name="password" class="form-control x-form-control" placeholder="รหัสผ่าน">
                                    </div>
                                    <div class="text-right mt-2 mx-auto x-reset-pw-text-container">
                                        <a href="#resetPassword" class="text-muted-lighter" data-dismiss="modal" data-toggle="modal" data-target="#resetPasswordModal">
                                            <u>ลืมรหัสผ่าน</u>
                                        </a>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary -submit my-lg-3 my-0 f-5 f-lg-6">
                                            <span>เข้าสู่ระบบ</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <img src="/build/web/all-casino/img/border-modal.png" class="img-fluid d-lg-block d-none -border-bottom-modal" alt="">
                </div>
            </div>
        </div>

        <script id="b-loading" type="text/template">
        </script>

        <script id="loading" type="text/template">
        </script>

        <footer class="x-footer py-3">
            <div class="-inner-wrapper pt-4">
                <div class="x-footer-bank-logo">
                    <div class="container">
                        <div class="-wrapper">
                            <div class="-ic -ic-1" style="background: url('/build/web/all-casino/img/ic-bank-logo.png')"></div>
                            <div class="-ic -ic-2" style="background: url('/build/web/all-casino/img/ic-bank-logo.png')"></div>
                            <div class="-ic -ic-3" style="background: url('/build/web/all-casino/img/ic-bank-logo.png')"></div>
                            <div class="-ic -ic-4" style="background: url('/build/web/all-casino/img/ic-bank-logo.png')"></div>
                            <div class="-ic -ic-5" style="background: url('/build/web/all-casino/img/ic-bank-logo.png')"></div>
                            <div class="-ic -ic-6" style="background: url('/build/web/all-casino/img/ic-bank-logo.png')"></div>
                            <div class="-ic -ic-7" style="background: url('/build/web/all-casino/img/ic-bank-logo.png')"></div>
                            <div class="-ic -ic-8" style="background: url('/build/web/all-casino/img/ic-bank-logo.png')"></div>
                            <div class="-ic -ic-9" style="background: url('/build/web/all-casino/img/ic-bank-logo.png')"></div>
                            <div class="-ic -ic-10" style="background: url('/build/web/all-casino/img/ic-bank-logo.png')"></div>
                            <div class="-ic -ic-11" style="background: url('/build/web/all-casino/img/ic-bank-logo.png')"></div>
                            <div class="-ic -ic-12" style="background: url('/build/web/all-casino/img/ic-bank-logo.png')"></div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <div>
                        <a href="/term-and-condition" class="text-warning">Term and condition</a>
                    </div>

                    <p class="mb-0">
                        Copyright © 2020 All Casino. All Rights Reserved.
                    </p>
                </div>
            </div>
        </footer>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <!--
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-154557947-6"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-154557947-6');
        </script>
        -->
    </div>
    <?php
     include(__DIR__ . '/include/footer_js.php');
    ?>
    <script>
        $("#login_form").submit(function(e) {
            e.preventDefault();
            $.post('/exec/login.php', $(this).serialize(), function(data) {
                $("#alerts").html(data)
            });
            return false;
        });
    </script>
    <script>
        Bonn.boots.push(function() {
            $('.js-simple-play-sidebar').click(function(e) {
                e && e.preventDefault();
                const selector = $('.x-simple-play-sidebar-container');
                selector.addClass('show');
            });

            $('.js-close-simple-play-sidebar').click(function(e) {
                e && e.preventDefault();
                const selector = $('.x-simple-play-sidebar-container');
                selector.removeClass('show');
            });
        });
    </script>
    <script>
        Bonn.boots.push(function() {
            setTimeout(function() {
                $('#bankInfoModal').modal('show');
            }, 500);
        });
    </script>
    <script>
        var IS_ANDROID = false;
    </script>

    <script src="/build/runtime.js"></script>
    <script src="/build/0.9a86198d.js"></script>
    <script src="/build/3.3e8fa25a.js"></script>
    <script src="/build/web/all-casino/app.js"></script>

</body>

</html>