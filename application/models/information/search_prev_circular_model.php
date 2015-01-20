<?php

class Search_prev_circular_model extends CI_Model
{

	var $table = 'info_circular_modification_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	//return a list of minute number for a particular employee
	function get_circular_ids()
	{
		$this->db->distinct();
		$this->db->select('circular_id');
		$this->db->where('issued_by', $this->session->userdata('id'));
		$query = $this->db->get($this->table);

		return $query->result();
	}
	
	//return a row for a particular circular id
	function get_circular_row($circular_id,$modv)
	{
		$this->db->where('circular_id',$circular_id);
		$this->db->where('modification_value',$modv);
		$query = $this->db->get($this->table);
		
		return $query->row();
	}
	
	function get_prev_versions($circular_id)
	{
		$this->db->where('circular_id',$circular_id);
		$query = $this->db->get($this->table);
		
		return $query->result();
	}
}

/* End of file search_prev_circular_model.php */
/* Location: mis/application/models/search_prev_circular_model.php */