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
	
	
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */