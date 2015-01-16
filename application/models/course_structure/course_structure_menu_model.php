<?php

class Course_structure_menu_model extends CI_Model
{
	function __construct()
	{
		// Calling the Model parent constructor
		parent::__construct();
	}

	function getMenu()
	{
		$menu=array();
		
		$menu['deo']=array();
		$menu['deo']['Course Structure']=array();
		$menu['deo']["Course Structure"]["Add Course Structure"] = site_url('CourseStructure/add');
		$menu['deo']["Course Structure"]["Edit Course Structure"] = site_url('CourseStructure/edit');
		$menu['deo']["Course Structure"]["View Course Structure"] = site_url('CourseStructure/view');

		return $menu;
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/CourseStructure/menu_model.php */