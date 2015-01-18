<?php

class Faculty_details_model extends CI_Model
{

	var $table = 'faculty_details';
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}

	function updateById($data,$id)
	{
		$this->db->update($this->table,$data,array('id'=>$id));
	}

	function getFacultyByID($id = '')
	{
		if($id != '')
		{
			$query = $this->db->where('id="'.$id.'"','',FALSE)->get($this->table);
			if($query->num_rows() === 1)
				return $query->row();
			else
				return FALSE;
		}
		else
			return FALSE;
	}
}

/* End of file faculty_details_model.php */
/* Location: mis/application/models/faculty_details_model.php */