<?php

class Emp_current_entry_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function get_current_entry()
	{
		$query = $this->db->get('emp_current_entry');
		if($query->num_rows() === 1)
	        	return $query->row();
		else
			return FALSE;
	}

	function insert($data)
	{
    	$this->db->insert('emp_current_entry', $data);
	}
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */