<!-- Modal -->
<div class="modal fade" id="m_add_evaluation" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-fluid" role="document">
		<div class="modal-content">

			<div class="modal-body" style="background-color: #fbfbfb;">
				<div class="row">

					<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
						<div class="d-flex">
							<div>
								<h4 class="text-dark">Evaluation</h4>
							</div>
							<div class="ml-auto">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true" class="text-danger">&times;</span>
								</button>
							</div>
						</div>
					</div>

					<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

						<div class="row">

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="my-2 p-3 bg-white rounded shadow-sm">
									<div class="row">

										<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
											<h6 class="bg-info small text-light p-2 text-center">Patient Overview</h6>
										</div>

										<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
											<div class="media text-muted pt-3">
												<img src="assets/img/avatars/man.svg" alt="" class="mr-2 rounded" style="height: 60px; width: 60px;" id="img">
												<div class="media-body pb-3 mb-0 small lh-125" style="font-size: 12px;">
													<div class="d-flex justify-content-between align-items-center w-100">
														<strong class="text-dark" id="pname">Mr. Mark Dherrick P. Cuevas</strong>
													</div>
													<span class="d-block" id="p_id">Patient No: ALPX-3829</span>
													<span class="d-block" id="birthdate">July 23, 1997</span>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="bed_assignment">
								<div class="my-2 p-3 bg-white rounded shadow-sm">
									<div class="row">

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<h6 class="bg-info small text-light p-2">Bed Assignment</h6>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2 mb-2">
											<select id="room_type" class="select2" style="width: 100%">
												<option disabled selected>Select Room Type</option>
												<option value="1">Suite</option>
												<option value="2">Private</option>
												<option value="3">Semi Private</option>
												<option value="4">Ward</option>
											</select>
										</div>

										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2 mb-2">
											<table id="bed_list_table" class="table hover">
												<thead>
													<tr>
														<th>Bed No.</th>
														<th>Room No.</th>
														<th>Floor</th>
														<th width="5%">Actions</th>
													</tr>
												</thead>
											</table>

											<button class="btn-select-bed btn btn-sm btn-primary"><i class="fa fa-check"></i></button>
										</div>

									</div>
								</div>
							</div>

							<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12"  id="evaluation_part">
								<div class="my-2 p-3 bg-white rounded shadow-sm">
									<div class="row">

										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											<div class="row">

												<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
													<h6 class="bg-info small text-light p-2">Symptoms</h6>

													<ul class="list-group mb-3">

														<li class="list-group-item d-flex justify-content-between lh-condensed">
															<div>
																<small class="text-muted">Abdominal Pain</small>
															</div>
															<span class="text-muted small text-info font-weight-bold view-symptoms">View</span>
														</li>
														
													</ul>
												</div>

											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											<div class="row">

												<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
													<h6 class="bg-info small text-light p-2">Laboratory Results</h6>

													<ul class="list-group mb-3">

														<li class="list-group-item d-flex justify-content-between lh-condensed">
															<div>
																<small class="text-muted">Sonography (Ultrasound)</small>
															</div>
															<span class="view-lab-result text-muted small text-info font-weight-bold">View</span>
														</li>
														
													</ul>
												</div>

											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
											<div class="row">

												<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
													<h6 class="bg-info small text-light p-2">Prescription</h6>
												</div>

												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
													<input type="text" class="form-control" name="medicine_name" placeholder="Search for medicine...">
												</div>

												<div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
													<input type="text" class="form-control" name="dosage" placeholder="Dosage">
												</div>

												<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
													<input type="text" class="form-control" name="frequency" placeholder="Frequency">
												</div>

												<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 float-right">
													<button class="btn btn-primary btn-sm " type="button"><i class="fa fa-plus"></i></button>
												</div>

												<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-2 mb-2">
													<table id="prescription_table" class="table hover" style="width: 100%">
														<thead>
															<tr>
																<th>Name</th>
																<th>Dosage</th>
																<th>Frequency</th>
																<th>Actions</th>
															</tr>
														</thead>
													</table>
												</div>

											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
											<div class="row">

												<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
													<h6 class="bg-info small text-light p-2">Dietary</h6>
												</div>

												<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
													<textarea class="form-control" placeholder="Enter Dietary Plan..." name="dietary"></textarea>
												</div>

											</div>
										</div>

									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" id="lab_result">
						<div class="row">

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="my-2 p-3 bg-white rounded shadow-sm">
									<div class="row">

										<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
											<div class="row">
												<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
													<h6 class="bg-info small text-light p-2 text-center">Lab Result</h6>
												</div>

												<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-right">
													<h6 class="go-back-lab bg-info-800 small text-light p-2 text-center">Go Back</h6>
												</div>
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
											<p class="small border-bottom">Sonograph (Ultrasound)</p>

											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>

						</div>
					</div>

					<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" id="symptoms">
						<div class="row">

							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="my-2 p-3 bg-white rounded shadow-sm">
									<div class="row">

										<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
											<div class="row">
												<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
													<h6 class="bg-info small text-light p-2 text-center">Symptoms</h6>
												</div>

												<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-right">
													<h6 class="go-back-symptoms bg-info-800 small text-light p-2 text-center">Go Back</h6>
												</div>
											</div>
										</div>

										<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
											<p class="small border-bottom">Abdominal Pain</p>

											<div class="row">
												<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>

			<div class="modal-footer justify-content-center">
				<button class="btn btn-primary btn-lg">Admit</button>
			</div>

		</div>
	</div>

	<script type="text/javascript">
		$("#room_type").select2();
		$("#bed_list_table").DataTable();

		$(".btn-select-bed").on("click", function(){

		});

		$("#lab_result").hide();
		$("#symptoms").hide();

		$("#prescription_table").DataTable({
			"bPaginate": false,
			"bLengthChange": false,
			"bFilter": false,
			"bInfo": false,
			"language" : {
				"emptyTable" :"No Prescription Available"
			}
		});

		$(".view-lab-result").on("click", function(){
			$("#lab_result").animate({
				opacity: 1,
				center: "+=50",
				height: "toggle"
			}, 400, function(){});

			$( "#evaluation_part" ).animate({
				opacity: 0.25,
				center: "+=50",
				height: "toggle"
			}, 400, function(){});
		});

		$(".go-back-lab").on("click", function(){
			$("#lab_result").animate({
				opacity: 0.25,
				center: "+=50",
				height: "toggle"
			}, 400, function(){});

			$("#evaluation_part").animate({
				opacity: 1,
				center: "+=50",
				height: "toggle"
			}, 400, function(){});
		});

		$(".view-symptoms").on("click", function(){
			$("#symptoms").animate({
				opacity: 1,
				center: "+=50",
				height: "toggle"
			}, 400, function(){});

			$("#evaluation_part").animate({
				opacity: 0.25,
				center: "+=50",
				height: "toggle"
			}, 400, function(){});
		});

		$(".go-back-symptoms").on("click", function(){
			$("#symptoms").animate({
				opacity: 0.25,
				center: "+=50",
				height: "toggle"
			}, 400, function(){});

			$("#evaluation_part").animate({
				opacity: 1,
				center: "+=50",
				height: "toggle"
			}, 400, function(){});
		});
	</script>