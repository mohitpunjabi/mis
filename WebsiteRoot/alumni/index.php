<?php
	require_once("../Includes/Auth.php");
	auth('stu','alum');
	header("Location: ../home/");
?>