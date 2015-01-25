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
    	$menu['deo']["Course Structure"]["Add a Course"] = site_url('course_structure/add_course');
		$menu['deo']["Course Structure"]["Add/Map a Branch"] = site_url('course_structure/add_branch');
		//$menu['deo']["Course Structure"]["Select Courses Run by Department"] = site_url('course_structure/map_dept');
		$menu['deo']["Course Structure"]["Add Course Structure"] = site_url('course_structure/add');
		$menu['deo']["Course Structure"]["Edit Course Structure"] = site_url('course_structure/edit');
		$menu['deo']["Course Structure"]["View Course Structure"] = site_url('course_structure/view');
		
		//$menu['deo']=array();
		$menu['hod']['Course Structure']=array();
		$userid = $this->session->userdata('id');
    	$menu['hod']["Course Structure"]["View Course Structure"] = site_url('course_structure/view/index/'.$userid.'');
			
		//$menu['hod']=array();
		//$menu['hod']['Choose Elective']=array();
		$menu['hod']['Course Structure']["Offer Elective"] = site_url('course_structure/elective_offered_home');

		return $menu;
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/course_structure/menu_model.php */