<?php

class Emp_validation_details_model extends CI_Model
{
	var $table = 'emp_validation_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}

	function updateById($data, $id = '')
	{
		$this->db->update($this->table,$data,array('id'=> $id));
	}

	function getValidationDetailsById($id ='')
	{
		$query = $this->db->where('id',$id)->get($this->table);
		if($query->num_rows() == 0)
			return FALSE;
		else
			return $query->row();
	}
}
/* End of file emp_validation_details_model.php */
/* Location: mis/application/models/emp_validation_details_model.php */