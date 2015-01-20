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
	function Select_Department_By_User_ID($userid)
	{
    	$query = $this->db->get_where($this->table_userdetails,array('id'=>$userid));
		return $query->result();
	}
	
	function Select_courses_by_dept($deptid)
	{
    	$query = $this->db->get_where($this->table_dept_course,array('dept_id'=>$deptid));
		return $query->result();
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
	
	/*
	function select_elective_group_details_by_aggr_id($aggr_id)
	{
		$query = $this->db->get_where($this->table_elective_group,array('aggr_id'=>$aggr_id));
		return $query->result();
	}
	*/
	
	
	function select_all_subject_by_aggr_id_and_semester($aggr_id,$semester)
	{
		$query = $this->db->query("SELECT * FROM subjects INNER JOIN course_structure ON course_structure.id = subjects.id WHERE course_structure.aggr_id = '$aggr_id' AND 
		course_structure.semester = '$semester'");
		return $query->result();
	}	
	
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