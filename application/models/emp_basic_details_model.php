<?php

class Emp_basic_details_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert('emp_basic_details',$data);
	}

	function getbyID($id = '')
	{
		if($id != '')
		{
			$query = $this->db->where('id="'.$id.'"','',FALSE)->get('emp_basic_details');
			if($query->num_rows() === 1)
				return $query->row();
			else
				return FALSE;
		}
		else
			return FALSE;
	}
}

/* End of file emp_basic_details_model.php */
/* Location: mis/application/models/emp_basic_details_model.php */