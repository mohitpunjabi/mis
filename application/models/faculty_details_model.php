<?php

class Faculty_details_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert('faculty_details',$data);
	}
}

/* End of file faculty_details_model.php */
/* Location: mis/application/models/faculty_details_model.php */