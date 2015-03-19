<?php

class Student_details_to_approve extends CI_Model
{
	var $table = 'stu_details_to_approve';

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

	function delete($id)
	{}
}