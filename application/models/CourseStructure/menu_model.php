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
		$menu['deo']['Course Structure']=array();
		$menu['deo']["Course Structure"]["Add Course Structure"] = site_url('CourseStructure/add');
		$menu['deo']["Course Structure"]["Edit Course Structure"] = site_url('CourseStructure/add');
		$menu['deo']["Course Structure"]["View Employee Details"] = site_url('employee/view');
		$menu['deo']["Course Structure"]["Validation Requests"] = site_url('employee/validation');

		return $menu;
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/CourseStructure/menu_model.php */