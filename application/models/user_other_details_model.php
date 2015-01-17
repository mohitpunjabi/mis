<?php

class User_other_details_model extends CI_Model
{

	var $table = 'user_other_details';
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

	function getUserById($id = '')
	{
		if($id == '')
			return FALSE;
		else
		{
			$query=$this->db->where('id',$id)->get($this->table);
			if($query->num_rows() ==1 )	return $query->row();
			return FALSE;
		}
	}
}

/* End of file user_other_details_model.php */
/* Location: mis/application/models/user_other_details_model.php */