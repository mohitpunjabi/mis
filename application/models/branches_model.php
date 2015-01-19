<?php

Class Branches_model extends CI_Model
{
	var $table = 'branches';

	function __construct()
	{
		parent::__construct();
	}

	function get_branches_by_department($dept_id = '')
	{
		$this->db->select('id, name')
				 ->where('dept_id="'.$dept_id.'"','',FALSE);
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}
}

?>