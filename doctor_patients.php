<?php  include('assets/parts/header.php'); include('assets/parts/session_page.php');
$db = new Database;
// foreach($db->getPatientERById("5ba35679b8dde11e54001970","5ba35679b8dde11e54001968") as $er){
// 	foreach($er->patient as $patient){
// 	}
// 	foreach($er->triage as $triage){
// 		var_dump($triage);
// 	}
// }
?>

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
				<div class="d-flex">
					<div>
						<h3 class="">ER Transaction</h3><hr>
					</div>

					<div class="ml-auto">
						<a href="patient_registration.php" class="btn btn-info" style="color: white"><i class="fas fa-plus"></i> Add Transaction</a>
					</div>
				</div>
			</div>

			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
				<table class="table" style="width: 100%">
					<thead>
						<tr>
							<th>Patient ID</th>
							<th>Patient Name</th>
							<th>Status</th>
							<th width="10%">Actions</th>
						</tr> b 
					</thead>
					<tbody>
						<?php
							foreach($db->getERS() as $er){ ?>
								<tr>
									<td>PT - <?php echo $er->patient_id?></td>
									<?php foreach($er->patient as $patient){ ?>
									<td><?php echo $patient->lname.", ".$patient->fname." ".$patient->mname?></td>
									<?php }?>
									<td><?php echo ucfirst($er->status)?></td>
									<td>
										<button class="btn btn-info btn-sm" data-toggle="modal" data-target="m_patient_profile" onclick="open_modal(this)" value="<?php echo $er->_id.','.$er->patient_oid?>"><i class="fas fa-eye"></i></button>
									</td>
								</tr>
							<?php }
						?>
						
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
	$("#patient").addClass("active");
	$("#doctor").removeClass("active");
	function open_modal(object){
		var val = $(object).val();
		val = val.split(",");
		var type = null;
		var id;
		var modal = $(object).data('target');  
		$.ajax({
			url:"assets/includes/class_handler.php",
			type: "POST",
			data: {id:10, er_id : val[0],patient_oid:val[1] },
			success: function(data){
				var data = JSON.parse(data);
				$("#pname").text(data[0]);
				$("#p_id").text("PT-"+data[1]);
				$("#a_date").text(data[2]);
				$("#bp").text(data[3]);
				$("#breathing").text(data[4]);
				$("#pulse").text(data[5]);
				$("#temp").text(data[6]+"°");
				$("#isallergic").text(data[7]);
				$("#hasmedication").text(data[9]);
				if(data[8] == "" && data[10] == ""){
					$("#allergies").text("None");
					$("#medications").text("None");
				}
				else{
					$("#allergies").text(data[8]);
					$("#medications").text(data[10]);
				}
				if(data[12].length > 0){
					console.log(data[12].length);
					for(var i = 0; i<data[12].length; i++){
						$("#lab_test").html(data[12][i]);
					}
				}
				$("#img").attr("src","assets/img/avatars/"+data[11]+".svg")
				$("#"+modal).modal("show");
			}
		});
	}
</script>