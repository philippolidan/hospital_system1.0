<?php include('assets/parts/header.php'); include('assets/parts/session_page.php');?>
<?php include('assets/parts/navbar.php'); ?>

<div class="container mt-5 mb-5 bg-white">

	<h3>Medical Records</h3>

	<hr>

	<div>
		<a href="patient_homepage.php"><i class="fas fa-home"></i> Home</a> /
		<a href="patient_medical_records.php">Medical Records</a>
	</div>

	<hr>

	<div class="row">

		<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
			<table id="table_medical_records" class="table hover">
				<thead>
					<tr>
						<th>No.</th>
						<th>Hospital Name</th>
						<th>Date & Time</th>
						<th>Actions</th>
					</tr>
				</thead>
			</table>
		</div>

	</div>
</div>

<?php include('assets/parts/scripts.php'); ?>

<script type="text/javascript">
	$("#table_medical_records").DataTable();
</script>