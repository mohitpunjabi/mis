<?php
	$connect=mysql_connect("localhost", "root", "");
	$db = mysql_select_db("mis");
	if (!$db)
	  die("Failed to connect to database: " . mysql_error());
?>


