<?php include('assets/parts/header.php'); ?>

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
			<p id="login_text">Please enter your credentials</p>
		</div>

		<form id="login_form" method="POST">
			<div class="form-label-group">
				<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus name="email_address">
				<label for="inputEmail" class="font-weight-bold">Email Address</label>
			</div>

			<div class="form-label-group">
				<input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
				<label for="inputPassword" class="font-weight-bold">Password</label>
			</div>

			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
		</form>

		<hr>
		<p class="mt-5 mb-3 text-muted text-center">&copy; 2018 - ALPAX Software Solutions</p>
	</div>
</div>

<?php include('assets/parts/scripts.php'); ?>

<script type="text/javascript">
	$("#login_form").on("submit", function(e){
		e.preventDefault();

		var form_data = $(this).serializeArray();
		console.log(form_data);

		setTimeout(function(){
			/*$("input[name='email_address']").prop("disabled", true);
			$("input[name='password']").prop("disabled", true);*/
			$("#login_form").animateCss("fadeOut", function(){
				$("#login_form").hide();
			});
		},200);
	});
</script>