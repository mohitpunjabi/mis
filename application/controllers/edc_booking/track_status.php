<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Track_status extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','stu'));
		$this->addJS("edc_booking/booking.js");
	}
	
	function index()
	{
		$this->load->model('edc_booking/edc_booking_model');
		$res = $this->edc_booking_model->get_pending_booking_details($this->session->userdata('id'));
		
		if(count($res) == 0){
			$this->session->set_flashdata('flashError','You haven\'t any application form to track.');
			redirect('edc_booking/booking');
		}	

		$data = array();
		foreach ($res as $row)
		{
			$data['app_num'] = $row['app_num'];
			$data['app_date'] = date('j M Y g:i A', strtotime($row['app_date']));
			$data['hod_approved_status'] = $row['hod_approved_status'];
			$data['hod_approved_timestamp'] = $row['hod_approved_timestamp'];
			$data['pce_approved_status'] = $row['pce_approved_status'];
			$data['pce_approved_timestamp'] = $row['pce_approved_timestamp'];
			$data['deny_reason'] = $row['deny_reason'];
			$data['purpose'] = $row['purpose'];
			$data['check_in'] = $row['proposed_check_in'];
			$data['check_out'] = $row['proposed_check_out'];
			$data['amount_deposited'] = $row['amount_deposited'];
			$data['amount_name'] = $row['amount_name'];
		}
		
		$res = $this->edc_booking_model->get_guest_details ($data['app_num']);
		$data['guests'] = $res;

		$this->drawHeader('Track Booking Status');
 		$this->load->view('edc_booking/booking_details_emp', $data);
		$this->drawFooter();
	}
}