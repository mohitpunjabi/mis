<?php
	require_once("../Includes/Auth.php");
	require_once("../Includes/Layout.php");
//	auth();
	drawHeader();

	var_dump($_SESSION);

	var_dump(encode_password("p", "2014-02-07 00:00:00"));

	drawFooter();
?>