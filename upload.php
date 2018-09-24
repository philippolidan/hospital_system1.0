<html>
<head>
	<meta name="copyright" content="ALPAX Software Solutions" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/color.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
	<link rel="stylesheet" type="text/css" href="assets/css/smart_wizard.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/smart_wizard_theme_arrows.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/smart_wizard_theme_circles.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/smart_wizard_theme_dots.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/select2.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/jasny-bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/animate.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<style>
	@import url('https://fonts.googleapis.com/css?family=Raleway');
	@import url('https://fonts.googleapis.com/css?family=Poppins');

	h1, h2, h3, h4, h5, h6{
		font-family: 'Poppins'
	}

	body{
		font-family: 'Raleway';
		font-size: 13px;
	}

	.slider {
		-webkit-appearance: none;
		width: 100%;
		height: 25px;
		background: #d3d3d3;
		outline: none;
		opacity: 0.7;
		-webkit-transition: .2s;
		transition: opacity .2s;
	}

	.slider:hover {
		opacity: 1;
	}

	.slider::-webkit-slider-thumb {
		-webkit-appearance: none;
		appearance: none;
		width: 25px;
		height: 25px;
		background: #4CAF50;
		cursor: pointer;
	}

	.slider::-moz-range-thumb {
		width: 25px;
		height: 25px;
		background: #4CAF50;
		cursor: pointer;
	}

	.sw-toolbar-bottom{
		display: none;
	}

	.billing-patient-details{
		margin-bottom: 0;
	}

	p{
		margin-bottom: 0.5rem;
	}
	
</style>
</head>

<body>
	<div>

		<form id="upload_form" method="POST">
			<div class="row">

				<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
					<div class="form-group">
						<input type="file" class="form-control" name="fileToUpload">
					</div>
				</div>

				<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
					<button class="btn btn-primary" type="submit">Submit</button>
				</div>

			</div>
		</form>

	</div>
</body>
<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.smartWizard.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/popper.min.js"></script>
<script type="text/javascript" src="assets/js/validator.min.js"></script>
<script type="text/javascript" src="assets/js/select2.min.js"></script>
<script type="text/javascript" src="assets/js/pdfmake.min.js"></script>
<script type="text/javascript" src="assets/js/vfs_fonts.js"></script>
<script type="text/javascript" src="assets/js/datatables.min.js"></script>
<script type="text/javascript" src="assets/js/chart.min.js"></script>

<script type="text/javascript">
	$("#upload_form").on("submit", function(e){
		e.preventDefault();
		var form = document.querySelector("#upload_form");

		var formData = new FormData(form);

		$.ajax({
			type: "POST",
			url: "assets/includes/upload_handler.php",
			data: formData,
			cache:false,
			contentType: false,
			processData: false
		}).done(function(data) {

			responseText = data;
			result = jQuery.parseJSON(responseText);
			console.log(result);

		}).fail(function( jqXHR, textStatus ){
			console.log(textStatus);
		});
	});
</script>

</html>