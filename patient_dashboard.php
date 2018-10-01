<?php include('assets/parts/header.php'); include('assets/parts/session_page.php');?>

<div class="wrapper">

	<?php include('assets/parts/patient_sidebar.php'); ?>

	<!-- Page Content  -->
	<div id="content">

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">

				<button type="button" id="sidebarCollapse" class="btn btn-info">
					<i class="fas fa-bars"></i>
				</button>
				<!-- <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fas fa-align-justify"></i>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="nav navbar-nav ml-auto mt-4 mb-2">
						<li class="nav-item active">
							<a class="nav-link" href="#">Logout</a>
						</li>
					</ul>
				</div> -->
			</div>
		</nav>

		<div class="row">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="d-flex">
					<div></div>
					<div class="ml-auto"></div>
				</div>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="my-3 p-3 bg-white rounded shadow-sm">
					<h6 class="border-bottom border-gray pb-2 mb-0">CURRENT MEDICATIONS & ACTIVITY</h6>

					<div class="media text-muted pt-3">
						<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
							<div class="d-flex justify-content-between align-items-center w-100">
								<strong class="text-gray-dark">MONDAY</strong>
								<a href="#" class="text-info">View</a>
							</div>
							<span class="d-block">7:00 AM - Ambroxol 50 mg (<strong class="text-gray-dark">1 Tablet</strong>)</span>
						</div>
					</div>

					<div class="media text-muted pt-3">
						<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
							<div class="d-flex justify-content-between align-items-center w-100">
								<strong class="text-gray-dark">TUESDAY</strong>
								<a href="#" class="text-info">View</a>
							</div>
							<span class="d-block">No Medication</span>
						</div>
					</div>

					<div class="media text-muted pt-3">
						<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
							<div class="d-flex justify-content-between align-items-center w-100">
								<strong class="text-gray-dark">WEDNESDAY</strong>
								<a href="#" class="text-info">View</a>
							</div>
							<span class="d-block">No Medication</span>
						</div>
					</div>

					<div class="media text-muted pt-3">
						<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
							<div class="d-flex justify-content-between align-items-center w-100">
								<strong class="text-gray-dark">THURSDAY</strong>
								<a href="#" class="text-info">View</a>
							</div>
							<span class="d-block">No Medication</span>
						</div>
					</div>

					<div class="media text-muted pt-3">
						<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
							<div class="d-flex justify-content-between align-items-center w-100">
								<strong class="text-gray-dark">FRIDAY</strong>
								<a href="#" class="text-info">View</a>
							</div>
							<span class="d-block">No Medication</span>
						</div>
					</div>
					
					<div class="media text-muted pt-3">
						<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
							<div class="d-flex justify-content-between align-items-center w-100">
								<strong class="text-gray-dark">SATURDAY</strong>
								<a href="#" class="text-info">View</a>
							</div>
							<span class="d-block">No Medication</span>
						</div>
					</div>

				</div>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="my-3 p-3 bg-white rounded shadow-sm">
					<h6 class="border-bottom border-gray pb-2 mb-0">MEDICAL JOURNAL</h6>

					<div class="media text-muted pt-3">
						<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
							<div class="d-flex justify-content-between align-items-center w-100">
								<h6 class="mb-1 text-info">Dr. Christian Historillo</h6>
								<a href="#" class="text-info">View</a>
							</div>
							<span class="d-block">September 18, 2018 - 9:30 AM</span>
							<p>ALPAX Hospital & Medical Center</p>
						</div>
					</div>

					<div class="media text-muted pt-3">
						<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
							<div class="d-flex justify-content-between align-items-center w-100">
								<h6 class="mb-1 text-info">Dr. Jomer Buñag</h6>
								<a href="#" class="text-info">View</a>
							</div>
							<span class="d-block">September 20, 2018 - 11:30 AM</span>
							<p>ALPAX Hospital & Medical Center</p>
						</div>
					</div>

				</div>
			</div>

		</div>

	</div>
</div>
<?php include('assets/parts/scripts.php'); ?>