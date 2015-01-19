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
  var $table_depts = 'departments';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	function Select_Department_By_User_ID($userid)
	{
    	$query = $this->db->get_where($this->table_userdetails,array('id'=>$userid));
		return $query->result();
	}
	
	function get_course()
	{
		$query = $this->db->get($this->table_course);
		return $query->result();
	}
  function get_depts()
	{
		$query = $this->db->get_where($this->table_depts, array('type'=>'academic'));
		return $query->result();
	}
	function get_course_details_by_id($id)
	{
		$query = $this->db->get_where($this->table_course,array('id'=>$id));
		return $query->result();
	}
	
	function get_course_by_dept_id($dept_id)
	{
		$query = $this->db->query("SELECT DISTINCT id,name,duration FROM courses INNER JOIN course_branch ON course_branch.course_id = courses.id INNER JOIN dept_course ON 
		dept_course.aggr_id = course_branch.aggr_id WHERE dept_course.dept_id = '$dept_id'");
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
	
	function get_branch_by_dept_id($dept_id)
	{
		$query = $this->db->query("SELECT DISTINCT id,name FROM branches INNER JOIN course_branch ON course_branch.branch_id = branches.id INNER JOIN dept_course ON 
		dept_course.aggr_id = course_branch.aggr_id WHERE dept_course.dept_id = '$dept_id'");
		return $query->result();
	}
	
	function select_course_branch($aggr_id)
	{
    	$query = $this->db->get_where($this->table_course_branch, array('aggr_id'=>$aggr_id));
		if($query->num_rows() >= 1)
			return true;
		else
			return false;
	}
	
	function insert_course_branch($course_branch_mapping)
	{
    	$this->db->insert($this->table_course_branch, $course_branch_mapping);
		return true;
	}

	function get_subject_details($id)
  	{
    	 $query = $this->db->get_where($this->table_subject,array('id'=>$id));
    	 return $query->row();
  	}
	
	function get_subject_details_by_group_id($elective)
  	{
    	 $query = $this->db->get_where($this->table_subject,array('elective'=>$elective));
    	 return $query->row();
  	}
	
	
	function get_subjects_by_sem($sem,$aggr_id)
	{
		$query = $this->db->get_where($this->table_course_structure,array('semester'=>$sem, 'aggr_id'=>$aggr_id));
		return $query->result();
	}
	
	function get_course_structure_by_id($id)
	{
		$query = $this->db->get_where($this->table_course_structure,array('id'=>$id));
		return $query->row();
	}
	
	function select_elective_group_by_group_id($group_id)
	{
		$query = $this->db->get_where($this->table_elective_group,array('group_id'=>$group_id));
		return $query->row();
	}
	
	function update($data, $where)
	{
		$this->db->update($this->table,$data,$where);
	}

	function delete_course_structure($coursestructure_details)
	{
		return $this->db->delete($this->table_course_structure,array('semester'=>$coursestructure_details["semester"],'aggr_id'=>
		$coursestructure_details['aggr_id'
		]));
	}
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */