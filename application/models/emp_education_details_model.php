<?php

class Emp_education_details_model extends CI_Model
{
	var $table = 'emp_education_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}

	function insert_batch($data)
	{
		$this->db->insert_batch($this->table,$data);
	}

	function getEmpEduById($id = '')
	{
		if($id != '')
		{
			$query = $this->db->where('id',$id)->get($this->table);
			if($query->num_rows() == 0)	return FALSE;
			return $query->result();
		}
		else
			return FALSE;
	}

	function delete_record($where_array)
	{
		$this->db->delete($this->table,$where_array);
	}

	function update_record($data,$where_array)
	{
		$this->db->update($this->table,$data,$where_array);
	}
}

/* End of file emp_education_details_model.php */
/* Location: mis/application/models/emp_education_details_model.php */