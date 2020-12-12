<?php

require_once 'menu.php';

file_put_contents("viber.json",file_get_contents("php://input"));
$viber = file_get_contents("viber.json");
$viber = JSON_decode($viber);

function send($message){
    
	$curl = curl_init();
    
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://chatapi.viber.com/pa/send_message",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => JSON_encode($message),
	  CURLOPT_HTTPHEADER => array(
		"Cache-Control: no-cache",
		"Content-Type: application/JSON",
		"X-Viber-Auth-Token: VIBER-TOKEN"
	  ),
	));
    
	$response = curl_exec($curl);
	$err = curl_error($curl);
    
    
	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	  echo $response;
	}
	
}

if ($viber->event == "conversation_started"){
	$message['receiver'] = $viber->user->id;
	$message['type'] = "text";
	$message['text'] = "Welcome messages";
	$message['keyboard'] = [
		"Type" => "keyboard",
		"Revision" => 1,
		"DefaultHeight" => false,
		"Buttons" => $main_menu
	];
	send($message);
	exit;
}

 if ($viber->event == "message"){
     
	if ($viber->message->text == "action1"){
	    
		$message['receiver'] = $viber->sender->id;
		$message['type'] = "text";
		$message['text'] = "Button 1";
		$message['keyboard'] = [
			"Type" => "keyboard",
			"Revision" => 1,
			"DefaultHeight" => false,
			"Buttons" => $main_menu
			
		];
		send($message);
		exit;
    }
 }