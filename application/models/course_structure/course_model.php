<?php

class Course_model extends CI_Model
{
  var $table_courses='courses';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
  
	function insert($course_details)
	{
     $this->db->insert($this->table_courses, $course_details);
     return $this->db->_error_message(); 
	}
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */