<?php 



session_start();



?>



<!doctype html>



<html lang="en" dir="ltr">



<head>



<?php 



    require(dirname(__FILE__).'/template/head.php');



?>



</head>







	<body class="bg-account">



	    <!-- page -->



		<div class="page">



		



		<?php 



			if(isset($_POST['username']) AND isset($_POST['password'])){



				require(dirname(__FILE__).'/class/database.php');



				$mysqli = new DB();



				//$data = $mysqli->query("SELECT * FROM `slot_admin` WHERE `admin_user` = ? AND `admin_pass` = ? ",trim($_POST['username']),trim($_POST['password']))->fetchArray();

				$data = $mysqli->query("SELECT * FROM `slot_admin` WHERE `admin_user` = ? AND `admin_pass` = ? ",trim($_POST['username']),trim($_POST['password']))->fetchArray();

				//print_r($data);



				if(isset($data['admin_id'])){



					$_SESSION['admin'] = $data;



					$mysqli->close();



					header('Location:/office69/main');



				}



			}



		?>



			<!-- page-content -->



			<div class="page-content">



				<div class="container text-center text-dark">



					<div class="row">



						<div class="col-lg-4 d-block mx-auto">



							<div class="row">



								<div class="col-xl-12 col-md-12 col-md-12">



									<div class="card">



										<div class="card-body">



											<div class="text-center mb-6">



												<img src="assets/images/logo.png" class="" alt="">



											</div>



											<form method="POST">



											<div class="input-group mb-3">



												<span class="input-group-addon "><i class="fa fa-user"></i></span>



												<input type="text" name="username" class="form-control" placeholder="Username">



											</div>



											<div class="input-group mb-4">



												<span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>



												<input type="password" name="password" class="form-control" placeholder="Password">



											</div>



											<div class="row">



												<div class="col-12">



													<button type="submit" class="btn btn-primary btn-block">Login</button>



												</div>



											</div>



											</form>



										</div>



									</div>



								</div>



							</div>



						</div>



					</div>



				</div>







			</div>



			<!-- page-content end -->



		</div>



		<!-- page End-->



		<?php 



        	require(dirname(__FILE__).'/template/js.php');



    	?>



	</body>



</html>