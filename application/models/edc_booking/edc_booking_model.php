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
		$this->db->query ("UPDATE edc_guest_details SET check_in = now() WHERE app_num = '".$data['app_num']."';");

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
			$this->db->query ("UPDATE edc_registration_details SET hod_status= '".$status."', hod_action_timestamp = now(), pce_to_ctk_status = 'Pending' WHERE app_num = '".$app_num."';");
		else
			$this->db->query ("UPDATE edc_registration_details SET hod_status= '".$status."', hod_action_timestamp = now(), deny_reason = '".$reason."' WHERE app_num = '".$app_num."';");
	}

	function update_pce_action ($app_num, $status, $reason)
	{
		if ($status == "Approved")
			$this->db->query ("UPDATE edc_registration_details SET pce_to_ctk_status= '".$status."', pce_to_ctk_timestamp = now() WHERE app_num = '".$app_num."';");
		else
			$this->db->query ("UPDATE edc_registration_details SET pce_to_ctk_status= '".$status."', pce_to_ctk_timestamp = now(), deny_reason = '".$reason."' WHERE app_num = '".$app_num."';");
	}
	function update_pce_final_action($app_num, $status, $reason)
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
			$this->db->where('pce_status','Approved');
			$query = $this->db->order_by('app_date','desc')->get('edc_registration_details');
			return $query->result_array();
		}
		else {
			$this->db->where('user_id',$user_id);
			$where = "hod_status = 'Rejected' OR pce_status = 'Rejected'";
			$this->db->where($where);
			$query = $this->db->get('edc_registration_details');
			return $query->result_array();
		}
	}
	function get_alloted_application()
	{
		$where = "ctk_allotment_status = '1' AND check_in >=now()";
		$this->db->where($where);
		$query = $this->db->get('edc_registration_details');
		return $query->result();
	}
	function get_rooms_for_application($app_num)
	{
		$query = "SELECT id,edc_room_details.building as building,edc_room_details.floor as floor,edc_room_details.room_no as room_no FROM edc_booking_details inner join edc_room_details on edc_booking_details.room_id=edc_room_details.id WHERE edc_booking_details.app_num = '".$app_num."'";
		$quer = $this->db->query($query);
		return $quer->result();
	}
	function get_guest_detail($app_num)
	{
		$query = "SELECT * FROM  edc_guest_details WHERE  app_num = '".$app_num."'";
		$quer = $this->db->query($query);
		return $quer->result();

	}
	function checkout($app_num,$room_allocated)
	{
		$this->db->query ("UPDATE edc_guest_details SET check_out = now() WHERE app_num = '".$app_num."' AND room_alloted = '".$room_allocated."';");

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
