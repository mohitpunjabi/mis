<?php
	require_once("../Includes/Auth.php");
	require_once("../Includes/Layout.php");
	auth();
	
	notify("deo1", "Important Notification", "This is an important notification.", "index.php", "success");
	
	header("Location: index.php");
	exit;
?>