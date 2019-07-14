<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");

if (isset($_POST['username']) AND $_POST['username']!="") {
	http_response_code(500);

	// include class from file
	include( dirname(__FILE__) . '/../classes/user.php');
	$user = new User($_POST['username']);
	
	$user->recover_password();

	http_response_code(200);
	response(NULL, 200,"Your password has been send to your emails");
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