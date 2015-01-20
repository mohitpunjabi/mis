<?php

class Basic_model extends CI_Model
{
	var $table_userdetails = 'user_details';
	var $table_dept_course = 'dept_course';
	var $table_course = 'courses';
	var $table_branch = 'branches';
	var $table_subject = 'subjects';
	var $table_course_structure = 'course_structure';
	var $table_elective_group = 'elective_group';
	var $table_course_branch = 'course_branch';
	var $table_elective_offered = 'elective_offered';
	
	function __construct()
	{
		// Calling the Model parent constructor
		parent::__construct();
	}	
	
	
	
	
	function get_course_details_by_id($id)
	{
		$query = $this->db->get_where($this->table_course,array('id'=>$id));
		return $query->result();
	}
	
	function get_branch_details_by_id($id)
	{
		$query = $this->db->get_where($this->table_branch,array('id'=>$id));
		return $query->result();
	}	
	
	function get_branch_by_dept_course_session($dept,$course,$session){
		$query = $this->db->query("SELECT * from dept_course where dept_id='".$dept."' AND aggr_id REGEXP '^".$course.".*".$session."$'");
		return $query->result();
	}
	/*
	function select_elective_group_details_by_aggr_id($aggr_id)
	{
		$query = $this->db->get_where($this->table_elective_group,array('aggr_id'=>$aggr_id));
		return $query->result();
	}
	*/
	
	
	
	
	function select_elective_group_by_group_id($group_id)
	{
		$query = $this->db->get_where($this->table_elective_group,array('group_id'=>$group_id));
		return $query->result();
	}
	
	function insert_elective_offered($data)
	{
    	return $this->db->insert($this->table_elective_offered,$data);
    	//return $this->db->_error_message(); 
	}
	

}
/* End of file menu_model.php */
/* Location: mis/application/models/course_structure/menu_model.php */