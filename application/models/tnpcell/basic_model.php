<?php

class Basic_model extends CI_Model
{
	var $table_projects = 'tnp_projects';
  	var $table_achievements='tnp_cv_achievements';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function get_all_company_id()
	{
		$this->db->query();
		return $this->db->result();	
	}
	
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */