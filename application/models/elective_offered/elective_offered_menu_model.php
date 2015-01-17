<?php

class Elective_offered_menu_model extends CI_Model
{
	function __construct()
	{
		// Calling the Model parent constructor
		parent::__construct();
	}

	function getMenu()
	{
		$menu=array();
		
		$menu['hod']=array();
		$menu['hod']['Choose Elective']=array();
		$menu['hod']["Choose Elective"]['Choose Elective for Students'] = site_url('elective_offered/home');

		return $menu;
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/course_structure/menu_model.php */