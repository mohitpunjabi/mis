<?php

Class Student_fee_details_model extends CI_Model
{
	var $table = 'stu_fee_details';

	function __construct()
	{
		parent::__construct();
	}

	function insert($data)
	{
		$query = $this->db->insert($this->table,$data);
	}

	function get_stu_fee_details_by_id($stu_id = '')
	{
		if($stu_id != '')
		{
			$query = $this->db->where('id="'.$stu_id.'"','',FALSE)->get($this->table);
			if($query->num_rows() === 1)
				return $query->row();
			else
				return FALSE;
		}
		else
			return FALSE;
	}
}

?>