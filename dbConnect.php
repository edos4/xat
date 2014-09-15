<?php
	include('config.php');
	$mysqli = new mysqli(dbServer, dbUser, dbPw, dbName);
	if($mysqli->connect_error) {
	  $this->last_error = 'Cannot connect to database. ' . $mysqli->connect_error;
	}
?>