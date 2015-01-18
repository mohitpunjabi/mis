<?php

class File_closed_details extends CI_Model
{
	var $table = 'file_closed_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($file_id, $emp_id, $track_num)
	{
//		echo "INSERT INTO file_closed_details VALUES (".$emp_id.",".$file_id.",now(),".$track_num.");";
		$this->db->query("INSERT INTO file_details VALUES (".$emp_id.",".$file_id.",now(),".$track_num.");");
	}
}