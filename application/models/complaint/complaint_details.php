<?php

class Complaint_details extends CI_Model
{
	var $table = 'complaint';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->query ("INSERT INTO complaint (user_id, type, location, location_details, problem_details, pref_time, complaint_id) VALUES ('".$data['user_id']."','".$data['type']."','".$data['location']."','".$data['location_details']."','".$data['problem_details']."','".$data['pref_time']."','".$data['complaint_id']."');");
	}
	function complaint_list ($status, $supervisor)
	{
		$res = $this->db->query("SELECT * FROM complaint WHERE status = '".$status."' and type='".$supervisor."'ORDER BY date_n_time;");
		return $res;
	}
	function get_complaint_details ($complaint_id)
	{
		$res = $this->db->query("SELECT * FROM complaint WHERE complaint_id = '".$complaint_id."';");
		return $res;		
	}
	function update_complaint ()
	{
		
	}
}
?>

