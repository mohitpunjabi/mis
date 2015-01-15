<?php

class Stu_current_entry_model extends CI_Model
{
	var $table = 'stu_current_entry';

	function __construct()
	{
		parent::__construct();
	}

	function get_current_entry()
	{
		$query = $this->db->get($this->table);
		if($query->num_rows() === 1)
			return $query->row();
		else
			return FALSE;
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}

	function update($data, $where)
	{
		$this->db->update($this->table,$data,$where);
	}

	function delete($data)
	{
		$this->db->delete($this->table,$where);
	}
}