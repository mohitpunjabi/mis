<?php

class Courses_model extends CI_Model
{
	var $table = 'courses';
	var $course_branch_table = 'course_branch';
	var $var_data = 'b.tech';

	function __construct()
	{
		parent::__construct();
	}

	function get_courses_by_branch($branch_id = '')
	{
		if($branch_id !== '')
		{
			//$command1 = 'SELECT DISTINCT course_id FROM course_branch WHERE branch_id="'.$branch_id.'"';
			//$query = $this->db->query($command1);
			//$command2 = 'SELECT id, name FROM courses INNER JOIN '.$query;
			//$this->db->select('id, name')
			//		 ->where('id="'.$this->var_data.'"','',FALSE);
			//$query = $this->db->get($this->table);
			$command = 'SELECT id, name FROM courses INNER JOIN (SELECT DISTINCT course_id FROM course_branch WHERE branch_id="'.$branch_id.'") as temp_table';
			$query = $this->db->query($command);
			//var_dump($query);
			if($query->num_rows() > 0)
				return $query->result();
			else
				return FALSE;
		}
		else
		{
			return FALSE;
		}
	}
}

?>