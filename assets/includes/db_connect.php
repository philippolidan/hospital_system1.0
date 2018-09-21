<?php
require $_SERVER['DOCUMENT_ROOT'].'/hospital_system/vendor/autoload.php';
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
	public function getSymptoms(){
		return $this->db->symptom->find();
	}
	public function getFecalysis($labtest_id){
		return $this->db->fecalysis->find(['labtest_id' => "$labtest_id"]);
	}
	public function getUrinalysis($labtest_id){
		return $this->db->urinalysis->find(['labtest_id' => "$labtest_id"]);
	}
	public function getSymptom($id){
		return $this->db->symptom->find(['symptom_id' => "$id"]);
	}
	public function getTests(){
		return $this->db->test_list->find();
	}
	public function getTest($id){
		return $this->db->test_list->find(['test_id' => "$id"]);
	}
	public function getPatientTest($patient_oid){
		return $this->db->lab_test->find(['patient_oid' => "$patient_oid"]);
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
				]

			]
		);
	}
	public function getPatientER($patient_oid){
		$patient_oid1 = new MongoDB\BSON\ObjectId($patient_oid);
		return $this->db->patient->aggregate( 
			[
				[ '$match' => 
					[ "_id" => $patient_oid1 ]
				],
				['$lookup' =>
					[
						"from" => "er_transaction",
						"pipeline" => [
							[ '$match' => [ "patient_oid" => $patient_oid ]]
						],
						"as" => "er_transaction"
					]
				],

			]
		);
	}
	public function insert_one($data){
		try{
			//get patient id
			$number = count(iterator_to_array($this->db->patient->find()));
			$patient_id = str_pad($number + 1, 5, 0, STR_PAD_LEFT);
			//insert patient
			$patient = 
			[
				"patient_id" => $patient_id, "lname"=> $data['lname'], "fname" => $data['fname'],
				"mname" => $data['mname'], "bdate" => $data['bdate'], "sex" => $data['sex'], 
				"address" => $data['address']
			];
			$patient_oid = "";
			$result_patient = $this->db->patient->insertOne($patient);
			$patient_oid = (string) $result_patient->getInsertedId();
			//insert triage
			$triage = 
			[
				"patient_oid" => $patient_oid, "blood_pressure" => $data['bpressure'], "breathing" => $data['breathing'],
				"pulse" => $data['pulse'], "temperature" => $data['temperature'], "isallergic" => $data['allergies'], 
				"allergies" => $data['a_name'], "hasmedication" => $data['medication'], "medications" => $data['m_name'],
				"symptom_id" => $data['symptom']
			];
			$result_triage = $this->db->triage->insertOne($triage);
			//search questions based of symptom_id
			$question_list = $this->getQuestions($data['symptom']);
			$q_handler = [];
			foreach ($question_list as $question) {
				$q_handler[] = array("question_oid"=>$question->_id, "answer"=>$data["$question->_id"], "patient_oid"=> $patient_oid);
			}
			$result_squestion = $this->db->symptom_questions->insertMany($q_handler);
			if($data['wlt'] == 0){// if with labtest
				//insert to laborty  test
				$lab_test = [];
				foreach ($data['test'] as $test) {
					$lab_test[] =  array("test_id"=>$test, "patient_oid"=>$patient_oid, "status"=> "Ongoing", "date_completed" => "n/a");
				}
				$result_labtest = $this->db->lab_test->insertMany($lab_test);
				$labtest_ids = $result_labtest->getInsertedIds();
				$count = 0;
				$f = [];
				$u = [];
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
					$count++;
				}
				if(count($f) > 0){
					$result_fecalysis = $this->db->fecalysis->insertMany($f);
				}
				if(count($u) > 0){
					$result_urinalysis = $this->db->urinalysis->insertMany($u);
				}
			}
			
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
				"patient_oid" => $patient_oid,"emergency_code" => $data['emergency_code'], "patient_id" => $patient_id, "assessment_date" => $data['assessment_date'] , "date_created" => date("F d, Y h:i A"), "status" => "ongoing", "wlt" => $data['wlt']
			];
			$er_details = array_merge($er_details, $er_sdetails);
			$result_er = $this->db->er_transaction->insertOne($er_details);
			return array(true,$patient_oid);
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
		if($data[$c] == "Fecalysis"){ //fecalysis
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
		else if($data[$c] == "Urinalysis"){ //urinalysis
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
		return array(true,$patient_oid);
	}
	public function bill($data){
		$date_completed = date("m/d/Y H:i:s");
		foreach($this->getER($data['patient_oid']) as $er){
			$update = $this->db->er_transaction->updateOne( 
				['patient_oid' => $data['patient_oid']], 
				['$set' => 
					['status' => "Done",'date_completed' => $date_completed]
				]
			);
			$lab_test =$this->getLabTestByPatient($data['patient_oid']);
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
			}
			$bill = 
			[
				"er_id" => (string)$er->_id, "subtotal" => $data['subtotal'],
				"discount" => $data['discount'], "total" => $data['total'],
				"date" => $date_completed
			];
			$result = $this->db->bill->insertOne($bill);
			return true;
		}
	}
	public function loginUser($email, $password){
		$result = $this->db->users->findOne(array("email" => $email, "salt" => $password));
		return $result;
	}
}
?>