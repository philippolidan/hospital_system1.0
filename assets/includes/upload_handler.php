<?php

$bp_id="X-ray ID";

$response = [];
$path = "";

if(!is_dir("../uploads/". $bp_id ."/")) {
	mkdir("../uploads/".$bp_id ."/",0777,true);
}

$fln = 1;
foreach($_FILES AS &$fl){
	if ($fl['name'] != "") {

		$ext = explode('.', basename( $fl['name']));

		$target_path = "../uploads/" .$bp_id."/";
		$target_path = $target_path .$fln.".".end($ext);

		if(move_uploaded_file($fl['tmp_name'], $target_path)) {
				    //success
			if (end($ext) == "png" || end($ext) == "jpg" || end($ext) == "jpeg")
			{
				$filePath = $target_path;
				$quality = 100;
				$path = $filePath = "../uploads/" .$bp_id."/".$fln.".jpg";

				$response[0] = "1";
				$response[1] = $path;
			}

			else{
				$response[0] = "0";
				$response[1] = "File Type is invalid.";
			}
		}
		else{
			$response[0] = "0";
			$response[1] = "File Extension is invalid.";
		}
	}
	$fln++;
}
unset($fl);

echo json_encode($response);
?>