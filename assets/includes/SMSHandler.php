<?php
class SMSHandler{
	public function itexmo($number,$message,$apicode){
		$url = 'https://www.itexmo.com/php_api/api.php';
		$itexmo = array('1' => $number, '2' => $message, '3' => $apicode);
		$param = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($itexmo),
			),
		);
		$context  = stream_context_create($param);
		return file_get_contents($url, false, $context);
	}

	public function sendSMS_orderSuccessful($contact, $text){
		$text_message = $text;

		$result = $this->itexmo($contact, $text_message, "TR-SYMPO801631_T8ZLH");

		if ($result == "") {
			return "iTextMo API: No response from server.";
		}

		else if($result == 0){
			return "Message Sent!";
		}

		else{
			return "Error Num: ".$result. " was encountered!";
		}
	}
}
?>