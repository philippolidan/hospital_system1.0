<?php
include 'db_connect.php';
$db = new Database;
if(isset($_POST['id'])){
	$id = $_POST['id'];
	if($id == 1){
		if(isset($_POST['symptom_id'])){
			$symptom_id = $_POST['symptom_id'];
			$title ='';
			foreach ($db->getSymptom($symptom_id) as $symptom) {
				$title = $symptom->name;
			}
			$response ="<div id='$symptom_id' class='col-lg-6 col-md-6 col-sm-6 col-xs-6'>";
			$response .= "<h6>$title</h6><hr>";
			foreach ($db->getQuestions($symptom_id) as $question) {
				$response.="<div class='form-group'>";
				$type = $question->type;
				if($type =='rate'){
					$response.="<div class='d-flex'>";
					$response.="<div><label>$question->question</label></div>";
					$response.="<div class='ml-auto'><span id='$question->_id' class='text-warning' style='font-size: 15px;'>1</span></div>";
					$response.="</div>";
					$response.="<input type='range' class='slider to-d' name='$question->_id' onchange='rateChange(\"$question->_id\",this.value)' style='width: 100%' min='1' max='10' value='1'>";
					$response.="<div class='d-flex'><div>1</div><div class='ml-auto'>10</div></div>";
				}
				else if($type =='text'){
					$response.="<label>$question->question</label>";
					$response.="<textarea name='$question->_id' class='form-control'></textarea>";
				}
				else if($type =='y/n'){
					$response.="<label>$question->question</label>";
					$response.="<div class='row'>";
					$response.="<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>";
					$response.="<div class='form-check'>";
					$response.="<input class='form-check-input to-d' type='radio' name='".$question->_id."' id='".$question->_id."' value='yes'>";
					$response.="<label class='form-check-label' for='".$question->_id."_y'>Yes</label>";
					$response.="</div>";
					$response.="</div>";
					$response.="<div class='col-lg-2 col-md-2 col-sm-2 col-xs-2'>";
					$response.="<div class='form-check'>";
					$response.="<input class='form-check-input to-d' type='radio' name='".$question->_id."' id='".$question->_id."' value='no' checked>";
					$response.="<label class='form-check-label' for='".$question->_id."_n'>No</label>";
					$response.="</div>";
					$response.="</div>";
					$response.="</div>";
				}
				$response.="</div>";
			}
			$response.="</div>";
			echo $response;
		}
	}
	else if($id == 2){
		if(isset($_POST['test_id'])){
			$test_id = $_POST['test_id'];
			foreach ($db->getTest($test_id) as $test) {
				$name = $test->name;
				$description = $test->description;

			}
			echo json_encode(array($name,$description));
		}
	}
	else if($id == 3){
		$response=[];
		foreach ($db->getBeds() as $bed) {
			$response[]=array($bed->bed_no,$bed->ward_no,$bed->floor,$bed->status);
		}
		echo json_encode($response);
	}
	else if($id == 4){ //part 1 submit
		echo json_encode($db->insert_one($_POST));
	}
	else if($id == 5){
		$response=[];
		$patient_oid = (string) $_POST['test_id'];
		foreach ($db->getPatientTest($patient_oid) as $test) {
			foreach ($db->getTest($test->test_id) as $test1) {
				$t_id =  (string) $test->_id;
				$response[]=array($t_id,$test1->name,$test->date_completed,$test->status,$test1->name,$test->test_id);
			}
		}
		echo json_encode($response);
	}
	else if($id == 6){
		$type = $_POST['type'];
		$labtest_id = (string)$_POST['test_id'];
		//check if Done
		$checker = 0;
		foreach($db->getLabTest($labtest_id) as $lab){
			if($lab->status =='Done'){
				$checker = 1;
			}
			else 
				$checker = 0;
		}
		if($type == "Fecalysis"){//fecalysis
			if($checker == 1){
				foreach ( $db->getFecalysis($labtest_id) as $fec) {
					$response =
					[
						"Color", $fec->color,
						"Consistency" ,$fec->consistency,
						"Pus" ,$fec->pus,
						"Red Blood Cell" , $fec->rbc,
						"Others" , $fec->other,
						"interpretation", $fec->interpretation
					];
				}
			}
			else{
				$response = ["Color","Consistency","Pus","Red Blood Cell","Others"];
			}
		}
		else if($type == "Urinalysis"){//urinalysis
			if($checker == 1){
				foreach ( $db->getUrinalysis($labtest_id) as $uri) {
					$response =
					[
						"Color" , $uri->color,
						"Transparency" ,$uri->transparency,
						"Hemoglobin" , $uri->hemoglobin,
						"Hematocrit" , $uri->hematocrit,
						"White Blood Cell" , $uri->wbc,
						"Red Blood Cell" , $uri->rbc,
						"Pus", $uri->pus,
						"Platelet Count" , $uri->platelet_count,
						"interpretation", $uri->interpretation
					];
				}
			}
			else
				$response = ["Color","Transparency","Hemoglobin","Hematocrit","White Blood Cell","Red Blood Cell","Platelet Count","Pus"];
		}
		echo json_encode(array($checker,$response));
	}
	else if($id == 7){
		echo json_encode($db->insert_two($_POST['test_value']));
	}
	else if($id == 8){// get er + patient info for billing

		$lab_test1 = [];
		foreach($db->getPatientER($_POST['patient_oid']) as $res){
			$patient_name = $res->lname.", ".$res->fname." ".$res->mname;
			$patient_address = $res->address;
			$admission_date = "";
			$discharge_date = date("F d, Y h:i A");
			$bed_no = "";
			$ward_no = "";
			foreach($res->er_transaction as $er){
				$assessment_date = $er->assessment_date;
				if(isset($er->admission_date) && isset($er->bed_no) && isset($er->ward_no)){
					$admission_date = $er->admission_date;
					$bed_no = $er->bed_no;
					$ward_no = $er->ward_no;
				}
				$emergency_code = $er->emergency_code;
				if($er->wlt == 0){
					foreach($db->getLabTestByPatient($_POST['patient_oid']) as $lab_test){
						foreach ($lab_test->test_list as $lab) {
							$lab_test1[] = [$lab->name,$lab->price];
						}
						
					}
				}
			}
			echo json_encode(array($patient_name,$patient_address,$assessment_date,$admission_date,$discharge_date,$bed_no,$ward_no,$emergency_code,$lab_test1));
		}
	}
	else if($id == 9){// insert bill
		echo $db->bill($_POST);

	}
}

?>

