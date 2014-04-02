<?php
	$employee = array();
	
	if(is_auth('deo')) {
		$employee["Manage Employees"] = array();
		$employee["Manage Employees"]["Add Employee"] = "add_employee.php";
		$employee["Manage Employees"]["Edit Employee Details"] = "edit_employee.php";
		$employee["Manage Employees"]["View Employee Details"] = "emp_view.php";
	}
	
	if(is_auth('emp')) {
		$employee["View your details"] = "show_emp.php";
	}