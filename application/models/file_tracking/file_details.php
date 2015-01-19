<?php

class File_details extends CI_Model
{
	var $table = 'file_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
//		$this->db->query ("INSERT INTO values ();")
	}
	function get_track_num ($file_id)
	{
		$sql_query = "SELECT track_num from file_details where file_id = '".$file_id."';";
		$query = $this->db->query($sql_query);
		foreach ($query->result() as $row) //last
				$track_num = $row->track_num;
		return $track_num;
		
	}
	
	function get_file_id ($track_num)
	{
		$sql_query = "SELECT * from file_details where track_num = ".$track_num.";";
		$res = $this->db->query($sql_query);
		return $res;
	}
	
	function get_file_details ($track_num)
	{
		$res = $this->db->query("SELECT * from file_details where track_num = '".$track_num."';");
		return $res;
	}
	function get_department_by_id()
	{
		$query =  $this->db->query("SELECT name,id FROM departments;");
		return $query->result_array();
	}
	function get_designation_by_department_id ($dept_id)
	{
		$query = $this->db->query("SELECT DISTINCT designations.id, designations.name FROM designations INNER JOIN user_details INNER JOIN emp_basic_details ON designations.id = emp_basic_details.designation AND user_details.id = emp_basic_details.id where dept_id = '".$dept_id."';");
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;	 
	}
	function get_emp_name ($designation, $dept)
	{
		$query = $this->db->query ("SELECT emp_basic_details.id AS id from user_details INNER JOIN emp_basic_details ON user_details.id = emp_basic_details.id where dept_id = '".$dept."' and designation = '".$designation."';");
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;	 
	}
	function insert_close_details($file_id, $emp_id)
	{
		$this->db->query("UPDATE file_details SET close_timestamp=now(), close_emp_id='".$emp_id."'WHERE file_id='".$file_id."';");
	}
}


