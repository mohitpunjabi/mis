<?php

class User_details_model extends CI_Model
{

	var $table = 'user_details';
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

	function getEmpNamesByDept($dept = '')
	{
		if($dept == '')
			return FALSE;
		else
		{
//			$query=$this->db->query("select id,first_name,last_name,auth_id from user_details natural join users where dept_id='".$dept."' and auth_id='emp'");
			$query=$this->db->select('users.id, salutation, first_name, last_name, dept_id')
								->from('user_details')
								->join('users','users.id = user_details.id')
								->where('dept_id',$dept)
								->where('auth_id','emp')
								->get();
			if($query->num_rows() == 0)	return FALSE;
			return $query->result();
		}
	}
}

/* End of file user_details_model.php */
/* Location: mis/application/models/user_details_model.php */