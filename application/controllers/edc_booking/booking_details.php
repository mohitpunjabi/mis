<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking_details extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','stu'));
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
			$data['user'] = $this->user_model->getNameById($row['user_id']);
			$data['app_date'] = date('j M Y g:i A', strtotime($row['app_date']));
			$data['hod_approved_status'] = $row['hod_approved_status'];
			$data['hod_approved_timestamp'] = date('j M Y g:i A', strtotime($row['hod_approved_timestamp']));
			$data['pce_approved_status'] = $row['pce_approved_status'];
			$data['pce_approved_timestamp'] =date('j M Y g:i A', strtotime($row['hod_approved_timestamp']));
			$data['deny_reason'] = $row['deny_reason'];
			$data['purpose'] = $row['purpose'];
			$data['check_in'] = $row['proposed_check_in'];
			$data['check_out'] = $row['proposed_check_out'];
			$data['amount_deposited'] = $row['amount_deposited'];
			$data['amount_name'] = $row['amount_name'];
			
			$data['email'] = $this->user_model->getEmailById($row['user_id']);
			if (!$data['email'])
				$data['email'] = "NA";
		}
		
		$data['auth'] = $auth;
 		$this->drawHeader ("Booking Details");
 		if ($auth == "emp")
 			$this->load->view('edc_booking/booking_details_emp', $data);
 		else
			$this->load->view('edc_booking/booking_details',$data);
		$this->drawFooter();		
	}		
}