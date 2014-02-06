<?php
	require_once("../Includes/Auth.php");
	
	$home = Array();

	if(in_array('emp', $_SESSION['auth'])) {
		$home["Home"] = array();
		$home["Home"]["Menu 1"] = "menu1.php";
		$home["Home"]["Menu 2"] = "menu2.php";
		$home["Home"]["Menu 3"] = array();
		$home["Home"]["Menu 3"]["SMenu1"] = "smenu1.php";
		$home["Home"]["Menu 3"]["SMenu2"] = "smenu2.php";
		$home["Home"]["Menu 4"] = "menu4.php";
	}