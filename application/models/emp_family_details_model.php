<?php

class Emp_family_details_model extends CI_Model
{
	var $table = 'emp_family_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}

	function insert_batch($data)
	{
		$this->db->insert_batch($this->table,$data);
	}
}

/* End of file emp_family_details_model.php */
/* Location: mis/application/models/emp_family_details_model.php */