<?php

class Emp_pay_details_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert('emp_pay_details',$data);
	}
}

/* End of file emp_pay_details_model.php */
/* Location: mis/application/models/emp_pay_details_model.php */