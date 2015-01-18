<?php

class Search_prev_notice_model extends CI_Model
{

	var $table = 'info_notice_modification_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	//return a list of minute number for a particular employee
	function get_notice_ids()
	{
		$this->db->distinct();
		$this->db->select('notice_id');
		$this->db->where('issued_by', $this->session->userdata('id'));
		$query = $this->db->get($this->table);

		return $query->result();
	}
	
	//return a row for a particular notice id
	function get_notice_row($notice_id,$modv)
	{
		$this->db->where('notice_id',$notice_id);
		$this->db->where('modification_value',$modv);
		$query = $this->db->get($this->table);
		
		return $query->row();
	}
	
	function get_prev_versions($notice_id)
	{
		$this->db->where('notice_id',$notice_id);
		$query = $this->db->get($this->table);
		
		return $query->result();
	}
}

/* End of file search_prev_notice_model.php */
/* Location: mis/application/models/search_prev_notice_model.php */