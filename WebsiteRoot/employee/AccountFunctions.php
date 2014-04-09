<?php
	$employee = array();

	if(is_auth('deo')) 
	{
		$employee["Manage Employees"] = array();
		$employee["Manage Employees"]["Add Employee"] = "add_employee.php";
		$employee["Manage Employees"]["Edit Employee Details"] = "edit_employee.php";
		$employee["Manage Employees"]["View Employee Details"] = "emp_view.php";
		$employee["Manage Employees"]["Validation Requests"]="validate.php";
	}
	
	if(is_auth('emp')) {
		$employee["Employee details"]=array();
		$employee["Employee details"]["Edit your details"]="edit_basic_detail_authemp.php";
		$employee["Employee details"]["View your details"] = array();
		$employee["Employee details"]["View your details"]["Basic Details"] = "show_emp.php?form_name=0";
		$employee["Employee details"]["View your details"]["Previous Employment Details"] = "show_emp.php?form_name=1";
		$employee["Employee details"]["View your details"]["Dependent Family Member Details"] = "show_emp.php?form_name=2";
		$employee["Employee details"]["View your details"]["Educational Details"] = "show_emp.php?form_name=3";
		$employee["Employee details"]["View your details"]["Last 5 Year Stay Details"] = "show_emp.php?form_name=4";
		$employee["Employee details"]["View your details"]["All Details"] = "show_emp.php?form_name=5";
		if(is_auth('est_ar'))
			$employee["Employee details"]["Validation Requests"]="validate.php";
	}
?>