<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hod extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod'));
	}
	
	function index()
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
				$this->notification->notify ($pce, "pce", "Approve/Reject Pending Request", "EDC Room Booking Request (Application No. : ".$app_num." ) is Pending for your approval.", "edc_booking/booking_details/details/".$app_num."/pce", "");
			else //Rejected -> Notify to User
				$this->notification->notify ($user_id, "emp", "EDC Room Allotment Request", "Your Request for EDC Room Allotment (Application No. : ".$app_num." ) has been Rejected.", "edc_booking/booking_details/details/".$app_num."/emp", "");

			$this->session->set_flashdata('flashSuccess','Room Allotment request has been successfully '.$status.'.');
			redirect('edc_booking/hod');
	}
}
