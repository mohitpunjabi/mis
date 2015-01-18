<?php

class Edit_notice_model extends CI_Model
{

	var $table = 'info_notice_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function update($data)
	{
		$this->db->where('notice_id',$data['notice_id']);
		$this->db->update($this->table,$data);
	}
	
	function getnoticesByMinId($notice_id)
	{
		$query=$this->db->where('notice_id',$notice_id)->get($this->table);
		if($query->num_rows()==0)	return FALSE;
		else	return $query->row();
	}
	
	function insertM($notice_id)
	{
		$table = 'info_notice_modification_details';
		$query = $this->db->where('notice_id',$notice_id)->get($this->table);
		
		if($query->num_rows() == 0 ) return FALSE;
		else $ans = $query->row_array();
		
		$this->db->insert($table, $ans);
	}
	
}

/* End of file edit_notice_model.php */
/* Location: mis/application/models/edit_notice_model.php */