<?php
	include('dbConnect.php');

	function isDuplicate($username){
		$res = mysql_query("select * from users where username='$username'");
		return mysql_num_rows($res);
	}

	session_start();
	$name = $_POST['name'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = md5(NaCl.$_POST['password']);

	//check for duplicates
	if(isDuplicate($username)){
		echo "Username ".$username." is already taken. ";
	}
	//validate email address
	else if (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+\.[a-zA-Z]{2,4}/", $email)){
		echo "Email address ".$email." is not valid. ";
	}
	else{
		$result = mysql_query("insert into users (name, email, username, password) VALUES ('$name','$email','$username','$password')");
		if($result){
			echo 'true';
		}
		else{
			echo 'Error in registering. Please try again. ';
		}
	}
?>