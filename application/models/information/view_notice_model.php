<?php

class View_notice_model extends CI_Model
{

	var $table = 'info_notice_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	//return a list of minute number for a particular employee
	function get_notice_ids()
	{
		
		$auth_id = $this->db->select('auth_id')->where('id',$this->session->userdata('id'))->get('users');
		$notice_cat = $auth_id->row()->auth_id;
		
		$this->db->select('notice_id');
		$where = "notice_cat = 'all' OR notice_cat = '".$notice_cat."'";
		$this->db->where($where);
		$this->db->order_by('posted_on','asc');
		$query = $this->db->get($this->table);

		return $query->result();
	}
	
	//return a row for a particular notice id
	function get_notice_row($notice_id)
	{
		$this->db->where('notice_id',$notice_id);
		$query = $this->db->get($this->table);
		
		return $query->row();
	}
	
	function get_prev_versions($notice_id)
	{
		$table = 'info_notice_modification_details';
		$this->db->where('notice_id',$notice_id);
		$this->db->order_by('posted_on','desc');
		$query = $this->db->get($table);
		
		return $query->result();
	}
	
	function get_notice_row2($notice_id,$modv)
	{
		$table = 'info_notice_modification_details';
		$this->db->where('notice_id',$notice_id);
		$this->db->where('modification_value',$modv);
		$query = $this->db->get($table);
		
		return $query->row();
	}
	
}

/* End of file view_notice_model.php */
/* Location: mis/application/models/view_notice_model.php */