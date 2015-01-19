<?php

Class Student_academic_model extends CI_Model
{
	var $table = 'stu_academic';

	function __construct()
	{
		parent::__construct();
	}

	function insert($data)
	{
		$query = $this->db->insert($this->table,$data);
	}
}

?>