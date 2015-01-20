<?php

class Employee_menu_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getMenu()
	{
		$menu=array();
		//auth ==> emp
		$menu['emp']=array();
		$menu['emp']['Employee details']=array();
		$menu['emp']["Employee details"]["Edit your details"] = site_url('employee/edit');
		$menu['emp']["Employee details"]["View your details"] = array();
		$menu['emp']["Employee details"]["View your details"]["Basic Details"] = site_url('employee/view/index/0');
		$menu['emp']["Employee details"]["View your details"]["Previous Employment Details"] = site_url('employee/view/index/1');
		$menu['emp']["Employee details"]["View your details"]["Dependent Family Member Details"] = site_url('employee/view/index/2');
		$menu['emp']["Employee details"]["View your details"]["Educational Details"] = site_url('employee/view/index/3');
		$menu['emp']["Employee details"]["View your details"]["Last 5 Year Stay Details"] = site_url('employee/view/index/4');
		$menu['emp']["Employee details"]["View your details"]["All Details"] = site_url('employee/view/index/5');

		//auth ==> est_ar
		$menu['est_ar']=array();
		$menu['est_ar']['Employee details']=array();
		$menu['est_ar']["Employee details"]["Validation Requests"]=site_url('employee/validation');

		//auth ==> deo
		$menu['deo']=array();
		$menu['deo']['Manage Employees']=array();
		$menu['deo']["Manage Employees"]["Add Employee"] = site_url('employee/add');
		$menu['deo']["Manage Employees"]["Edit Employee Details"] = site_url('employee/edit');
		$menu['deo']["Manage Employees"]["View Employee Details"] = site_url('employee/view');
		$menu['deo']["Manage Employees"]["Validation Requests"] = site_url('employee/validation');

		return $menu;
	}
}
/* End of file employee_menu.php */
/* Location: mis/application/models/employee/employee_menu.php */