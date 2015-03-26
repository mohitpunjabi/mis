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

	function get_hod_requests ($status, $dept_id)
	{
		$this->db->where('dept_id',$dept_id);
		$this->db->where('hod_approved_status',$status);
		$query = $this->db->order_by('app_date','asc')->get('edc_registration_details');		
		return $query->result_array();
	}
	
	function get_pce_requests ($status, $dept_id)
	{
		$this->db->where('dept_id',$dept_id);
		$this->db->where('hod_approved_status','Approved');
		$this->db->where('pce_approved_status',$status);
		$query = $this->db->order_by('app_date','asc')->get('edc_registration_details');		
		return $query->result_array();
	}

	function get_booking_details ($app_num)
	{
		$this->db->where('app_num',$app_num);
		$query = $this->db->get('edc_registration_details');
		return $query->result_array();
	}

	function get_guest_details ($app_num)
	{
		$this->db->where('app_num',$app_num);
		$query = $this->db->get('edc_registration_details');
		return $query->result_array();
	}

	function update_hod_action ($app_num, $status, $reason)
	{
		if ($status == "Approved")
			$this->db->query ("UPDATE edc_registration_details SET hod_approved_status= '".$status."', hod_approved_timestamp = now(), pce_approved_status = 'Pending' WHERE app_num = '".$app_num."';");
		else
			$this->db->query ("UPDATE edc_registration_details SET hod_approved_status= '".$status."', hod_approved_timestamp = now(), deny_reason = '".$reason."' WHERE app_num = '".$app_num."';");			
	}

	function update_pce_action ($app_num, $status, $reason)
	{
		if ($status == "Approved")
			$this->db->query ("UPDATE edc_registration_details SET pce_approved_status= '".$status."', pce_approved_timestamp = now() WHERE app_num = '".$app_num."';");
		else
			$this->db->query ("UPDATE edc_registration_details SET pce_approved_status= '".$status."', pce_approved_timestamp = now(), deny_reason = '".$reason."' WHERE app_num = '".$app_num."';");			
	}

	function get_request_user_id ($app_num)
	{
		$this->db->where('app_num',$app_num);
		$query = $this->db->get('edc_registration_details');		
		$user_id = '';
		foreach ($query->result_array() as $row)
			$user_id = $row['user_id'];
		return $user_id;	
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