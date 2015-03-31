<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking_request extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod','pce','dsw','edc_ctk'));
	}

	public function details ($app_num, $auth)
	{
		$this->load->model ('edc_booking/edc_booking_model', '', TRUE);
		$res = $this->edc_booking_model->get_booking_details($app_num);

		$this->load->model('user_model', '', TRUE);

		$data = array();
		foreach ($res as $row)
		{
			$data['app_num'] = $row['app_num'];
			$data['app_date'] = date('j M Y g:i A', strtotime($row['app_date']));
			$data['user'] = $this->user_model->getNameById($row['user_id']);
			$data['purpose'] = $row['purpose'];
			$data['purpose_of_visit'] = $row['purpose_of_visit'];
			$data['name'] = $row['name'];
			$data['designation'] = $row['designation'];
			$data['check_in'] = $row['check_in'];
			$data['check_out'] = $row['check_out'];
			$data['no_of_guests'] = $row['no_of_guests'];
			$data['single_AC'] = $row['single_AC'];
			$data['double_AC'] = $row['double_AC'];
			$data['suite_AC'] = $row['suite_AC'];
			$data['school_guest'] = $row['school_guest'];
			$data['file_path'] = $row['file_path'];

			$data['hod_status'] = $row['hod_status'];
			$data['hod_action_timestamp'] = $row['hod_action_timestamp'];
			$data['dsw_status'] = $row['dsw_status'];
			$data['dsw_action_timestamp'] = $row['dsw_action_timestamp'];
			$data['pce_status'] = $row['pce_status'];
			$data['pce_action_timestamp'] = $row['pce_action_timestamp'];
			$data['deny_reason'] = $row['deny_reason'];
		}

		$data['auth'] = $auth;
 		$this->drawHeader ("Booking Details");
 		if ($auth == 'ft' || $auth == 'stu')
 			$this->load->view('edc_booking/booking_details_user', $data);
 		else if ($auth=='ctk')
 			$this->load->view('edc_booking/booking_details_ctk', $data);
 		else
			$this->load->view('edc_booking/booking_details',$data);
		$this->drawFooter();
	}

	function hod()
	{
		$this->load->model('edc_booking/edc_booking_model');
		$this->load->model('user_model');

		$res = $this->edc_booking_model->get_hod_requests ("Pending", $this->session->userdata('dept_id'));
		$total_rows_pending = count($res);
		$data_array_pending = array();
		$sno = 1;
		foreach ($res as $row)
		{
			$data_array_pending[$sno]=array();
			$j=1;
			$data_array_pending[$sno][$j++] = $row['app_num'];
			$data_array_pending[$sno][$j++] = date('j M Y g:i A', strtotime($row['app_date']));
			$data_array_pending[$sno][$j++] = $this->user_model->getNameById($row['user_id']);
			$data_array_pending[$sno][$j++] = $row['no_of_guests'];
			$sno++;
		}

		$res = $this->edc_booking_model->get_hod_requests ("Approved", $this->session->userdata('dept_id'));
		$total_rows_approved = count($res);
		$data_array_approved = array();
		$sno = 1;
		foreach ($res as $row)
		{
			$data_array_approved[$sno]=array();
			$j=1;
			$data_array_approved[$sno][$j++] = $row['app_num'];
			$data_array_approved[$sno][$j++] = date('j M Y g:i A', strtotime($row['app_date']));
			$data_array_approved[$sno][$j++] = $this->user_model->getNameById($row['user_id']);
			$data_array_approved[$sno][$j++] = $row['no_of_guests'];
			$sno++;
		}

		$res = $this->edc_booking_model->get_hod_requests ("Rejected", $this->session->userdata('dept_id'));
		$total_rows_rejected = count($res);
		$data_array_rejected = array();
		$sno = 1;
		foreach ($res as $row)
		{
			$data_array_rejected[$sno]=array();
			$j=1;
			$data_array_rejected[$sno][$j++] = $row['app_num'];
			$data_array_rejected[$sno][$j++] = date('j M Y g:i A', strtotime($row['app_date']));
			$data_array_rejected[$sno][$j++] = $this->user_model->getNameById($row['user_id']);
			$data_array_rejected[$sno][$j++] = $row['no_of_guests'];
			$sno++;
		}

		$data['data_array_pending'] = $data_array_pending;
		$data['total_rows_pending'] = $total_rows_pending;
		$data['data_array_approved'] = $data_array_approved;
		$data['total_rows_approved'] = $total_rows_approved;
		$data['data_array_rejected'] = $data_array_rejected;
		$data['total_rows_rejected'] = $total_rows_rejected;

		$this->drawHeader('Executive Development Center');
		$this->load->view('edc_booking/view_hod_requests',$data);
		$this->drawFooter();
	}

	function dsw ()
	{

	}

	function pce()
	{
		$this->load->model('edc_booking/edc_booking_model');
		$this->load->model('user_model');

		$res = $this->edc_booking_model->get_pce_requests ("Pending", $this->session->userdata('dept_id'));
		$total_rows_pending = count($res);
		$data_array_pending = array();
		$sno = 1;
		foreach ($res as $row)
		{
			$data_array_pending[$sno]=array();
			$j=1;
			$data_array_pending[$sno][$j++] = $row['app_num'];
			$data_array_pending[$sno][$j++] = date('j M Y g:i A', strtotime($row['app_date']));
			$data_array_pending[$sno][$j++] = $this->user_model->getNameById($row['user_id']);
			$data_array_pending[$sno][$j++] = $row['no_of_guests'];
			$sno++;
		}

		$res = $this->edc_booking_model->get_pce_requests ("Approved", $this->session->userdata('dept_id'));
		$total_rows_approved = count($res);
		$data_array_approved = array();
		$sno = 1;
		foreach ($res as $row)
		{
			$data_array_approved[$sno]=array();
			$j=1;
			$data_array_approved[$sno][$j++] = $row['app_num'];
			$data_array_approved[$sno][$j++] = date('j M Y g:i A', strtotime($row['app_date']));
			$data_array_approved[$sno][$j++] = $this->user_model->getNameById($row['user_id']);
			$data_array_approved[$sno][$j++] = $row['no_of_guests'];
			$sno++;
		}

		$res = $this->edc_booking_model->get_pce_requests ("Rejected", $this->session->userdata('dept_id'));
		$total_rows_rejected = count($res);
		$data_array_rejected = array();
		$sno = 1;
		foreach ($res as $row)
		{
			$data_array_rejected[$sno]=array();
			$j=1;
			$data_array_rejected[$sno][$j++] = $row['app_num'];
			$data_array_rejected[$sno][$j++] = date('j M Y g:i A', strtotime($row['app_date']));
			$data_array_rejected[$sno][$j++] = $this->user_model->getNameById($row['user_id']);
			$data_array_rejected[$sno][$j++] = $row['no_of_guests'];
			$sno++;
		}

		$data['data_array_pending'] = $data_array_pending;
		$data['total_rows_pending'] = $total_rows_pending;
		$data['data_array_approved'] = $data_array_approved;
		$data['total_rows_approved'] = $total_rows_approved;
		$data['data_array_rejected'] = $data_array_rejected;
		$data['total_rows_rejected'] = $total_rows_rejected;

		$this->drawHeader('Executive Development Center');
		$this->load->view('edc_booking/view_pce_requests',$data);
		$this->drawFooter();
	}

	function hod_action ($app_num)
	{
			$status = $this->input->post ('status');
			$reason = $this->input->post ('reason');

			if ($status == "Approved")
				$reason = "NULL";

			$this->load->model ('edc_booking/edc_booking_model');
			$this->edc_booking_model->update_hod_action ($app_num, $status, $reason);

			$this->load->model ('user_model');
			$res = $this->user_model->getUsersByDeptAuth('all', 'pce');
			$pce = '';
			foreach ($res as $row)
				$pce = $row->id;

			$user_id = $this->edc_booking_model->get_request_user_id ($app_num);
			if ($status == "Approved")
				$this->notification->notify ($pce, "pce", "Approve/Reject Pending Request", "EDC Room Booking Request (Application No. : ".$app_num." ) is Pending for your approval.", "edc_booking/booking_request/details/".$app_num."/pce", "");
			else //Rejected -> Notify to User
				$this->notification->notify ($user_id, "ft", "EDC Room Allotment Request", "Your Request for EDC Room Allotment (Application No. : ".$app_num." ) has been Rejected by HOD.", "edc_booking/booking/track_status/".$app_num, "");

			$this->session->set_flashdata('flashSuccess','Room Allotment request has been successfully '.$status.'.');
			redirect('edc_booking/booking_request/hod');
	}

	function dsw_action ($app_num)
	{

	}

	function pce_action ($app_num)
	{
			$status = $this->input->post ('status');
			$reason = $this->input->post ('reason');

			if ($status == "Approved")
				$reason = "NULL";

			$this->load->model ('edc_booking/edc_booking_model');
			$this->edc_booking_model->update_pce_action ($app_num, $status, $reason);

			$this->load->model ('user_model');
			$res = $this->user_model->getUsersByDeptAuth('all', 'edc_ctk');
			$edc_booking = '';
			foreach ($res as $row)
				$edc_ctk = $row->id;


			$user_id = $this->edc_booking_model->get_request_user_id ($app_num);
			if ($status == "Approved")
				$this->notification->notify ($edc_ctk, "edc_ctk", "EDC Room Allotment Request", "Allot room for (Application No. : ".$app_num." )", "edc_booking/booking_request/details/".$app_num."/ctk", "");
			else {
				$this->notification->notify ($user_id, "ft", "EDC Room Allotment Request", "Your Request for EDC Room Allotment (Application No. : ".$app_num." ) has been Rejected by PCE.", "edc_booking/booking/track_status/".$app_num, "");

				$this->load->model ('user_model');
				$res = $this->user_model->getUsersByDeptAuth($this->session->userdata('dept_id'), 'hod');
				$hod = '';
				foreach ($res as $row)
					$hod = $row->id;
				$this->notification->notify ($hod, "hod", "EDC Room Allotment Request", "Your Request for EDC Room Allotment (Application No. : ".$app_num." ) is has been Rejected by PCE.", "edc_booking/booking_request/details/".$app_num."/hod", "");
			}

			$this->session->set_flashdata('flashSuccess','Room Allotment request has been successfully '.$status.'.');
			redirect('edc_booking/booking_request/pce');
	}
	public function details_final ($app_num, $auth)
	{
		$this->load->model ('edc_booking/edc_booking_model', '', TRUE);
		$res = $this->edc_booking_model->get_booking_details($app_num);

		$this->load->model('edc_booking/edc_allotment_model');
		$allocated_rooms = $this->edc_allotment_model->get_allocated_room_detail($app_num);

		$this->load->model('user_model', '', TRUE);

		$data = array();
		$count=0;
		//print_r($allocated_rooms);
		foreach($allocated_rooms as $row)
		{
			$data['room_array'][$count++] = $this->edc_allotment_model->get_room_details($row['room_id']);
		}
		foreach ($res as $row)
		{
			$data['app_num'] = $row['app_num'];
			$data['app_date'] = date('j M Y g:i A', strtotime($row['app_date']));
			$data['user'] = $this->user_model->getNameById($row['user_id']);
			$data['purpose'] = $row['purpose'];
			$data['purpose_of_visit'] = $row['purpose_of_visit'];
			$data['name'] = $row['name'];
			$data['designation'] = $row['designation'];
			$data['check_in'] = $row['check_in'];
			$data['check_out'] = $row['check_out'];
			$data['no_of_guests'] = $row['no_of_guests'];
			$data['single_AC'] = $row['single_AC'];
			$data['double_AC'] = $row['double_AC'];
			$data['suite_AC'] = $row['suite_AC'];
			$data['school_guest'] = $row['school_guest'];
			$data['file_path'] = $row['file_path'];

			$data['hod_status'] = $row['hod_status'];
			$data['hod_action_timestamp'] = $row['hod_action_timestamp'];
			$data['dsw_status'] = $row['dsw_status'];
			$data['dsw_action_timestamp'] = $row['dsw_action_timestamp'];
			$data['pce_status'] = $row['pce_status'];
			$data['pce_action_timestamp'] = $row['pce_action_timestamp'];
			$data['deny_reason'] = $row['deny_reason'];
		}
		$data['auth'] = $auth;
 		$this->drawHeader ("Booking Details");
 		//if ($auth == 'ft' || $auth == 'stu')
 		//	$this->load->view('edc_booking/booking_details_user', $data);
 		//else if ($auth=='ctk')
 		//	$this->load->view('edc_booking/booking_details_ctk', $data);
		if ($auth == 'pce')
			$this->load->view('edc_booking/final_booking_details',$data);
		$this->drawFooter();
	}
	function pce_final_action ($app_num)
	{
			$status = $this->input->post ('status');
			$reason = $this->input->post ('reason');

			if ($status == "Approved")
				$reason = "NULL";

			$this->load->model ('edc_booking/edc_booking_model');
			$this->load->model ('edc_booking/edc_allotment_model');

			$this->edc_booking_model->update_pce_final_action ($app_num, $status, $reason);

			$total = $this->edc_allotment_model->get_allocated_rooms($app_num);
			//echo $total;
			$res = $this->edc_allotment_model->get_app_details($app_num);
			//print_r($res);
			foreach($res as $row)
			{
				$single_AC = $row['single_AC'];
				$double_AC = $row['double_AC'];
				$suite_AC = $row['suite_AC'];
			}
			$limit = $total - $single_AC - $double_AC - $suite_AC;
			//echo $limit;

			$this->edc_allotment_model->delete_room_detail($app_num,$limit,$status);
			$this->load->model ('user_model');
			$res = $this->user_model->getUsersByDeptAuth('all', 'edc_ctk');
			$edc_booking = '';
			foreach ($res as $row)
				$edc_ctk = $row->id;


			$user_id = $this->edc_booking_model->get_request_user_id ($app_num);
			if ($status == "Approved")
			{
				$this->db->query ("UPDATE edc_registration_details SET allocation_confirm_status = 1 WHERE app_num = '".$app_num."';");
				$this->notification->notify ($user_id, "ft", "EDC Room Allotment Request", "Allot room for (Application No. : ".$app_num." )", "edc_booking/booking_request/details/".$app_num."/ft", "");
			}
			else
			{
				$this->notification->notify ($edc_ctk, "edc_ctk", "EDC Room Allotment Request Was Cancelled by PCE.", "Allot room for (Application No. : ".$app_num." )", "edc_booking/booking_request/details/".$app_num."/ctk", "");

				/*$this->load->model ('user_model');
				$res = $this->user_model->getUsersByDeptAuth($this->session->userdata('dept_id'), 'hod');
				$hod = '';
				foreach ($res as $row)
					$hod = $row->id;
				$this->notification->notify ($hod, "hod", "EDC Room Allotment Request", "Your Request for EDC Room Allotment (Application No. : ".$app_num." ) is has been Rejected by PCE.", "edc_booking/booking_request/details/".$app_num."/hod", "");
				*/
			}

			$this->session->set_flashdata('flashSuccess','Room Allotment request has been successfully '.$status.'.');
			redirect('edc_booking/booking_request/pce');
	}

}
