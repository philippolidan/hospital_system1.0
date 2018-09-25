<?php include('assets/parts/header.php'); ?>

<div class="wrapper">

	<?php include('assets/parts/admission_sidebar.php'); ?>

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
				<h3 class="border-bottom mt-2 mb-2">Admission Requests</h3>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<table id="admission_table" class="table hover" style="width: 100%;">
					<thead>
						<tr>
							<th>Patient No.</th>
							<th>Name</th>
							<th>Birthday</th>
							<th width="10%">Actions</th>
						</tr>
					</thead>

					<tbody>
						
					</tbody>
				</table>

				<button class="btn btn-primary btn-sm" title="Add Result" data-target="#m_add_evaluation" data-toggle="modal"><i class="fas fa-bed"></i></button>

			</div>

		</div>

	</div>

</div>

<?php include('assets/parts/scripts.php'); ?>
<?php include('assets/modals/m_add_admission.php'); ?>

<script type="text/javascript">
	$("#admission_table").DataTable();
</script>