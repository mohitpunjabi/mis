<?php

class Designations_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function get_designations($where_clause = '')
	{
		if($where_clause !== '' )
			$this->db->where($where_clause,'',FALSE);
		$this->db->order_by('type asc,name asc');
		$query = $this->db->get('designations');
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}

/*	function insert_entry()
	{
		$this->id   = $this->input->post('emp_id');
	        $this->curr_step = 1;

	        $this->db->insert('emp_current_entry', $this);
	}

    function update_entry()
    {
        $this->title   = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date    = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }
*/
}

/* End of file designations_model.php */
/* Location: Codeigniter/application/models/designations_model.php */