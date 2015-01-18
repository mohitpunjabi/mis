<?php

class Search_prev_minute_model extends CI_Model
{

	var $table = 'info_minute_modification_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	//return a list of minute number for a particular employee
	function get_minute_ids()
	{
		$this->db->distinct();
		$this->db->select('minutes_id');
		$this->db->where('issued_by', $this->session->userdata('id'));
		$query = $this->db->get($this->table);

		return $query->result();
	}
	
	//return a row for a particular minute id
	function get_minute_row($minute_id,$modv)
	{
		$this->db->where('minutes_id',$minute_id);
		$this->db->where('modification_value',$modv);
		$query = $this->db->get($this->table);
		
		return $query->row();
	}
	
	function get_prev_versions($minute_id)
	{
		$this->db->where('minutes_id',$minute_id);
		$query = $this->db->get($this->table);
		
		return $query->result();
	}
}

/* End of file search_prev_minute_model.php */
/* Location: mis/application/models/search_prev_minute_model.php */