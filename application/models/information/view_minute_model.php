<?php

class View_minute_model extends CI_Model
{

	var $table = 'info_minute_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	//return a list of minute number for a particular employee
	function get_minute_ids()
	{
		
		$auth_id = $this->db->select('auth_id')->where('id',$this->session->userdata('id'))->get('users');
		$minute_cat = $auth_id->row()->auth_id;
		
		$this->db->select('minutes_id');
		$where = "meeting_cat = 'all' OR meeting_cat = '".$minute_cat."'";
		$this->db->order_by('posted_on','desc');
		$this->db->where($where);
		$query = $this->db->get($this->table);

		return $query->result();
	}
	
	//return a row for a particular minute number
	function get_minute_row($minute_id)
	{
		$this->db->where('minutes_id',$minute_id);
		$query = $this->db->get($this->table);
		
		return $query->row();
	}
	
	function get_prev_versions($minute_id)
	{
		$table = 'info_minute_modification_details';
		$this->db->where('minutes_id',$minute_id);
		$this->db->order_by('posted_on','desc');
		$query = $this->db->get($table);
		
		return $query->result();
	}
	
	function get_minute_row2($minute_id,$modv)
	{
		$table = 'info_minute_modification_details';
		$this->db->where('minutes_id',$minute_id);
		$this->db->where('modification_value',$modv);
		$query = $this->db->get($table);
		
		return $query->row();
	}
}

/* End of file view_minute_model.php */
/* Location: mis/application/models/view_minute_model.php */