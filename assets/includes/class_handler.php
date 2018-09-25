<?php
include 'db_connect.php';
include 'SMSHandler.php';
$sms = new SMSHandler;
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
			$response .= "<div class='d-flex'><div><h6>$title</h6></div><div class='ml-auto'><a onclick='remove_symptom($symptom_id)' style='cursor: pointer;' class='fa fa-times text-danger'></a></div></div><hr>";
			$response .= "";
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
					$response.="<textarea name='$question->_id' class='form-control to-v'></textarea>";
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
				else if($type == "dropdown"){
					$response.="<label>$question->question</label>";
					$response.="<select class='form-control' name='".$question->_id."' id='".$question->_id."'>";
					foreach($question->data as $data){
						$response.="<option value='".$data."'>".$data."</option>";
					}
					$response.="</select>";
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
	else if($id == 5){ //get lab_test
		$response=[];
		$test_id1 = (string) $_POST['test_id'];
		foreach ($db->getPatientTest($test_id1) as $test) {
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
		$response=[];
		foreach($db->getLabTest($labtest_id) as $lab){
			if($lab->status =='Done'){
				$checker = 1;
			}
			else 
				$checker = 0;
		}
		if($type == "Fecalysis" || $type == 1){//fecalysis
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
		else if($type == "Urinalysis" || $type == 2){//urinalysis
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
		else if($type == "Kidney, Ureter and Bladder X-ray" || $type == 3){//urinalysis
			if($checker == 1){
				foreach ( $db->getKUBXray($labtest_id) as $res) {
					$response =
					[
						"X-ray image" , $res->xray_image,
						"Findings" ,$res->findings,
						"interpretation" , $res->interpretation
					];
				}
			}
			else
				$response = ["X-ray image","Findings"];
		}
		else if($type == "Chest X-ray" || $type == 4){//urinalysis
			if($checker == 1){
				foreach ( $db->getChestXray($labtest_id) as $res) {
					$response =
					[
						"X-ray image" , $res->xray_image,
						"Findings" ,$res->findings,
						"interpretation" , $res->interpretation
					];
				}
			}
			else
				$response = ["X-ray image","Findings"];
		}
		else if($type == "Lungs X-ray" || $type == 5){//urinalysis
			if($checker == 1){
				foreach ( $db->getLungsXray($labtest_id) as $res) {
					$response =
					[
						"X-ray image" , $res->xray_image,
						"Findings" ,$res->findings,
						"interpretation" , $res->interpretation
					];
				}
			}
			else
				$response = ["X-ray image","Findings"];
		}
		else if($type == "Abdomen X-ray" || $type == 6){//urinalysis
			if($checker == 1){
				foreach ( $db->getAbdomenXray($labtest_id) as $res) {
					$response =
					[
						"X-ray image" , $res->xray_image,
						"Indication" , $res->indication,
						"Comparison" , $res->comparison,
						"Findings" ,$res->findings,
						"interpretation" , $res->interpretation
					];
				}
			}
			else
				$response = ["X-ray image","Indication","Comparison","Findings"];
		}
		else if($type == "Complete Blood Count (CBC)" || $type == 7){//Complete Blood Count (CBC)
			if($checker == 1){
				foreach ( $db->getCBC($labtest_id) as $res) {
					$response =
					[
						"White Blood Cell" , $res->wbc_count,
						"Red Blood Cell" , $res->rbc_count,
						"Hemoglobin" , $res->hemoglobin,
						"Hematocrit" ,$res->hematocrit,
						"MCV" ,$res->mcv,
						"MCHC" ,$res->mchc,
						"RDW" ,$res->rdw,
						"Platelets" ,$res->platelets,
						"Neutrophils" ,$res->neutrophils,
						"Lymphs" ,$res->lymphs,
						"Monocytes" ,$res->monocytes,
						"EOS" ,$res->eos,
						"BASO" ,$res->baso,
						"Immature Granulocytes" ,$res->immature_granulocytes,
						"Immature Grans" ,$res->immature_grans,
						"interpretation" , $res->interpretation
					];
				}
			}
			else
				$response = ["White Blood Cell","Red Blood Cell","Hemoglobin","Hematocrit","MCV","MCHC","RDW","Platelets","Neutrophils","Lymphs","Monocytes","EOS","BASO","Immature Granulocytes","Immature Grans"];
		}
		else if($type == "Computed Tomography Scan (CT Scan)" || $type == 8){//urinalysis
			if($checker == 1){
				foreach ( $db->getCTScan($labtest_id) as $res) {
					$response =
					[
						"CT Scan image" , $res->ct_scan_image,
						"Indication" , $res->indication,
						"Comparison" , $res->comparison,
						"Technique" , $res->technique,
						"Findings" ,$res->findings,
						"Impression" , $res->impression,
						"interpretation" , $res->interpretation
					];
				}
			}
			else
				$response = ["CT Scan image","Indication","Comparison","Technique","Impression","Findings"];
		}
		else if($type == "Magnetic Resonance Imaging Scan (MRI Scan)" || $type == 9){//urinalysis
			if($checker == 1){
				foreach ( $db->getMRIScan($labtest_id) as $res) {
					$response =
					[
						"MRI Scan image" , $res->mri_scan_image,
						"Indication" , $res->indication,
						"Comparison" , $res->comparison,
						"Technique" , $res->technique,
						"Impression" , $res->impression,
						"Findings" ,$res->findings,
						"interpretation" , $res->interpretation
					];
				}
			}
			else
				$response = ["CT Scan image","Indication","Comparison","Technique","Impression","Findings"];
		}
		else if($type == "Sonography (Ultrasound)" || $type == 10){//urinalysis
			if($checker == 1){
				foreach ( $db->getUltrasound($labtest_id) as $res) {
					$response =
					[
						"Ultrasound image" , $res->ultrasound_image,
						"Body Parts" , $res->body_parts,
						"Impression" , $res->impression,
						"Conclusion" , $res->conclusion,
						"Findings" ,$res->findings,
						"interpretation" , $res->interpretation
					];
				}
			}
			else
				$response = ["Ultrasound image","Body Parts","Impression","Conclusion","Findings"];
		}
		else if($type == "Electrocardiogram (ECG)" || $type == 11){//urinalysis
			if($checker == 1){
				foreach ( $db->getECG($labtest_id) as $res) {
					$response =
					[
						"ECG image" , $res->ecg_image,
						"Impression" , $res->impression,
						"Conclusion" , $res->conclusion,
						"Findings" ,$res->findings,
						"interpretation" , $res->interpretation
					];
				}
			}
			else
				$response = ["ECG image","Impression","Conclusion","Findings"];
		}
		else if($type == "Fasting Blood Sugar (FBS Test / Glucose Test)" || $type == 12){//urinalysis
			if($checker == 1){
				foreach ( $db->getFBSugar($labtest_id) as $res) {
					$response =
					[
						"Result" , $res->result,
						"Flag" , $res->flag,
						"Impression" , $res->impression,
					];
				}
			}
			else
				$response = ["Result","Flag","Impression"];
		}
		echo json_encode(array($checker,$response));
	}
	else if($id == 7){
		echo json_encode($db->insert_two($_POST['test_value']));
	}
	else if($id == 8){// get er + patient info for billing

		$lab_test1 = [];
		foreach($db->getPatientER($_POST['er_id'],$_POST['patient_oid']) as $er){
			$assessment_date = $er->assessment_date;
			$admission_date = "";
			$discharge_date = date("F d, Y h:i A");
			$bed_no = "";
			$ward_no = "";
			if(isset($er->admission_date) && isset($er->bed_no) && isset($er->ward_no)){
				$admission_date = $er->admission_date;
				$bed_no = $er->bed_no;
				$ward_no = $er->ward_no;
			}
			$emergency_code = $er->emergency_code;
			if($er->wlt == 0){
				foreach($db->getLabTestByER($_POST['er_id']) as $lab_test){
					foreach ($lab_test->test_list as $lab) {
						$lab_test1[] = [$lab->name,$lab->price];
					}

				}
			}
			foreach($er->patient as $patient){
				$patient_name = $patient->lname.", ".$patient->fname." ".$patient->mname;
				$patient_address = $patient->address;
			}
			echo json_encode(array($patient_name,$patient_address,$assessment_date,$admission_date,$discharge_date,$bed_no,$ward_no,$emergency_code,$lab_test1));
		}
	}
	else if($id == 9){// insert bill
		$result = $db->bill($_POST);
		if($result[0]){
			$c =count($result[2]);
			$status ="";
			for($i = 0; $i<$c;$i++){
				$status= $sms->sendSMS_orderSuccessful($result[1],$result[2][$i]);
			}
			echo true;
		}
	}
	else if($id == 10){
		foreach($db->getPatientERById($_POST['er_id'],$_POST['patient_oid']) as $er){
			$name = "";
			$address = "";
			$p_id = "";
			$a_date = $er->assessment_date;
			$bp = "";
			$breathing = "";
			$pulse = "";
			$temp = "";
			$isallergic = "";
			$allergies = "";
			$hasmedication = "";
			$medications = "";
			$sex = "";
			$test = [];
			foreach($er->patient as $patient){
				$name = $patient->lname.", ".$patient->fname." ".$patient->mname;
				$address = $patient->address;
				$p_id = $patient->patient_id;
				if($patient->sex == "male"){
					$sex ="boy";
				}
				else
					$sex="girl";

			}
			foreach($er->triage as $triage){
				$bp = $triage->blood_pressure;
				$breathing = $triage->breathing;
				$pulse = $triage->pulse;
				$temp = $triage->temperature;
				$isallergic = $triage->isallergic;
				$allergies = $triage->allergies;
				$hasmedication = $triage->hasmedication;
				$medications = $triage->medications;
			}
			foreach($er->lab_test as $lab_test){
				$vtest= "<div class='d-flex border-bottom mt-1 mb-1'>";
				foreach($db->getTest($lab_test->test_id) as $ltest){
					$vtest.="<div><h6 class='small'>".$ltest->name."</h6></div>";
				}
				$vtest.="<div class='ml-auto'>
							<h6 class='small font-weight-bold'>".$lab_test->status."</h6>
							<a href='#' onclick='view_test(\"".$lab_test->_id."\",\"".$ltest->name."\")' class='text-info font-weight-bold'>View</a>
						</div></div>";
				$test[] = $vtest;
			}
			echo json_encode(array($name,$p_id,$a_date,$bp,$breathing,$pulse,$temp,ucfirst($isallergic),$allergies,ucfirst($hasmedication),$medications,$sex,$test));
		}
	}
	else if($id == 11){
		foreach($db->getPatient($_POST['patient_oid']) as $patient){
			$lname = $patient->lname;
			$mname = $patient->mname;
			$fname = $patient->fname;
			$address = $patient->address;
			$bdate = $patient->bdate;
			$contact = $patient->contact;
			$hmo_cname = $patient->HMO_Company_name;
			$hmo_accno = $patient->HMO_acc_no;
			$hmo_cardno = $patient->HMO_card_no;
			$sex = $patient->sex;
			$patient_id = "PT-".$patient->patient_id;
			echo json_encode(array($lname,$mname,$fname,$address,$sex,$patient_id,$bdate,$contact,$hmo_cname,$hmo_accno,$hmo_cardno));
		}
	}
}

?>

