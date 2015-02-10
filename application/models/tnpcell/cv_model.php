<?php

class Cv_model extends CI_Model
{
	var $table_projects = 'tnp_projects';
  var $table_achievements='tnp_cv_achievements';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function insert_project($project_details)
	{
		$query = $this->db->insert($this->table_projects,$project_details);
		return true;
	}	
  function insert_achievements($cv_details)
	{
    $query= $this->db->insert($this->table_achievements,$cv_details);
    return true;
  }
  function get_projects($user_id)
  {
    $query=$this->db->get_where($this->table_projects, array('user_id'=>$user_id));
    return $query->result();
  }
  function get_achievements($user_id)
  {
    $query=$this->db->get_where($this->table_achievements, array('user_id'=>$user_id));
    return $query->result();
  }
  function update($type, $data)
	{
		if($type==0)  $table= $table_projects;
    else $table= $table_achievements;
    $details = array('place' => $data['place'], 'title' => $data['title'], 'description' => $data['description']);
    $this->db->where($details);
    $this->db->update($table, $data);
    return true;
	}
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */