<?php
	require_once("../Includes/Auth.php");
	require_once("../Includes/Layout.php");
	
	auth("a", "b");

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	var_dump(login("806", "ps", $mysqli));
	var_dump(login_check($mysqli));

	var_dump("http://www.google.com/");
	var_dump(esc_url("http://localhost/mis/WebsiteRoot/home/"));
?>