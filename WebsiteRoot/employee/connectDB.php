<?php
	require_once("../Includes/ConfigSQL.php");
	$connect=mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	$db = mysql_select_db(DB_DATABASE);
	if (!$db)
	  die("Failed to connect to database: " . mysql_error());
	
	function clean($str) 
	{
		$str = @trim($str);
		if(get_magic_quotes_gpc()) 
		{
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
?>
