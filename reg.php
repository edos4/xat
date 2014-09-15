<?php
	include('dbConnect.php');
	include('functions.php');

	session_start();
	$name = sanitize($_POST['name']);
	$email = sanitize($_POST['email']);
	$username = sanitize($_POST['username']);
	$password = md5(NaCl.sanitize($_POST['password']));

	//check for duplicates
	$stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ?");
	$stmt->bind_param('s', $username);
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows()){
		echo "Username ".$username." is already taken. ";
	}
	
	//validate email address
	else if (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/", $email)){
		echo "Email address ".$email." is not valid. ";
	}
	else{
		$stmt = $mysqli->prepare("insert into users (name, email, username, password) VALUES (?,?,?,?)");
		$stmt->bind_param('ssss', $name, $email, $username, $password);
		$stmt->execute();  
		if($stmt->affected_rows){
			echo 'true';
		}
		else{
			echo 'Error in registering. Please try again. ';
		}
	}
?>