<?php

class Designations_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function get_designations($where_clause = '')
	{
		if($where_clause !== '' )
			$this->db->where($where_clause,'',FALSE);
		$this->db->order_by('type asc,name asc');
		$query = $this->db->get('designations');
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}

}

/* End of file designations_model.php */
/* Location: mis/application/models/designations_model.php */