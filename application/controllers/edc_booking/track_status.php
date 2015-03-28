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
		
		$data ['auth'] = $this->session->userdata('auth')[0];

		$this->drawHeader('Track Booking Status');
 		$this->load->view('edc_booking/booking_details_user', $data);
		$this->drawFooter();
	}
}