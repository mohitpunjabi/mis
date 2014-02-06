<?php
	$connect=mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	$db = mysql_select_db(DB_DATABASE);
	if (!$db)
	  die("Failed to connect to database: " . mysql_error());
?>


