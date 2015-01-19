<?php

Class Student_other_details_model extends CI_Model
{
	var $table = 'stu_other_details';

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