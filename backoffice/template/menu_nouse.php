            <!--app-header-->
            <div class="app-header header hor-topheader d-flex">
                <div class="container">
                    <div class="d-flex">
                        <a class="header-brand" href="/main">
                            <img src="/assets/images/logo.png" class="header-brand-img main-logo" alt="Hogo logo">
                            <img src="/assets/images/logo.png" class="header-brand-img icon-logo" alt="Hogo logo">
                        </a><!-- logo-->
                        <a id="horizontal-navtoggle" class="animated-arrow hor-toggle"><span></span></a>
                        <div class="d-flex order-lg-2 ml-auto header-rightmenu">
                            <div class="dropdown header-notify">
                                <a class="nav-link icon" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fe fe-user"></i>
                                    <span class="pulse bg-success"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
                                    <div class="dropdown-divider"></div>
                                    <span href="#" class="dropdown-item d-flex pb-3">
                                        <strong><?php echo $_SESSION['admin']['admin_name'];?></strong>
                                    </span>
                                    <a href="?logout" class="dropdown-item d-flex pb-3">
                                        <div>
                                            <i class="fa fa-power-off" aria-hidden="true"></i>
                                            <strong>ออกจากระบบ</strong>
                                        </div>
                                    </a>
                                </div>
                            </div><!-- notifications -->
                        </div>
                    </div>
                </div>
            </div>
            <!--app-header end-->
            <!-- Horizontal-menu -->
            <div class="horizontal-main hor-menu clearfix">
                <div class="horizontal-mainwrapper container clearfix">
                    <nav class="horizontalMenu clearfix">
                        <ul class="horizontalMenu-list">
                            <li aria-haspopup="true"><a href="#" class="sub-icon"><i
                                        class="typcn typcn-device-desktop hor-icon"></i> Summary <i
                                        class="fa fa-angle-down horizontal-icon"></i></a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="/main">วันนี้</a></li>
                                    <li aria-haspopup="true"><a href="#">เดือนนี้</a></li>
                                </ul>
                            </li>
                            <li aria-haspopup="true"><a href="/member" class="sub-icon"><i
                                        class="typcn typcn-group hor-icon"></i> Member </a>
                            </li>
                            <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fa fa-money hor-icon"></i>
                                    ฝากเงิน <i class="fa fa-angle-down horizontal-icon"></i></a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="/deposit/list">รายการฝากเงิน</a></li>
                                    <li aria-haspopup="true"><a href="/deposit/affiliate">รายการแนะนำเพื่อน</a></li>
                                    <li aria-haspopup="true"><a href="/deposit/bonus">รายการรับโบนัส</a></li>
                                </ul>
                            </li>
                            <li aria-haspopup="true"><a href="#" class="sub-icon"><i class="fa fa-money hor-icon"></i>
                                    ถอนเงิน <i class="fa fa-angle-down horizontal-icon"></i></a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="/withdraw/wait">รอทำรายการ</a></li>
                                    <li aria-haspopup="true"><a href="/withdraw/list">ประวัติการทำรายการ</a></li>
                                    <li aria-haspopup="true"><a href="/withdraw/extra">ถอนเงินพิเศษ</a></li>
                                </ul>
                            </li>
                            <li aria-haspopup="true"><a href="/wallet" class="sub-icon"><i class="fa fa-list hor-icon"></i>
                                    Wallet </a>
                            </li>
                            <li aria-haspopup="true"><a href="#" class="sub-icon"><i
                                        class="fa fa-refresh hor-icon"></i> Agent <i
                                        class="fa fa-angle-down horizontal-icon"></i></a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="/agent/add">เพิ่มเครดิต</a></li>
                                    <li aria-haspopup="true"><a href="/agent/del">ถอนเครดิต</a></li>
                                </ul>
                            </li>
                            <li aria-haspopup="true"><a href="#" class="sub-icon"><i
                                        class="fa fa-university hor-icon"></i> Bank <i
                                        class="fa fa-angle-down horizontal-icon"></i></a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="#">รายการเงินเข้า</a></li>
                                    <li aria-haspopup="true"><a href="#">รายการเงินออก</a></li>
                                </ul>
                            </li>
                            <li aria-haspopup="true" class="float-right"><a href="https://bo.sai.slgaming.net/?lang=en-US" target="saoffice" class="sub-icon"><i class="fa fa-chevron-right hor-icon"></i>
                                    SA Office </a>
                            </li>
                        </ul>
                    </nav>
                    <!--Nav end -->
                </div>
            </div>
            <!-- Horizontal-menu end -->

            