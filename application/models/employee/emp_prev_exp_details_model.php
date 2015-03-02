<?php

class Emp_prev_exp_details_model extends CI_Model
{
	var $table = 'emp_prev_exp_details';

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

	function getEmpPrevExpById($id = '',$sno=-1)
	{
		if($sno == -1) {
			$query = $this->db->where('id',$id)->get($this->table);
			return $query->result();
		}else {
			$query = $this->db->where('id',$id)->where('sno',$sno)->get($this->table);
			return $query->row();
		}
	}

	function delete_record($where_array)
	{
		$this->db->delete($this->table,$where_array);
	}

	function update_record($data,$where_array)
	{
		$this->db->update($this->table,$data,$where_array);
	}

	function getPendingDetailsById($id = '',$sno=-1)
	{
		if($sno == -1) {
			$query = $this->db->where('id',$id)->get('pending_'.$this->table);
			return $query->result();
		}else {
			$query = $this->db->where('id',$id)->where('sno',$sno)->get('pending_'.$this->table);
			return $query->row();
		}
	}

	function copyDetailsToPendingById($id='')
	{
		$query = $this->db->where('id',$id)->get($this->table);
		foreach ($query->result() as $row) {
			$this->db->insert('pending_'.$this->table,$row);
		}
	}

	function insertPendingDetails($data)
	{
		$this->db->insert('pending_'.$this->table,$data);
	}

	function updatePendingDetailsWhere($data,$where_array)
	{
		$this->db->update('pending_'.$this->table,$data,$where_array);
	}

	function deletePendingDetailsWhere($where_array)
	{
		$this->db->delete('pending_'.$this->table,$where_array);
	}
}

/* End of file emp_prev_exp_details_model.php */
/* Location: mis/application/models/emp_prev_exp_details_model.php */