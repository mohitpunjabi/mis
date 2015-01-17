<?php

class Emp_pay_details_model extends CI_Model
{
	var $table = 'emp_pay_details';
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

	function getEmpPayDetailsbyId($emp_id = '')
	{
		$query = $this->db->select('emp_pay_details.pay_code, pay_band, pay_band_description, grade_pay, basic_pay')
							->from($this->table)
							->join('pay_scales','emp_pay_details.pay_code = pay_scales.pay_code')
							->where('id',$emp_id)
							->get();
		if($query->num_rows() == 1)
			return $query->row();
		else
			return FALSE;
	}
}

/* End of file emp_pay_details_model.php */
/* Location: mis/application/models/emp_pay_details_model.php */