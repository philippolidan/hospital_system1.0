<!-- Modal -->
<div class="modal fade" id="m_select_patient_bed" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle"><span id="test_name">Assign Hospital Bed</span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

					<table id="bed_table" class="table hover table-responsive" style="width: 100%">
						<thead>
							<tr>
								<th width="5%">Bed No.</th>
								<th width="75%">Ward No.</th>
								<th width="25%">Floor</th>
								<th width="25%">Status</th>
								<th width="25%">Actions</th>
							</tr>
						</thead>

						<tbody id="bed_tbody">

						</tbody>

					</table>

					<!-- <h6 class="font-weight-bold text-success">VACANT</h6>
					<h6 class="font-weight-bold text-danger">OCCUPIED</h6>
					<button class="btn btn-primary btn-sm"><i class="fas fa-check"></i></button> -->

				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
</script>