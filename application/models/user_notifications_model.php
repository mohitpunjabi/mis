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

	function getUnreadUserNotifications($user_to, $auth)
	{
		$query = $this->db->where('user_to',$user_to)
						->where('auth_id',$auth)
						->where('send_date >= ', date('Y-m-d H:i:s', $this->session->userdata('last_activity')))
						->order_by('send_date','desc')
						->get($this->table);
		if($query->num_rows()==0)	return FALSE;
		return $query->result();
	}

	function getReadUserNotifications($user_to, $auth)
	{
		$query = $this->db->where('user_to',$user_to)
						->where('auth_id',$auth)
						->where('send_date < ', date('Y-m-d H:i:s', $this->session->userdata('last_activity')))
						->order_by('send_date','desc')
						->get($this->table);
		if($query->num_rows()==0)	return FALSE;
		return $query->result();
	}

}

/* End of file user_notifications_model.php */
/* Location: mis/application/models/user_notifications_model.php */