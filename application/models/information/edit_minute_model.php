<?php

class Edit_minute_model extends CI_Model
{

	var $table = 'info_minute_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function update($data)
	{
		$this->db->where('minutes_id',$data['minutes_id']);
		$this->db->update($this->table,$data);
	}
	
	function getMinutesByMinId($min_id)
	{
		$query=$this->db->where('minutes_id',$min_id)->get($this->table);
		if($query->num_rows()==0)	return FALSE;
		else	return $query->row();
	}
	
	function insertM($minute_id)
	{
		$table = 'info_minute_modification_details';
		$query = $this->db->where('minutes_id',$minute_id)->get($this->table);
		
		if($query->num_rows() == 0 ) return FALSE;
		else $ans = $query->row_array();
		
		$this->db->insert($table, $ans);
	}
	
}

/* End of file edit_minute_model.php */
/* Location: mis/application/models/edit_minute_model.php */