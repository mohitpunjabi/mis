<?php
	require_once("../Includes/Auth.php");
	require_once("../Includes/Layout.php");
	
	auth();
	
	drawHeader();

	var_dump($_SESSION);
	
	drawFooter();
?>