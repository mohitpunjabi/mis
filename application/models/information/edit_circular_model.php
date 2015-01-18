<?php

class Edit_circular_model extends CI_Model
{

	var $table = 'info_circular_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function update($data)
	{
		$this->db->where('circular_id',$data['circular_id']);
		$this->db->update($this->table,$data);
	}
	
	function getCircularsByMinId($circular_id)
	{
		$query=$this->db->where('circular_id',$circular_id)->get($this->table);
		if($query->num_rows()==0)	return FALSE;
		else	return $query->row();
	}
	
	function insertM($circular_id)
	{
		$table = 'info_circular_modification_details';
		$query = $this->db->where('circular_id',$circular_id)->get($this->table);
		
		if($query->num_rows() == 0 ) return FALSE;
		else $ans = $query->row_array();
		
		$this->db->insert($table, $ans);
	}
}

/* End of file edit_circular_model.php */
/* Location: mis/application/models/edit_circular_model.php */