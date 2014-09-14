<?php
	include('config.php');
	@mysql_connect(dbServer, dbUser, dbPw);
	@mysql_select_db(dbName);
?>