<?php
	$student = array();
	
	if(is_auth('deo')) {
		$student["Manage students"] = array();
		$student["Manage students"]["Add student"] = "add_student.php";
		$student["Manage students"]["Edit student Details"] = "edit_student.php";
		$student["Manage students"]["View student Details"] = "emp_view.php";
	}
	
	if(is_auth('emp')) {
		$student["View your details"] = "show_emp.php";
	}