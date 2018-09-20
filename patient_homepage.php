<?php include('assets/parts/header.php'); ?>
<?php include('assets/parts/navbar.php'); ?>

<style type="text/css">
.card-img{
	filter: blur(2px);
	position: absolute;
	top: 0;
	left: 0;
	right:0;
	bottom: 0;
	height: 100%;
	width:100%;
	z-index:1;
	object-fit: cover;
}
.card-img-overlay {
	position: static;
	z-index: 2;
}

.card-text{
	white-space: wrap;
	overflow: hidden;
}

</style>

<div class="container mb-5 mt-5">
	<div class="row">

		<div class="col-sm-4 col-md-4 mt-2 mb-2">
			<div class="card">
				<img class="card-img" src="assets/img/card_backgrounds/medical_records.jpg">
				<div class="card-img-overlay">
					<h5 class="card-title">Medical Records</h5>
					<p class="card-text">List of you medical history across time</p>
					<a href="patient_medical_records.php" class="btn btn-primary btn-sm mt-1">View</a>
				</div>
			</div>
		</div>

		<div class="col-sm-4 col-md-4 mt-2 mb-2">
			<div class="card">
				<img class="card-img" src="assets/img/card_backgrounds/appointments.jpg">
				<div class="card-img-overlay">
					<div class="d-flex">
						<div>
							<h5 class="card-title">Appointments</h5>
						</div>
						<div class="ml-auto">
							<h5 class="text-primary">1</h5>
						</div>
					</div>
					<p class="card-text">Records of your past and upcoming hospital visit</p>
					<a href="#" class="btn btn-primary btn-sm mt-1">View</a>
				</div>
			</div>
		</div>

		<div class="col-sm-4 col-md-4 mt-2 mb-2">
			<div class="card">
				<img class="card-img" src="assets/img/card_backgrounds/medications.jpg">
				<div class="card-img-overlay">
					<h5 class="card-title">Medications</h5>
					<p class="card-text">Drug prescriptions given by your doctor</p>
					<a href="#" class="btn btn-primary btn-sm mt-1">View</a>
				</div>
			</div>
		</div>

	</div>
</div>

<?php include('assets/parts/scripts.php'); ?>