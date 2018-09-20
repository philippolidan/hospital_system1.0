<?php include('assets/parts/header.php'); ?>

<div class="wrapper">

	<?php include('assets/parts/doctor_sidebar.php'); ?>

	<!-- Page Content  -->
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

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2">
				<h3 class="">Patients</h3><hr>
			</div>

			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<table class="table" style="width: 100%">
					<thead>
						<tr>
							<th>Full Name</th>
							<th width="10%">Actions</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Cuevas, Mark Dherrick P.</td>
							<td>
								<button class="btn btn-info btn-sm" data-toggle="modal" data-target="#m_patient_profile"><i class="fas fa-eye"></i></button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>

	</div>

</div>

<?php include('assets/parts/scripts.php'); ?>

<?php include('assets/modals/m_patient_profile.php'); ?>

<script type="text/javascript">
	$(".table").DataTable();
</script>