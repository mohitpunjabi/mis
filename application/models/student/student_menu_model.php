<?php

class Student_menu_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getMenu()
	{
		$menu=array();

		//auth ==> deo
		$menu['deo']=array();
		$menu['deo']['Manage Students']=array();
		$menu['deo']["Manage Students"]["Add Student"] = site_url('student/student_add_deo');
		$menu['deo']['Manage Students']["Edit Student Details"] = site_url('student/student_edit');

		//$auth ==> stu
		$menu['stu']=array();
		$menu['stu']['Edit Your Details'] = site_url('student/student_editable_by_student');

		return $menu;
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/employee/menu_model.php */