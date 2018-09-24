<?php

include 'db_connect.php';
$db = new Database;

$response = [];

$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$password = hash("sha512", filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));

if (isset($_POST['email']) && isset($_POST['password'])) {
	$result = $db->loginUser($email, $password);
	if ($result) {

		json_encode($result);

		session_start();
		
		$_SESSION['user_id'] = $result['id'];
		$_SESSION['role_id'] = $result['role_id'];

		if ($result['role_id'] == 4) {
			header('Location: ../../doctor_dashboard.php');
		}

		if ($result['role_id'] == 5) {
			header('Location: ../../patient_dashboard.php');
		}
		
	}

	else{
		header('Location: ../../index.php?err=1');
		exit();
	}
}

else{
	header('Location: ../../index.php?err=0');
	exit();
}

?>