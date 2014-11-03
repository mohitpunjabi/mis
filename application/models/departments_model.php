<?php

class Departments_model extends CI_Model
{

	var $id;
	var $name;
	var $type;

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

	function insert_entry()
	{
		$this->id = $this->input->post('dept_id');
		$this->name = $this->input->post('dept_name');
		$this->type = $this->input->post('dept_type');

		$this->db->insert('departments', $this);
	}
}

/* End of file departments_model.php */
/* Location: Codeigniter/application/models/departments_model.php */