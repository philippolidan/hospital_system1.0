<?php include('assets/parts/header.php'); ?>

<div class="wrapper">

	<?php include('assets/parts/laboratory_sidebar.php'); ?>

	<!-- Page Content -->
	<div id="content">

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">

				<button type="button" id="sidebarCollapse" class="btn btn-info">
					<i class="fas fa-bars"></i>
				</button>
				<!-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fas fa-align-justify"></i>
				</button> -->
			</div>
		</nav>

		<div class="row">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2 mb-2">
				<div class="d-flex border-bottom">
					<div>
						<h3 class="">Lab Tests</h3>
					</div>

					<div class="ml-auto">
						<!-- <a href="patient_registration.php" class="btn btn-info" style="color: white"><i class="fas fa-plus"></i> Add Transaction</a> -->
					</div>
				</div>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2 mb-2">

				<table id="lab_test_table" class="table hover" style="width: 100%;">
					<thead>
						<tr>
							<th>Patient No.</th>
							<th>Patient Name</th>
							<th>Birthday</th>
							<th>Test Name</th>
							<th>Status</th>
							<th width="10%">Actions</th>
						</tr>
					</thead>

					<tbody>
						
					</tbody>
				</table>

				<button class="btn btn-primary btn-sm" title="Add Result" data-target="#m_input_test_result" data-toggle="modal"><i class="fas fa-plus"></i></button>

				<p class="text-success font-weight-bold">COMPLETED</p>
				<p class="text-orange-400 font-weight-bold">PENDING</p>

			</div>

		</div>

	</div>

</div>

<?php include('assets/parts/scripts.php'); ?>
<?php include('assets/modals/m_input_lab_result.php'); ?>

<script type="text/javascript">
	$("#lab_test_table").DataTable({
		"language": {
			"emptyTable": "No Available Lab Test Request"
		}
	});
</script>