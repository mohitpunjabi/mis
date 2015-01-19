<?php

Class Student_fee_details_model extends CI_Model
{
	var $table = 'stu_fee_details';

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