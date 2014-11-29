<?php

class Users_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert('users',$data);
	}
}

/* End of file users_model.php */
/* Location: mis/application/models/users_model.php */