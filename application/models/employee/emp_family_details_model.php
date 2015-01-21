<?php

class Emp_family_details_model extends CI_Model
{
	var $table = 'emp_family_details';

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

	function getEmpFamById($id = '')
	{
		$query = $this->db->where('id',$id)->get($this->table);
		return $query->result();
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

/* End of file emp_family_details_model.php */
/* Location: mis/application/models/emp_family_details_model.php */