<?php

class User_address_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert('user_address',$data);
	}

	function insert_batch($data)
	{
		$this->db->insert_batch('user_address',$data);
	}
}

/* End of file user_address_model.php */
/* Location: mis/application/models/user_address_model.php */