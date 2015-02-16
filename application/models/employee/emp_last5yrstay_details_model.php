<?php

class Emp_last5yrstay_details_model extends CI_Model
{
	var $table = 'emp_last5yrstay_details';

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

	function getEmpStayById($id = '',$sno=-1)
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
}

/* End of file emp_last5yrstay_details_model.php */
/* Location: mis/application/models/emp_last5yrstay_details_model.php */