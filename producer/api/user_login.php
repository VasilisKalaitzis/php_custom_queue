<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");


if (isset($_POST['username']) AND $_POST['username']!="" AND isset($_POST['password']) AND $_POST['password']!="") {
	http_response_code(500);

	// include class from file
	include( dirname(__FILE__) . '/../classes/user.php');
	$user = new User($_POST['username'],$_POST['password']);
	
	if ($user->login() === 1) {
			http_response_code(200);
			response($result, 200,"You have successfully logged in!");
	} else {
		http_response_code(402);
		response(NULL, 404,"User not Found");
	}
} else {
	http_response_code(400);
	response(NULL, 400,"Invalid Input");
}

function response($data,$response_code,$response_desc){
	$response['data'] = $data;
	$response['response_code'] = $response_code;
	$response['response_desc'] = $response_desc;
	
	$json_response = json_encode($response);
	echo $json_response;
}
 
?>