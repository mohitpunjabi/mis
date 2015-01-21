<?php

class Add_model extends CI_Model
{
	var $table_subject = 'subjects';
	var $table_coursestructure = 'course_structure';
	var $table_elective_group = 'elective_group';


	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert_subjects($subject_details)
	{
    	$this->db->insert($this->table_subject, $subject_details);
		return $this->db->_error_message(); 
	}
	
	function insert_coursestructure($coursestructure_details)
	{
    	$this->db->insert($this->table_coursestructure, $coursestructure_details);
		return $this->db->_error_message(); 
	}
	
	function insert_elective_group($elective_group)
	{
    	$this->db->insert($this->table_elective_group, $elective_group);
		return $this->db->_error_message(); 
	}
	
	function update($data, $where)
	{
		$this->db->update($this->table,$data,$where);
	}

	function delete($where)
	{
		$this->db->delete($this->table,$where);
	}
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */