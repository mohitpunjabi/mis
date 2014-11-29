<?php

class Departments_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function get_departments($type = '')
	{
		if($type !== '')
		{
			$this->db->select('id, name')
					 ->where('type="'.$type.'"','',FALSE)
					 ->order_by('name');
			$query = $this->db->get('departments');
			if($query->num_rows() > 0)
				return $query->result();
			else
				return FALSE;
		}
		else
		{
			$query = $this->db->get('departments');
			if($query->num_rows() > 0)
				return $query->result();
			else
				return FALSE;
		}
	}

}

/* End of file departments_model.php */
/* Location: mis/application/models/departments_model.php */