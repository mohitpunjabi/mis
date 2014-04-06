<?php
require_once('../Includes/Auth.php');
require_once('../Includes/Layout.php');
auth();
if(is_auth('hod'))
	header('Location: Startpage_hod.php');
else if(is_auth('ft'))
	header('Location: Startpage_faculty.php');
else if(is_auth('deo','stock'))
	header('Location: Startpage_dataOP.php');
else
	header("location: ../Includes/SessionAuthFail.php");
?>
