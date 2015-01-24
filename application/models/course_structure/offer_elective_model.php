<?php

class Offer_elective_model extends CI_Model
{
var $table_elective_group = 'elective_group';
	var $table_elective_offered = 'elective_offered';
	
	function __construct()
	{
		// Calling the Model parent constructor
		parent::__construct();
	}	
	
	function get_branch_by_dept_course_session($dept,$course,$session){
		$query = $this->db->query("SELECT * from dept_course where dept_id='".$dept."' AND aggr_id REGEXP '^".$course.".*".$session."$'");
		return $query->result();
	}
	
	function insert_elective_offered($data)
	{
    	return $this->db->insert($this->table_elective_offered,$data);
    	return $this->db->_error_message(); 
	}
	
	function select_elective_offered_by_aggr_id($aggr_id)
	{
		$query = $this->db->get_where($this->table_elective_offered,array('aggr_id'=>$aggr_id));
    	if($query->num_rows() > 0)
			return true;	
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/course_structure/menu_model.php */