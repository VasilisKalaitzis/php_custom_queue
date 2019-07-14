<?php

if (isset($_POST['username']) AND $_POST['username']!="" AND isset($_POST['password']) AND $_POST['password']!="") {
	include(dirname(__FILE__) . '/../db.php');

	$username = $_POST['username'];
	$password = $_POST['password'];

	$result = mysqli_query(
		$con,
		"SELECT id FROM `users` WHERE username='$username' AND password='$password'");
		
	echo $result->num_rows;
}
 
?>