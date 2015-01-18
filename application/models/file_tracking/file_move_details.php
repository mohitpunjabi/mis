<?php

class File_move_details extends CI_Model
{
	var $table = 'file_move_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
//		$this->db->insert($this->table,$data);
//		echo "INSERT INTO file_move_details VALUES (".$data['file_id'].",".$data['track_num'].",'".$data['sent_by_emp_id']."',now(),'".$data['rcvd_by_emp_id']."','');";
		$this->db->query("INSERT INTO file_move_details VALUES (".$data['file_id'].",".$data['track_num'].",'".$data['sent_by_emp_id']."',now(),'".$data['rcvd_by_emp_id']."',NULL,0);");
	}
	function change_rcvd_timestamp ($file_id)
	{
//		echo "UPDATE file_move_details SET rcvd_timestamp = now() WHERE file_id=".$file_id." AND rcvd_timestamp='';";
		$this->db->query("UPDATE file_move_details SET rcvd_timestamp = now() WHERE file_id=".$file_id." AND ISNULL(rcvd_timestamp);");
	}
	function get_pending_files($emp_id)
	{
		$res = $this->db->query("SELECT salutation, first_name, middle_name, last_name, file_move_details.sent_by_emp_id AS sent_by_emp_id, file_move_details.file_id AS file_id, file_subject FROM file_move_details, file_details, user_details WHERE file_move_details.file_id=file_basic_details.file_id AND user_details.id=file_move_details.sent_by_emp_id AND rcvd_by_emp_id =  '".$emp_id."' AND rcvd_status = 0 AND rcvd_timestamp IS NOT NULL;");
		return $res;
	}
	function change_rcvd_status ($file_id)
	{
		$this->db->query ("UPDATE file_move_details SET rcvd_status=1 WHERE file_id=".$file_id." AND rcvd_status=0;");
	}
	function get_move_details ($file_id)
	{
		$res = $this->db->query("SELECT * FROM file_move_details WHERE file_id = ".$file_id.";");
		return $res;
	}
	/*function get_faculty_by_id($emp_id)
	{
		$result = $this->db->query("SELECT salutation,first_name,middle_name,last_name FROM user_details WHERE id='.$emp_id.';");
		$name =  $result->row_array();
		return $name['salutation']+' '+$name['first_name']+' '+$name['middle_name']+' '+$name['last_name'];
	}*/
	function files_to_be_tracked($emp_id){
		$res = $this->db->query("SELECT salutation, first_name, middle_name, last_name, file_move_details.rcvd_by_emp_id AS rcvd_by_emp_id, file_move_details.file_id AS file_id, file_move_details.track_num AS track_num, file_subject FROM file_move_details, file_details, user_details WHERE file_move_details.file_id=file_basic_details.file_id AND user_details.id=rcvd_by_emp_id AND sent_by_emp_id =  '".$emp_id."' AND rcvd_status = 0 AND rcvd_timestamp IS NULL;");
		return $res;
	}
}


