<?php
	@session_start();
	@session_destroy();
	
	header("Location: ../Login.php?error=Access denied");
	exit;
?>