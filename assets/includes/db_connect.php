<?php
require $_SERVER['DOCUMENT_ROOT'].'/hospital_system1.0/vendor/autoload.php';
date_default_timezone_set('Asia/Manila');
class Database
{
	function __construct()
	{
		$this->db = ( new MongoDB\Client)->hospital;
	}
	public function getPatientNumber(){
		$number = count(iterator_to_array($this->db->patient->find()));
		return "PT-".str_pad($number + 1, 5, 0, STR_PAD_LEFT);
	}
	public function getPatients(){
		return $this->db->patient->find();
	}
	public function getPatient($patient_oid){
		$patient_oid = new MongoDB\BSON\ObjectId($patient_oid);
		return $this->db->patient->find(["_id" => $patient_oid]);
	}
	public function getSymptoms(){
		return $this->db->symptom->find();
	}
	public function getFecalysis($labtest_id){
		return $this->db->fecalysis->find(['labtest_id' => "$labtest_id"]);
	}
	public function getUrinalysis($labtest_id){
		return $this->db->urinalysis->find(['labtest_id' => "$labtest_id"]);
	}
	public function getKUBXray($labtest_id){
		return $this->db->kubxray->find(['labtest_id' => "$labtest_id"]);
	}
	public function getChestXray($labtest_id){
		return $this->db->chestxray->find(['labtest_id' => "$labtest_id"]);
	}
	public function getLungsXray($labtest_id){
		return $this->db->lungsxray->find(['labtest_id' => "$labtest_id"]);
	}
	public function getAbdomenXray($labtest_id){
		return $this->db->abdomenxray->find(['labtest_id' => "$labtest_id"]);
	}
	public function getCBC($labtest_id){
		return $this->db->cbc->find(['labtest_id' => "$labtest_id"]);
	}
	public function getCTScan($labtest_id){
		return $this->db->ctscan->find(['labtest_id' => "$labtest_id"]);
	}
	public function getMRIScan($labtest_id){
		return $this->db->mriscan->find(['labtest_id' => "$labtest_id"]);
	}
	public function getUltrasound($labtest_id){
		return $this->db->ultrasound->find(['labtest_id' => "$labtest_id"]);
	}
	public function getECG($labtest_id){
		return $this->db->ecg->find(['labtest_id' => "$labtest_id"]);
	}
	public function getFBSugar($labtest_id){
		return $this->db->fbsugar->find(['labtest_id' => "$labtest_id"]);
	}
	public function getSymptom($id){
		return $this->db->symptom->find(['symptom_id' => "$id"]);
	}
	public function getSymptomQuestion($er_id){
		return $this->db->symptom_questions->aggregate( 
			[
				[ '$match' => 
					[ "er_id" => $er_id ]
				],
				['$lookup' =>
					[
						"from" => "question_list",
						"localField" => "question_oid",
						"foreignField" => "_id",
						"as" => "question"
					]
				]

			]
		);
	}
	public function getTests(){
		return $this->db->test_list->find();
	}
	public function getTest($id){
		return $this->db->test_list->find(['test_id' => "$id"]);
	}
	public function getPatientTest($er_id){
		return $this->db->lab_test->find(['er_id' => "$er_id"]);
	}
	public function getQuestions($id){
		return $this->db->question_list->find(['symptom_id' => "$id"]);
	}
	public function getBeds(){
		return $this->db->bed_list->find();
	}
	public function getBed($id){
		return $this->db->bed_list->find(['bed_no' => $id]);
	}
	public function getLabTest($id){
		return $this->db->lab_test->find(['_id' => new MongoDB\BSON\ObjectId($id)]);
	}
	public function getLabTestByPatient($patient_oid){
		$patient_oid1 = new MongoDB\BSON\ObjectId($patient_oid);
		return $this->db->lab_test->aggregate( 
			[
				[ '$match' => 
					[ "patient_oid" => $patient_oid ]
				],
				['$lookup' =>
					[
						"from" => "test_list",
						"localField" => "test_id",
						"foreignField" => "test_id",
						"as" => "test_list"
					]
				]

			]
		);
	}
	public function getLabTestByER($er_id){
		return $this->db->lab_test->aggregate( 
			[
				[ '$match' => 
					[ "er_id" => $er_id ]
				],
				['$lookup' =>
					[
						"from" => "test_list",
						"localField" => "test_id",
						"foreignField" => "test_id",
						"as" => "test_list"
					]
				]

			]
		);
	}
	public function getER($patient_oid){
		return $this->db->er_transaction->find(['patient_oid' => $patient_oid]);
	}
	public function getERS(){
		return $this->db->er_transaction->aggregate(
			[
				['$lookup' =>
					[
						"from" => "patient",
						"localField" => "patient_id",
						"foreignField" => "patient_id",
						"as" => "patient"
					]
				]
			]);
	}
	public function getPatientERById($id,$patient_oid){
		return $this->db->er_transaction->aggregate( 
			[
				[ '$match' => 
					[ "_id" => new MongoDB\BSON\ObjectId($id) ]
				],
				['$lookup' =>
					[
						"from" => "patient",
						"pipeline" => [
							[ '$match' => [ "_id" => new MongoDB\BSON\ObjectId($patient_oid) ]]
						],
						"as" => "patient"
					]
				],
				['$lookup' =>
					[
						"from" => "triage",
						"pipeline" => [
							[ '$match' => [ "patient_oid" => $patient_oid ]]
						],
						"as" => "triage"
					]
				],
				['$lookup' =>
					[
						"from" => "lab_test",
						"pipeline" => [
							[ '$match' => [ "er_id" => $id ]]
						],
						"as" => "lab_test"
					]
				]
			]
		);
	}
	public function getPatientER($er_id,$patient_oid){
		$er_id1 = new MongoDB\BSON\ObjectId($er_id);
		return $this->db->er_transaction->aggregate( 
			[
				[ '$match' => 
					[ "_id" => $er_id1 ]
				],
				['$lookup' =>
					[
						"from" => "patient",
						"pipeline" => [
							[ '$match' => [ "_id" =>  new MongoDB\BSON\ObjectId($patient_oid) ]]
						],
						"as" => "patient"
					]
				],

			]
		);
	}
	public function insert_one($data){
		try{
			//get patient id

			$number1 = count(iterator_to_array($this->db->er_transaction->find()));
			$er_no = str_pad($number1 + 1, 5, 0, STR_PAD_LEFT);
			if($data["patient_type"] == "existing"){
				$patient_id = $data['patient_id'];
				$patient_id = explode("PT-",$patient_id);
				$patient_id = $patient_id[1];
				$patient_oid = $data['patient_oid'];
			}
			else{
				$number = count(iterator_to_array($this->db->patient->find()));
				$patient_id = str_pad($number + 1, 5, 0, STR_PAD_LEFT);
			//insert patient
				$patient = 
				[
					"patient_id" => $patient_id, "lname"=> $data['lname'], "fname" => $data['fname'],
					"mname" => $data['mname'], "bdate" => $data['bdate'], "sex" => $data['sex'], 
					"address" => $data['address'],"contact"=>$data['mobile_no'],"HMO_Company_name" => $data['cname'],"HMO_acc_no" =>$data['accnumber'],
					"HMO_card_no" =>$data['cardno']
				];
				$patient_oid = "";
				$result_patient = $this->db->patient->insertOne($patient);
				$patient_oid = (string) $result_patient->getInsertedId();
			}
			//insert triage
			$triage = 
			[
				"patient_oid" => $patient_oid, "blood_pressure" => $data['bpressure'], "breathing" => $data['breathing'],
				"pulse" => $data['pulse'], "temperature" => $data['temperature'], "isallergic" => $data['allergies'], 
				"allergies" => $data['a_name'], "hasmedication" => $data['medication'], "medications" => $data['m_name'],
				"symptom_id" => $data['symptom']
			];
			$result_triage = $this->db->triage->insertOne($triage);
			//insert to er_transaction
			if(isset($data['bed_no']) && !empty($data['bed_no'])){
				$er_sdetails = array("admisson_date" => date("F d, Y h:i A"),"bed_no" => $data['bed_no']);
				//update bed status;
				$update = $this->db->bed_list->updateOne( ['bed_no' => $data['bed_no']], ['$set' => ['status' => 'Occupied']]);
			}
			else{
				$er_sdetails = [];
			}
			$er_details = 
			[
				"er_no" => $er_no,"patient_oid" => $patient_oid,"emergency_code" => $data['emergency_code'], "patient_id" => $patient_id, "assessment_date" => $data['assessment_date'] , "date_created" => date("F d, Y h:i A"), "status" => "ongoing", "wlt" => $data['wlt']
			];
			$er_details = array_merge($er_details, $er_sdetails);
			$result_er = $this->db->er_transaction->insertOne($er_details);

			$er_id = (string) $result_er->getInsertedId();
			$question_list = $this->getQuestions($data['symptom']);
			$q_handler = [];
			foreach ($question_list as $question) {
				$q_handler[] = array("question_oid"=>$question->_id, "answer"=>$data["$question->_id"], "er_id"=> $er_id);
			}
			$result_squestion = $this->db->symptom_questions->insertMany($q_handler);
			if($data['wlt'] == 0){// if with labtest
				//insert to laborty  test
				$lab_test = [];
				foreach ($data['test'] as $test) {
					$lab_test[] =  array("test_id"=>$test, "patient_oid"=>$patient_oid,"er_id" => $er_id, "status"=> "Ongoing", "date_completed" => "n/a");
				}
				$result_labtest = $this->db->lab_test->insertMany($lab_test);
				$labtest_ids = $result_labtest->getInsertedIds();
				$count = 0;
				$f = $u = $cxray = $kub = $lxray = $axray =$cbcc = $ct = $mri = $uts = $ecgg = $fbs = [];
				foreach ($labtest_ids as $id) {
					if($data['test'][$count] == 1){//fecalysis
						$f[] =
						[
							"color" => "n/a", "consistency" => "n/a", "pus" => "n/a", "rbc" => "n/a", 
							"others" => "n/a", "interpretation" => "n/a", "date_completed" => "n/a", "status" => "ongoing", "labtest_id" => (string)$id
						];
					}
					else if($data['test'][$count] == 2){// urinalysis
						$u[] =
						[
							"color" => "n/a", "transparency" => "n/a", "hemoglobin" => "n/a", "hematocrit" => "n/a", 
							"wbc" => "n/a", "rbc" => "n/a", "pus" => "n/a", "platelet_count" => "n/a", "interpretation" => "n/a", "status" => "ongoing",  "date_completed" => "n/a","labtest_id" => (string)$id
						];
					}
					else if($data['test'][$count] == 3){// Kidney, Ureter and Bladder X-ray
						$kub[] =
						[
							"xray_image" => "n/a", "findings" => "n/a", "interpretation" => "n/a","labtest_id" => (string)$id
						];
					}
					else if($data['test'][$count] == 4){//Chest X-ray
						$cxray[] =
						[
							"xray_image" => "n/a", "findings" => "n/a", "interpretation" => "n/a","labtest_id" => (string)$id
						];
					}
					else if($data['test'][$count] == 5){//Lungs X-ray
						$lxray[] =
						[
							"xray_image" => "n/a", "findings" => "n/a", "interpretation" => "n/a","labtest_id" => (string)$id
						];
					}
					else if($data['test'][$count] == 6){//Abdomen X-ray
						$axray[] =
						[
							"xray_image" => "n/a","indication" =>"n/a","comparison" =>"n/a", "findings" => "n/a", "interpretation" => "n/a","labtest_id" => (string)$id
						];
					}
					else if($data['test'][$count] == 7){//CBC
						$cbcc[] =
						[
							"wbc_count"=>"n/a","rbc_count"=>"n/a","hemoglobin"=>"n/a","hematocrit"=>"n/a",
							"mcv"=>"","mchc"=>"n/a","rdw"=>"n/a","platelets"=>"n/a","neutrophils"=>"n/a",
							"lymphs"=>"n/a","monocytes"=>"n/a","eos"=>"n/a","baso"=>"n/a",
							"immature_granulocytes"=>"n/a","immature_grans"=>"n/a","interpretation"=>"n/a",
							"labtest_id" => (string)$id
						];
					}
					else if($data['test'][$count] == 8){//CT Scan
						$ct[] =
						[
							"ct_scan_image" => "n/a","indication" =>"n/a","technique" =>"n/a","comparison" =>"n/a", "findings" => "n/a","impression" => "n/a", "interpretation" => "n/a","labtest_id" => (string)$id
						];
					}
					else if($data['test'][$count] == 9){//MRI Scan
						$mri[] =
						[
							"mri_scan_image" => "n/a","indication" =>"n/a","technique" =>"n/a","comparison" =>"n/a", "findings" => "n/a", "interpretation" => "n/a","labtest_id" => (string)$id
						];
					}
					else if($data['test'][$count] == 10){//Ultrasound
						$uts[] =
						[
							"ultrasound_image" => "n/a","body_parts" =>"n/a","impression" =>"n/a","conclusion" =>"n/a", "findings" => "n/a", "interpretation" => "n/a","labtest_id" => (string)$id
						];
					}
					else if($data['test'][$count] == 11){//Electrocardiogram
						$ecgg[] =
						[
							"ecg_image" => "n/a","impression" =>"n/a","conclusion" =>"n/a", "findings" => "n/a", "interpretation" => "n/a","labtest_id" => (string)$id
						];
					}
					else if($data['test'][$count] == 12){//Fasting Blood Sugar
						$fbs[] =
						[
							"result" => "n/a","flag"=>"n/a","impression" => "n/a","interpretation" => "n/a","labtest_id" => (string)$id
						];
					}
					$count++;
				}
				if(count($f) > 0){
					$result_fecalysis = $this->db->fecalysis->insertMany($f);
				}
				if(count($u) > 0){
					$result_urinalysis = $this->db->urinalysis->insertMany($u);
				}
				if(count($kub) > 0){
					$result_kub = $this->db->kubxray->insertMany($kub);
				}
				if(count($cxray) > 0){
					$result_cxray = $this->db->chestxray->insertMany($cxray);
				}
				if(count($cbcc) > 0){
					$result_cbc = $this->db->cbc->insertMany($cbcc);
				}
				if(count($lxray) > 0){
					$result_lxray = $this->db->lungsxray->insertMany($lxray);
				}
				if(count($axray) > 0){
					$result_axray = $this->db->abdomenxray->insertMany($axray);
				}
				if(count($ct) > 0){
					$result_cscan = $this->db->ctscan->insertMany($ct);
				}
				if(count($mri) > 0){
					$result_mri = $this->db->mri->insertMany($mri);
				}
				if(count($uts) > 0){
					$result_usound = $this->db->ultrasound->insertMany($uts);
				}
				if(count($ecgg) > 0){
					$result_ecg = $this->db->ecg->insertMany($ecgg);
				}
				if(count($fbs) > 0){
					$result_fsugar = $this->db->fbsugar->insertMany($fbs);
				}
			}
			return array(true,$patient_oid,$er_id);
		}
		catch(Exception $e){
			return "Error: ".$e->getMessage();
		}
	}
	public function insert_two($data){//updating test
		$c = count($data)-1;
		$date_completed = date("m/d/Y H:i:s");
		$patient_oid ='';
		foreach ($this->getLabTest($data[$c - 1]) as $info) {
			$patient_oid = $info->patient_oid;
		}
		if($data[$c] == "Fecalysis" || $data[$c] == 1){ //fecalysis
			$update = $this->db->fecalysis->updateOne( 
				['labtest_id' => $data[$c - 1]], 
				['$set' => 
					['color' => $data[0], 'consistency' => $data[1],'pus' => $data[2],
					'rbc' => $data[3],'other' => $data[4],'interpretation' => $data[5],
					'status' => 'Done','date_completed' => $date_completed]
				]	
			);
			$update = $this->db->lab_test->updateOne( 
				['_id' => new MongoDB\BSON\ObjectId ($data[$c - 1])], 
				['$set' => 
					['status' => "Done",'date_completed' => $date_completed]
				]
			);
		}
		else if($data[$c] == "Urinalysis" || $data[$c] == 2){ //urinalysis
			$update = $this->db->urinalysis->updateOne( 
				['labtest_id' => $data[$c - 1]], 
				['$set' => 
					['color' => $data[0], 'transparency' => $data[1],'hemoglobin' => $data[2],
					'hematocrit' => $data[3],'wbc' => $data[4],'rbc' => $data[5],'pus' => $data[6],'platelet_count' => $data[7],'interpretation' => $data[8],'status' => 'Done','date_completed' => $date_completed]
				]	
			);
			$update = $this->db->lab_test->updateOne( 
				['_id' => new MongoDB\BSON\ObjectId ($data[$c - 1])], 
				['$set' => 
					['status' => "Done",'date_completed' => $date_completed]
				]
			);
		}
		else if($data[$c] == "Kidney, Ureter and Bladder X-ray" || $data[$c] == 3){ //urinalysis

			$update = $this->db->kubxray->updateOne( 
				['labtest_id' => $data[$c - 1]], 
				['$set' => 
					['xray_image' => $data[0], 'findings' => $data[1],'interpretation' => $data[2],'status' => 'Done','date_completed' => $date_completed]
				]	
			);
			$update = $this->db->lab_test->updateOne( 
				['_id' => new MongoDB\BSON\ObjectId ($data[$c - 1])], 
				['$set' => 
					['status' => "Done",'date_completed' => $date_completed]
				]
			);
		}
		else if($data[$c] == "Chest X-ray" || $data[$c] == 4){ //Chest X-ray
			$update = $this->db->chestxray->updateOne( 
				['labtest_id' => $data[$c - 1]], 
				['$set' => 
					['xray_image' => $data[0], 'findings' => $data[1],'interpretation' => $data[2],'status' => 'Done','date_completed' => $date_completed]
				]	
			);
			$update = $this->db->lab_test->updateOne( 
				['_id' => new MongoDB\BSON\ObjectId ($data[$c - 1])], 
				['$set' => 
					['status' => "Done",'date_completed' => $date_completed]
				]
			);
		}
		else if($data[$c] == "Lungs X-ray" || $data[$c] == 5){ //Lungs X-ray
			$update = $this->db->lungsxray->updateOne( 
				['labtest_id' => $data[$c - 1]], 
				['$set' => 
					['xray_image' => $data[0], 'findings' => $data[1],'interpretation' => $data[2],'status' => 'Done','date_completed' => $date_completed]
				]	
			);
			$update = $this->db->lab_test->updateOne( 
				['_id' => new MongoDB\BSON\ObjectId ($data[$c - 1])], 
				['$set' => 
					['status' => "Done",'date_completed' => $date_completed]
				]
			);
		}
		else if($data[$c] == "Abdomen X-ray" || $data[$c] == 6){ //Abdomen X-ray
			$update = $this->db->abdomenxray->updateOne( 
				['labtest_id' => $data[$c - 1]], 
				['$set' => 
					['xray_image' => $data[0], 'indication' => $data[1],'comparison' => $data[2],"findings" =>$data[3],'interpretation' => $data[4],'status' => 'Done','date_completed' => $date_completed]
				]	
			);
			$update = $this->db->lab_test->updateOne( 
				['_id' => new MongoDB\BSON\ObjectId ($data[$c - 1])], 
				['$set' => 
					['status' => "Done",'date_completed' => $date_completed]
				]
			);
		}
		else if($data[$c] == "Complete Blood Count (CBC)" || $data[$c] == 7){ //CBC
			
			$update = $this->db->cbc->updateOne( 
				['labtest_id' => $data[$c - 1]], 
				['$set' => 
					[
						"wbc_count" => $data[0], "rbc_count" => $data[1], "hemoglobin" => $data[2], 
						"hematocrit" => $data[3], "mcv" => $data[4], "mchc"=> $data[5], "rdw" => $data[6],
						"platelets" => $data[7], "neutrophils"=> $data[8], "lymphs" => $data[9], 
						"monocytes" => $data[10],"eos" => $data[11], "baso" => $data[12],
						"immature_granulocytes" => $data[13], "immature_grans" => $data[14], 
						"interpretation" => $data[15],'status' => 'Done','date_completed' => $date_completed]
				]	
			);
			$update = $this->db->lab_test->updateOne( 
				['_id' => new MongoDB\BSON\ObjectId ($data[$c - 1])], 
				['$set' => 
					['status' => "Done",'date_completed' => $date_completed]
				]
			);
		}
		else if($data[$c] == "Computed Tomography Scan (CT Scan)" || $data[$c] == 8){ //CT Scan
			$update = $this->db->ctscan->updateOne( 
				['labtest_id' => $data[$c - 1]], 
				['$set' => 
					['ct_scan_image' => $data[0], 'indication' => $data[1],'technique' => $data[2],"comparison" =>$data[3],'findings' => $data[4],"impression" => $data[5],"interpretation" => $data[6],'status' => 'Done','date_completed' => $date_completed]
				]	
			);
			$update = $this->db->lab_test->updateOne( 
				['_id' => new MongoDB\BSON\ObjectId ($data[$c - 1])], 
				['$set' => 
					['status' => "Done",'date_completed' => $date_completed]
				]
			);
		}
		else if($data[$c] == "Magnetic Resonance Imaging Scan (MRI Scan)" || $data[$c] == 9){ //MRI Scan
			$update = $this->db->mriscan->updateOne( 
				['labtest_id' => $data[$c - 1]], 
				['$set' => 
					['mri_scan_image' => $data[0], 'indication' => $data[1],'technique' => $data[2],"comparison" =>$data[3],'findings' => $data[4],"interpretation" => $data[5],'status' => 'Done','date_completed' => $date_completed]
				]	
			);
			$update = $this->db->lab_test->updateOne( 
				['_id' => new MongoDB\BSON\ObjectId ($data[$c - 1])], 
				['$set' => 
					['status' => "Done",'date_completed' => $date_completed]
				]
			);
		}
		else if($data[$c] == "Sonography (Ultrasound)" || $data[$c] == 10){ //ultrasound
			$update = $this->db->ultrasound->updateOne( 
				['labtest_id' => $data[$c - 1]], 
				['$set' => 
					['ultrasound_image' => $data[0], 'body_parts' => $data[1],'impression' => $data[2],"conclusion" =>$data[3],'findings' => $data[4],"interpretation" => $data[5],'status' => 'Done','date_completed' => $date_completed]
				]	
			);
			$update = $this->db->lab_test->updateOne( 
				['_id' => new MongoDB\BSON\ObjectId ($data[$c - 1])], 
				['$set' => 
					['status' => "Done",'date_completed' => $date_completed]
				]
			);
		}
		else if($data[$c] == "Electrocardiogram (ECG)" || $data[$c] == 11){ //Electrocardiogram
			$update = $this->db->ecg->updateOne( 
				['labtest_id' => $data[$c - 1]], 
				['$set' => 
					['ecg_image' => $data[0], 'impression' => $data[1],'conclusion' => $data[2],'findings' => $data[3],"interpretation" => $data[4],'status' => 'Done','date_completed' => $date_completed]
				]	
			);
			$update = $this->db->lab_test->updateOne( 
				['_id' => new MongoDB\BSON\ObjectId ($data[$c - 1])], 
				['$set' => 
					['status' => "Done",'date_completed' => $date_completed]
				]
			);
		}
		else if($data[$c] == "Fasting Blood Sugar (FBS Test / Glucose Test)" || $data[$c] == 12){ //Fasting Blood Sugar
			$update = $this->db->fbsugar->updateOne( 
				['labtest_id' => $data[$c - 1]], 
				['$set' => 
					['result' => $data[0], 'flag' => $data[1],'impression' => $data[2],'interpretation' => $data[3],'status' => 'Done','date_completed' => $date_completed]
				]	
			);
			$update = $this->db->lab_test->updateOne( 
				['_id' => new MongoDB\BSON\ObjectId ($data[$c - 1])], 
				['$set' => 
					['status' => "Done",'date_completed' => $date_completed]
				]
			);
		}
		return array(true,$patient_oid);
	}
	public function bill($data){
		$date_completed = date("m/d/Y H:i:s");
		$msg = [];
		$tt = [];
		foreach($this->getER($data['patient_oid']) as $er){
			$update = $this->db->er_transaction->updateOne( 
				['patient_oid' => $data['patient_oid']], 
				['$set' => 
					['status' => "Done",'date_completed' => $date_completed]
				]
			);
			$lab_test =$this->getLabTestByER((string)$er->_id);
			foreach ($lab_test as $lab) {
				$patient_oid = $lab->patient_oid;
				$er_transaction = $this->getER($patient_oid);
				foreach ($er_transaction as $er) {
					$update = $this->db->bed_list->updateOne( 
						['bed_no' => $er->bed_no], 
						['$set' => 
							['status' => "Vacant"]
						]
					);
				}
				if($lab->test_id == 1){ //fecalysis
					foreach($this->getFecalysis((string)$lab->_id) as $fec){
						$msgg = "Fecalysis Result \nColor:".$fec->color."\nConsistency:".$fec->consistency."\nPus:".$fec->pus."\nRed Blood Cell:".$fec->rbc."\nOthers:".$fec->others."\nInterpretation:".$fec->interpretation;
						$msg[] = $msgg;
					}
				}
				else if($lab->test_id == 2){ //urinalysis
					foreach($this->getUrinalysis($data['patient_oid']) as $uri){
						$msgg = "Urinalysis Result \nColor:".$uri->color."\nTransparency:".$uri->transparency."\nHemoglobin:".$uri->hemoglobin."\nHematocrit:".$uri->hematocrit."\nWhite Blood Cell:".$uri->wbc."\nRed Blood Cell:".$uri->rbc."\nPlatelet Count:".$uri->platelet_count."\nPus:".$uri->pus."\nInterpretation:".$uri->interpretation;
						$msg[] = $msgg;
					}
				}
				else if($lab->test_id == 3){//Kidney, Ureter and Bladder X-ray
					foreach($this->getKUBXray($data['patient_oid']) as $res){
						$msgg = "Kidney, Ureter and Bladder X-ray Result \nFindings:".$res->findings."\nInterpretation:".$res->interpretation;
						$msg[] = $msgg;
					}
				}
				else if($lab->test_id == 4){//Chest X-ray
					foreach($this->getChestXray($data['patient_oid']) as $res){
						$msgg = "Chest X-ray Result \nFindings:".$res->findings."\nInterpretation:".$res->interpretation;
						$msg[] = $msgg;
					}
				}
				else if($lab->test_id == 5){//Lungs X-ray
					foreach($this->getLungsXray($data['patient_oid']) as $res){
						$msgg = "Lungs X-ray Result \nFindings:".$res->findings."\nInterpretation:".$res->interpretation;
						$msg[] = $msgg;
					}
				}
				else if($lab->test_id == 6){//Abdomen X-ray
					foreach($this->getAbdomenXray($data['patient_oid']) as $res){
						$msgg = "Abdomen X-ray Result \nIndication:".$res->indication."\nComparison:".$res->comparison."\nFindings:".$res->findings."\nInterpretation:".$res->interpretation;
						$msg[] = $msgg;
					}
				}
				else if($lab->test_id == 7){//CBC
					foreach($this->getCBC($data['patient_oid']) as $res){
						$msgg = "Complete Blood Count (CBC) Result \nWhite Blood Cell Count:".$res->wbc_count."\nRed Blood Cell Count:".$res->rbc_count."\nHemoglobin:".$res->hemoglobin."\nHematocrit:".$res->hematocrit."\nMCV:".$res->mcv."\nMCHC:".$res->mchc."\nRDW:".$res->rdw."\nPlatelets:".$res->platelets."\nNeutrophils:".$res->neutrophils."\nLymphs:".$res->lymphs."\nMonocytes:".$res->monocytes."\nEOS:".$res->eos."\nBASO:".$res->baso."\nImmature Granulocytes:".$res->immature_granulocytes."\nImmature Grans:".$res->immature_grans."\nInterpretation:".$res->interpretation;
						$msg[] = $msgg;
					}
				}
				else if($lab->test_id == 8){//CT scan
					foreach($this->getCTScan($data['patient_oid']) as $res){
						$msgg = "Computed Tomography Scan (CT Scan) Result \nIndication:".$res->indication."\nComparison:".$res->comparison."\nTechnique:".$res->technique."\nFindings:".$res->findings."\nImpression:".$res->impression."\nInterpretation:".$res->interpretation;
						$msg[] = $msgg;
					}
				}
				else if($lab->test_id == 9){//Magnetic Resonance Imaging Scan (MRI Scan)
					foreach($this->getMRIScan($data['patient_oid']) as $res){
						$msgg = "Magnetic Resonance Imaging Scan (MRI Scan) Result \nIndication:".$res->indication."\nComparison:".$res->comparison."\nTechnique:".$res->technique."\nFindings:".$res->findings."\nImpression:".$res->impression."\nInterpretation:".$res->interpretation;
						$msg[] = $msgg;
					}
				}
				else if($lab->test_id == 10){//Sonography (Ultrasound)
					foreach($this->getUltrasound($data['patient_oid']) as $res){
						$msgg = "Sonography (Ultrasound) Result \nBody Parts:".$res->body_parts."\nFinding:".$res->findings."\nConclusion:".$res->conclusion."\nImpression:".$res->impression."\nInterpretation:".$res->interpretation;
						$msg[] = $msgg;
					}
				}
				else if($lab->test_id == 11){//Electrocardiogram (ECG)
					foreach($this->getECG($data['patient_oid']) as $res){
						$msgg = "Electrocardiogram (ECG) Result \nFinding:".$res->findings."\nConclusion:".$res->conclusion."\nImpression:".$res->impression."\nInterpretation:".$res->interpretation;
						$msg[] = $msgg;
					}
				}
				else if($lab->test_id == 12){//Fasting Blood Sugar (FBS Test / Glucose Test)
					foreach($this->getFBSugar($data['patient_oid']) as $res){
						$msgg = "Fasting Blood Sugar (FBS Test / Glucose Test) Result \nResult:".$res->result."\nFlag:".$res->flag."\nImpression:".$res->impression."\nInterpretation:".$res->interpretation;
						$msg[] = $msgg;
					}
				}
			}
			$bill = 
			[
				"er_id" => (string)$er->_id, "subtotal" => $data['subtotal'],
				"discount" => $data['discount'], "total" => $data['total'],
				"date" => $date_completed
			];
			$result = $this->db->bill->insertOne($bill);

		}
		foreach($this->getPatient($data['patient_oid']) as $patient){
			return array(true,$patient->contact,$msg);
		}
	}
<<<<<<< HEAD

public function loginUser($email, $password){
		$result = $this->db->users->findOne(array("email" => $email, "salt" => $password));
		return $result;
	}

	
=======
	public function loginUser($email, $password){
		$result = $this->db->users->findOne(array("email" => $email, "salt" => $password));
		return $result;
	}
	public function loginUserById($user_id){
		$result = $this->db->users->findOne(["id" => $user_id]);
		return $result;
	}
>>>>>>> 23b47a28d65cd489d600b8cdc87b082db5a02b00
}


?>

