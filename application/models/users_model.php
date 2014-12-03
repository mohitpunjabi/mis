<?php

class Users_model extends CI_Model
{
	var $table = 'users';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($thid->table,$data);
	}

	function update($data, $where)
	{
		$this->db->update($this->table,$data,$where);
	}
}

/* End of file users_model.php */
/* Location: mis/application/models/users_model.php */