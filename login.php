<?php
	include('dbConnect.php');
	include('functions.php');

	session_start();
	$username = sanitize($_POST['username']);
	$password = md5(NaCl.sanitize($_POST['password']));
	
	if($stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ? AND password = ?")){
		$stmt->bind_param('ss', $username, $password);
		$stmt->execute();
		$stmt->store_result();
		echo $stmt->num_rows()==1?'true':'false';
	}
?>