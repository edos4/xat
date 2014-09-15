<?php
	include('dbConnect.php');
	include('functions.php');

	session_start();
	$username = sanitize($_POST['username']);
	$password = md5(NaCl.sanitize($_POST['password']));
	$qry = "SELECT * FROM users WHERE username='".$username."' AND password='".$password."' ";
	$res = mysql_query($qry);
	$num_row = mysql_num_rows($res);
	$row=mysql_fetch_assoc($res);
	if( $num_row == 1 ) {
		echo 'true';
	}
	else {
		echo 'false';
	}
?>