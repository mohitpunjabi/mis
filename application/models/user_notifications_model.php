<?php

class User_notifications_model extends CI_Model
{

	var $table = 'user_notifications';
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}

}

/* End of file user_notifications_model.php */
/* Location: mis/application/models/user_notifications_model.php */