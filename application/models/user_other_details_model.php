<?php

class User_other_details_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert('user_other_details',$data);
	}
}

/* End of file user_other_details_model.php */
/* Location: mis/application/models/user_other_details_model.php */