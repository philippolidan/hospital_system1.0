<?php include('assets/parts/header.php');
$db = new Database;
session_start();
if(isset($_SESSION['user_id'])){
	$result = $db->loginUserById($_SESSION['user_id']);
	if($result){
		if ($result['role_id'] == 4) {
			echo "<script>window.location='doctor_dashboard.php'</script>";
		}

		if ($result['role_id'] == 5) {
			echo "<script>window.location='patient_dashboard.php'</script>";
		}
	}
	
	// if(count($result) > 0){
	// 	foreach($result as $res){
	// 		echo 1;
	// 		// if ($res->role_id == 4) {
	// 		// 	header('Location: ../../doctor_dashboard.php');
	// 		// }

	// 		// if ($res->role_id == 5) {
	// 		// 	header('Location: ../../patient_dashboard.php');
	// 		// }
	// 	}
	// }
} ?>

<link rel="stylesheet" type="text/css" href="assets/css/login_style.css">

<style type="text/css">
.form-control{
	height: calc(2.75rem + 2px);
}
</style>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 mt-4 mb-4">
	<div class="form-signin mt-4 bg-white">
		<div class="text-center mb-4">
			<img class="mb-4" src="assets/img/icons/pharmacy.svg" alt="" width="72" height="72">
			<h1 class="h3 mb-1 font-weight-bold">ALPAX</h1>
			<h6>Hospital & Medical Center</h6>
			<hr>
			<p id="login_text" class="text-warning font-weight-bold">
				
				<?php

				if (isset($_GET['err'])) {
					$err = $_GET['err'];
					switch ($err) {
						case '0':
						echo "Incorrect parameters passed.";
						break;

						case '1':
						echo "Incorrect credentials. Please try again.";
						break;
						
						default:
						echo "Unknown error. Please try again.";
						break;
					}
				}

				?>
			</p>
		</div>

		<form id="login_form" method="POST" action="assets/includes/users_handler.php">
			<div class="form-label-group">
				<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email">
				<label for="inputEmail" class="font-weight-bold">Email Address</label>
			</div>

			<div class="form-label-group">
				<input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
				<label for="inputPassword" class="font-weight-bold">Password</label>
			</div>

			<button class="btn btn-lg btn-info btn-block" type="submit">Sign in</button>
		</form>

		<hr>
		<p class="mt-5 mb-3 text-muted text-center">&copy; 2018 - ALPAX Software Solutions</p>
	</div>
</div>

<?php include('assets/parts/scripts.php'); ?>

<script type="text/javascript">
	$("#login_form").on("submit", function(e){
		var form_data = $(this).serializeArray();

		setTimeout(function(){
			/*$("input[name='email_address']").prop("disabled", true);
			$("input[name='password']").prop("disabled", true);*/
			$("#login_form").animateCss("fadeOut", function(){
				$("#login_form").hide();
				$("#loader").show();
				$("#login_text").html("Please wait...");
			});
		},200);
	});
</script>