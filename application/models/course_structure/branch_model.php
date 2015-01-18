<?php

class Branch_model extends CI_Model
{
	var $table_branch = 'branches';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	
	function insert($branch_details)
	{
    	$this->db->insert($this->table_branch, $branch_details);
      return $this->db->_error_message(); 
	}
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */