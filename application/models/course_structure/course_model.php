<?php

class Course_model extends CI_Model
{
 	var $table_courses='courses';
	var $table_branch='branches';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
  	
	function insert_course($course_details)
	{
    	$this->db->insert($this->table_courses, $course_details);
     	return true; 
	}
	function insert_branch($branch_details)
	{
    	$this->db->insert($this->table_branch, $branch_details);
      	return true;
	}
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */