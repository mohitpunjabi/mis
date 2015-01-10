<?php

class Emp_current_entry_model extends CI_Model
{
	var $id = '';
	var $curr_step = '';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function get_current_entry()
	{
		$query = $this->db->get('emp_current_entry');
		if($query->num_rows() > 0)
	        	return $query->row();
		else
			return FALSE;
	}

	function insert_entry()
	{
		$this->id   = $this->input->post('emp_id');
	        $this->curr_step = 1;

	        $this->db->insert('emp_current_entry', $this);
	}
/*
    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }
*/
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */