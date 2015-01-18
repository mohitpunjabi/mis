<?php

class File_details extends CI_Model
{

	var $table = 'file_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data, $track_num)
	{
		//echo print_r($data);
		$this->db->insert($this->table,$data);
		//Insert Into Table
		//random generation of track number
		//echo random_string('alpha', 2);
		
		/*$this->db->select ('file_id');
		$this->db->get ($this->table);
		$query = $this->db->where ('emp_id', $emp_id);*/
		/*$sql_query = "SELECT file_id from file_basic_details where emp_id = ".$emp_id.";";
		$query = $this->db->query($sql_query);
		foreach ($query->result() as $row) //last
				$file_id = $row->file_id;*/
		//$track_num = $file_id+100;
		/*$data = array (
					'track_num' => $track_num
					 );*/
//		$this->db->where ('emp_id', $emp_id);
		//$this->db->where ('file_id', $file_id);
		//$this->db->update ($this->table, $arr);

		//$this->db->query("UPDATE file_basic_details SET timestamp = now() WHERE file_id=".$file_id.";");
		$this->db->select('file_id');
		$this->db->where('track_num', $track_num); 
		$query = $this->db->get($this->table);
		$file = $query->row();
		$output = array (
					'file_id' => $file->file_id
					 );
		return $output;
	}
	function get_track_num ($file_id)
	{
		$sql_query = "SELECT track_num from file_details where file_id = ".$file_id.";";
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
	
	function get_file_details ($file_id)
	{
		$res = $this->db->query("SELECT * from file_details where file_id = ".$file_id.";");
		return $res;
	}
	function change_file_status ($file_id)
	{
		$this->db->query ("UPDATE file_details SET file_status=1 WHERE file_id=".$file_id.";");
	}
	function get_department_by_id()
	{
		$query =  $this->db->query("SELECT name,id FROM departments;");
		return $query->result_array();
	}
	function get_faculty_by_department_id($dept_id)
	{
		$query = $this->db->query("SELECT id,salutation,first_name,middle_name,last_name FROM user_details WHERE dept_id="."'".$dept_id."'".";");
		return $query->result_array();
	}
	function insert($file_id, $emp_id, $track_num)
	{
//		echo "INSERT INTO file_closed_details VALUES (".$emp_id.",".$file_id.",now(),".$track_num.");";
		$this->db->query("INSERT INTO file_details VALUES (".$emp_id.",".$file_id.",now(),".$track_num.");");
	}
}


