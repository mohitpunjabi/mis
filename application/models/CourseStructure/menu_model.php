<?php

class Menu_model extends CI_Model
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
/* End of file menu_model.php */
/* Location: mis/application/models/employee/menu_model.php */