<?php
header("Content-Type:application/json");
header("Access-Control-Allow-Origin: *");

if (isset($_POST['username']) AND $_POST['username']!="" AND isset($_POST['password']) AND $_POST['password']!="") {
	include('db.php');

	$username = $_POST['username'];
	$password = $_POST['password'];

	$result = mysqli_query(
		$con,
		"SELECT id FROM `users` WHERE username='$username' AND password='$password'");
		
	$rows = $result->num_rows;
	if ($result) {
		if($rows === 1){
			http_response_code(200);
			response(NULL, 200,"You have successfully logged in!");
		} else {
			http_response_code(402);
			response(NULL, 402,"User not Found");
		}
	} else {
		http_response_code(500);
		response(NULL, 500,"Internal error");
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