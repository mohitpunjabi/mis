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
		$this->db->where('hod_status',$status);
		$this->db->join('user_details', 'user_details.id = edc_registration_details.user_id');
		$query = $this->db->order_by('app_date','asc')->get('edc_registration_details');		
		return $query->result_array();
	}
	
	function get_pce_requests ($status, $dept_id)
	{
		$this->db->where('dept_id',$dept_id);
		$this->db->where('pce_status',$status);
		$this->db->join('user_details', 'user_details.id = edc_registration_details.user_id');
		$query = $this->db->order_by('app_date','asc')->get('edc_registration_details');		
		return $query->result_array();
	}

	function get_dsw_requests ($status, $dept_id)
	{
		$this->db->where('dept_id',$dept_id);
		$this->db->where('dsw_status',$status);
		$this->db->join('user_details', 'user_details.id = edc_registration_details.user_id');
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
		$query = $this->db->get('edc_guest_details');
		return $query->result_array();
	}

	function get_building ()
	{
		$this->db->where('app_num',NULL);
		$query = $this->db->get('edc_room_details');
		return $query->result_array();		
	}

	function get_floor ($building)
	{

	}

	function get_room ($building, $floor)
	{

	}

	function update_hod_action ($app_num, $status, $reason)
	{
		if ($status == "Approved")
			$this->db->query ("UPDATE edc_registration_details SET hod_status= '".$status."', hod_action_timestamp = now(), pce_status = 'Pending' WHERE app_num = '".$app_num."';");
		else
			$this->db->query ("UPDATE edc_registration_details SET hod_status= '".$status."', hod_action_timestamp = now(), deny_reason = '".$reason."' WHERE app_num = '".$app_num."';");			
	}

	function update_pce_action ($app_num, $status, $reason)
	{
		if ($status == "Approved")
			$this->db->query ("UPDATE edc_registration_details SET pce_status= '".$status."', pce_action_timestamp = now() WHERE app_num = '".$app_num."';");
		else
			$this->db->query ("UPDATE edc_registration_details SET pce_status= '".$status."', pce_action_timestamp = now(), deny_reason = '".$reason."' WHERE app_num = '".$app_num."';");			
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

	function get_pending_booking_details ($user_id)
	{
		$this->db->where('user_id',$user_id);
		$where = "hod_status = 'Pending' OR pce_status = 'Pending' OR dsw_status = 'Pending'";
		$this->db->where($where);
		$query = $this->db->get('edc_registration_details');
		
		return $query->result_array();
	}

	function get_booking_history ($user_id, $status)
	{
		if ($status == "Approved") {
			$this->db->where('user_id',$user_id);
			$this->db->where('pce_approved_status','Approved');
			$query = $this->db->order_by('app_date','desc')->get('edc_registration_details');
			return $query->result_array();					
		}
		else {
			$this->db->where('user_id',$user_id);
			$where = "hod_approved_status = 'Rejected' OR pce_approved_status = 'Rejected'";
			$this->db->where($where);
			$query = $this->db->get('edc_registration_details');
			return $query->result_array();			
		}
	}
/*		
	function get_all_guests_for_a_application($app_num)
	{
		$this->db->where('app_num',$app_num);
		$query = $this->db->order_by('gname','asc')->get('sah_guest');
		
		return $query->result_array();
	}	
*/	
}