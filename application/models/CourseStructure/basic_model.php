<?php

class Basic_model extends CI_Model
{
	var $table_course = 'courses';
	var $table_branch = 'branches';
	var $table_course_branch = 'course_branch';


	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function get_course()
	{
		$query = $this->db->get($this->table_course);
		return $query->result();
	}
	function get_course_details_by_id($id)
	{
		$query = $this->db->get_where($this->table_course,array('id'=>$id));
		return $query->result();
	}
	
	function get_branches()
	{
		$query = $this->db->get($this->table_branch);
		return $query->result();
	}
	
	function get_branch_details_by_id($id)
	{
		$query = $this->db->get_where($this->table_branch,array('id'=>$id));
		return $query->result();
	}
	
	
	function select_course_branch($aggr_id)
	{
    	$query = $this->db->get_where($this->table_course_branch, array('aggr_id'=>$aggr_id));
		return $query->result();
	}
	
	function insert_course_branch($course_branch_mapping)
	{
    	$this->db->insert($this->table_course_branch, $course_branch_mapping);
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