<?php
	require_once('Includes/Auth.php');
	session_start_sec();
	 
	$_SESSION = array();
	 
	$params = session_get_cookie_params();
	
	// Destroying the cookie.
	setcookie(session_name(),
			'', time() - 42000, 
			$params["path"], 
			$params["domain"], 
			$params["secure"], 
			$params["httponly"]);
	 
	session_destroy();
	$qstring = (isset($_GET['error']))? "?error=".$_GET['error']: "";
	header('Location: Login.php' . $qstring);