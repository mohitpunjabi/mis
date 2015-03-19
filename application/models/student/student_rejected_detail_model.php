<?php

class Student_rejected_detail_model extends CI_Model
{
	var $table = 'stu_rejected_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		if($this->db->insert($this->table,$data))
			return true;
		else
			return false;
	}
}