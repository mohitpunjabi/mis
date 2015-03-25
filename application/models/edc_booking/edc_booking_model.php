<?php

class Edc_booking_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function insert_guest_details ($data)
	{
		$this->db->insert('edc_guest_details',$data);
	}
	
	function insert_edc_registration_details ($data)
	{
		$this->db->insert('edc_registration_details',$data);
	}

	function get_pending_requests ($dept_id)
	{
		$this->db->where('dept_id',$dept_id);
		$this->db->where('hod_approved_status','Pending');
		$query = $this->db->order_by('app_date','asc')->get('edc_registration_details');
		
		return $query->result_array();
	}
	
/*	function is_there_any_application_for_user($user_id)
	{
		$this->db->where('user_id',$user_id);
		$this->db->where('app_status','Pending');
		$query = $this->db->select('app_num')
						  ->from('sah_application')
						  ->get();
		$appnum = $query->result_array();
		if (count($appnum) == 0)
			return 0;
		else
			return 1;
	}
	
	function get_all_applications_with_checkin_today_onwards($user_id)
	{
		$this->db->where('user_id',$user_id);
		$this->db->where('check_in >',date("Y-m-d",strtotime(date("Y-m-d"))+19800-86400));
		$query = $this->db->order_by('app_date','asc')->get('sah_application');
		
		return $query->result_array();
	}
	
	function get_all_guests_for_a_application($app_num)
	{
		$this->db->where('app_num',$app_num);
		$query = $this->db->order_by('gname','asc')->get('sah_guest');
		
		return $query->result_array();
	}	
*/	
}