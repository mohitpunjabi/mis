<?php
	$student = array();
	
	if(is_auth('deo')) {
		$student["Manage Students"] = array();
		$student["Manage Students"]["Add Student"] = "add_student.php";
		$student["Manage Students"]["View Student Details"] = "stu_view.php";
	}
	
	if(is_auth('stu')) {
		$student["View your details"] = "show_stu.php";
	}