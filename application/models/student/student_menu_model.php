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
		$menu['acad_da1']=array();
		$menu['acad_da1']['Manage Students']=array();
		$menu['acad_da1']["Manage Students"]["Add Student"] = site_url('student/student_add_deo');
		$menu['acad_da1']['Manage Students']["Edit Student Details"] = site_url('student/student_edit');
		$menu['acad_da1']["Manage Students"]["View Student"]["Details"] = site_url('student_view_report/view');
		$menu['acad_da1']["Manage Students"]["View Student"]["Report"] = site_url('student_view_report/reports');
		$menu['acad_da1']["Manage Students"]["View Rejected Students"] = site_url('student/student_rejected');
		
		//auth ==> emp
		$menu['emp']["Manage Students"]["View Student"]["Details"] = site_url('student_view_report/view');
		$menu['emp']["Manage Students"]["View Student"]["Report"] = site_url('student_view_report/reports');
		
		//$auth ==> stu
		$menu['stu']=array();
		$menu['stu']['Edit Your Details'] = site_url('student/student_editable_by_student');
		$menu['stu']["View Your Details"] = site_url('student_view_report/view');

		//$auth ==> est_ar
		$menu['acad_ar']=array();
		$menu['acad_ar']['Student Details']=array();
		$menu['acad_ar']['Student Details']['Validation Requests'] = site_url('student/student_validate');


		return $menu;
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/employee/menu_model.php */