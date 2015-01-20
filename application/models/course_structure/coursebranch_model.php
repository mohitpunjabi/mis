<?php

class Coursebranch_model extends CI_Model
{
	var $table_coursebranch = 'course_branch';
	var $table_coursestructure = 'course_structure';
	var $table_elective_group = 'elective_group';


	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	
	function insert($cb_details)
	{
    $this->db->insert($this->table_coursebranch, $cb_details);
    return $this->db->_error_message(); 
	}
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */