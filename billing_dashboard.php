<?php include('assets/parts/header.php'); ?>

<div class="wrapper">

	<?php include('assets/parts/billing_sidebar.php'); ?>

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

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<h3 class="border-bottom mt-2 mb-2">Billing</h3>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<table id="billing_table" class="table hover">
					<thead>
						<tr>
							<th>Patient No.</th>
							<th>Name</th>
							<th>Birthday</th>
							<th>Actions</th>
						</tr>
					</thead>
				</table>
			</div>

			<button class="btn btn-primary btn-sm" title="Generate Bill" data-toggle="modal" data-target="#m_view_patient_bill"><i class="fa fa-file-invoice"></i></button>

		</div>

	</div>
	<!-- Page Content -->

</div>

<?php include('assets/parts/scripts.php'); ?>
<?php include('assets/modals/m_view_patient_bill.php'); ?>

<script type="text/javascript">
	$("#billing_table").DataTable();
</script>