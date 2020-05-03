<!--app-header-->

<div class="app-header header d-flex">

	<div class="container-fluid">

		<div class="d-flex">

			<a class="header-brand" href="/office69/main">

				XOSLOT69

			</a><!-- logo-->

			<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>



			<div class="d-flex order-lg-2 ml-auto header-rightmenu">

				<div class="dropdown header-notify">

					<a class="nav-link icon" data-toggle="dropdown" aria-expanded="false">

						<i class="fe fe-user"></i>

						<span class="pulse bg-success"></span>

					</a>

					<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">

						<div class="dropdown-divider"></div>

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



<!-- Sidebar menu-->

<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar toggle-sidebar">

	<div class="app-sidebar__user pb-0">

		<div class="user-info">

			<p class="ml-2"><span class="text-dark app-sidebar__user-name font-weight-semibold"><?php echo $_SESSION['admin']['admin_name'];?></span><br>

				<span class="text-muted app-sidebar__user-name text-sm"><?php echo $_SESSION['admin']['admin_user'];?></span>

			</p>

		</div>

	</div>



	<div class="tab-menu-heading siderbar-tabs border-0  p-0">

		<div class="tabs-menu ">

			<!-- Tabs -->

			<ul class="nav panel-tabs">

				<li><a href="?logout" title="logout"><i class="fa fa-power-off fs-17"></i></a></li>

			</ul>

		</div>

	</div>

	<div class="panel-body tabs-menu-body side-tab-body p-0 border-0 ">

		<div class="tab-content">

			<div class="tab-pane active " id="index1">

				<ul class="side-menu toggle-menu">

					<li class="slide">

						<a class="side-menu__item" data-toggle="slide" href="#"><i

								class="side-menu__icon typcn typcn-device-desktop"></i><span

								class="side-menu__label">Summary</span><i class="angle fa fa-angle-right"></i></a>

						<ul class="slide-menu">

							<li><a class="slide-item" href="/office69/main"><span>สรุปวันนี้</span></a></li>

							<li><a class="slide-item" href="/office69/month"><span>สรุปรายเดือน</span></a></li>

						</ul>

					</li>



					<li class="slide">

						<a class="side-menu__item" data-toggle="slide" href="#"><i

								class="side-menu__icon fa fa-external-link-square"></i><span

								class="side-menu__label">Admin Menu</span><i class="angle fa fa-angle-right"></i></a>

						<ul class="slide-menu">

							<?php if($_SESSION['admin']['admin_level'] == 99){ ?>

							<li><a class="slide-item" href="/office69/report/user"><span>Report แยกเบอร์ลูกค้า</span></a></li>

							<li><a class="slide-item" href="/office69/report/bonus"><span>Report โบนัส</span></a></li>

							<li><a class="slide-item" href="/office69/report/bank"><span>Admin เงินออกบัญชี</span></a></li>

							<li><a class="slide-item" href="/office69/report/admin"><span>Admin ประวัติพนักงาน</span></a></li>

							<li><a class="slide-item" href="/office69/report/admin/button"><span>Admin ประวัติใช้ยอด</span></a></li>

							<li><a class="slide-item" href="/office69/office"><span>Admin เพิ่ม/ลด พนักงาน</span></a></li>

							<li><a class="slide-item" href="/office69/report/wallet_out"><span>ประวัติยอดเงินออก Wallet</span></a></li>



							<?php } ?>

						</ul>

					</li>



					<li>

						<a class="side-menu__item" href="/office69/member"><i

								class="side-menu__icon typcn typcn-group"></i><span

								class="side-menu__label">Member</span></a>

					</li>

					<li>

						<a class="side-menu__item" href="/office69/deposit"><i

								class="side-menu__icon fa fa-usd"></i><span

								class="side-menu__label">รายการเพิ่มเครดิต</span></a>

					</li>

					<li class="slide">

						<a class="side-menu__item" data-toggle="slide" href="#"><i

								class="side-menu__icon fa fa-money"></i><span

								class="side-menu__label">ถอนเงิน</span><i class="angle fa fa-angle-right"></i></a>

						<ul class="slide-menu">

							<li><a href="/office69/withdraw/" class="slide-item"> รอทำรายการ</a></li>

							<li><a href="/office69/withdraw/list" class="slide-item"> ประวัติการทำรายการ</a></li>

						</ul>

					</li>

					<li>

						<a class="side-menu__item" href="/office69/wallet"><i

								class="side-menu__icon fa fa-list"></i><span

								class="side-menu__label">Wallet</span></a>

					</li>

					<li class="slide">

						<a class="side-menu__item" data-toggle="slide" href="#"><i

								class="side-menu__icon fa fa-refresh"></i><span

								class="side-menu__label">Agent</span><i class="angle fa fa-angle-right"></i></a>

						<ul class="slide-menu">

							<li><a href="/office69/agent/add" class="slide-item"> เพิ่มเครดิต</a></li>

							<li><a href="/office69/agent/del" class="slide-item"> ถอนเครดิต</a></li>

							<li><a href="/office69/free" class="slide-item"> เปิดเครดิตฟรี</a></li>

							<!--<li><a href="/creditfree" class="slide-item"> เปิดเครดิตฟรี (ใหม่)</a></li> <li><a href="/office69/agent/return" class="slide-item"> ตืนยอดเล่น</a></li>-->

						</ul>

					</li>

					<li class="slide">

						<a class="side-menu__item" data-toggle="slide" href="#"><i

								class="side-menu__icon fa fa-university"></i><span

								class="side-menu__label">Bank</span><i class="angle fa fa-angle-right"></i></a>

						<ul class="slide-menu">

							<li><a href="/office69/bank" class="slide-item"> รายการธนาคาร</a></li>

							<li><a href="/office69/transfer" class="slide-item"> โยกเงิน</a></li>

						</ul>

					</li>

					<li class="slide">

						<a class="side-menu__item" data-toggle="slide" href="#"><i

								class="side-menu__icon fa fa-cog"></i><span

								class="side-menu__label">Setting</span><i class="angle fa fa-angle-right"></i></a>

						<ul class="slide-menu">

							<li><a href="/office69/setting/credit_free" class="slide-item"> เครดิตฟรี</a></li>

							<li><a href="/office69/setting/setting_withdraw" class="slide-item"> ตั้งค่าถอนเงิน</a></li>

							<li><a href="/office69/setting/withdraw" class="slide-item"> ตั้งค่าบัญชีถอนเงิน</a></li>

						</ul>

					</li>

					<li>

						<a class="side-menu__item" href="http://ag.slotxo.com" target="_blank"><i

								class="side-menu__icon fa fa-arrow-right"></i><span

								class="side-menu__label">Agent Office</span></a>

					</li>

				</ul>

			</div>

		</div>

	</div>

</aside>

<!--sidemenu end-->