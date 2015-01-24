<?php

class Leave_menu_model extends CI_Model
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
		$menu['emp']['Leave Management']=site_url('leave/menu');
		return $menu;
	}
}
/* End of file employee_menu.php */
/* Location: mis/application/models/employee/employee_menu.php */