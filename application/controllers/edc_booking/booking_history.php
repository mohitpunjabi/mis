<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking_history extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','stu'));
		$this->addJS("edc_booking/booking.js");
	}
	
	function index()
	{	
		$this->load->model('edc_booking/edc_booking_model');
		$this->load->model('user_model');

		$res = $this->edc_booking_model->get_booking_history ($this->session->userdata('id'), "Approved");
		$total_rows_approved = count($res);
		$data_array_approved = array();
		$sno = 1;
		foreach ($res as $row)
		{
			$data_array_approved[$sno]=array();
			$j=1;
			$data_array_approved[$sno][$j++] = $row['app_num'];
			$data_array_approved[$sno][$j++] = date('j M Y g:i A', strtotime($row['app_date']));
			$data_array_approved[$sno][$j++] = $row['no_of_guests'];
			$sno++;
		}

		$res = $this->edc_booking_model->get_booking_history ($this->session->userdata('id'), "Rejected");
		$total_rows_rejected = count($res);
		$data_array_rejected = array();
		$sno = 1;
		foreach ($res as $row)
		{
			$data_array_rejected[$sno]=array();
			$j=1;
			$data_array_rejected[$sno][$j++] = $row['app_num'];
			$data_array_rejected[$sno][$j++] = date('j M Y g:i A', strtotime($row['app_date']));
			$data_array_rejected[$sno][$j++] = $row['no_of_guests'];
			$data_array_rejected[$sno][$j++] = "";
			if ($row['hod_approved_status'] == "Rejected")
				$data_array_rejected[$sno][4] = "Head of Department";
			else
				$data_array_rejected[$sno][4] = "PCE";				
			$sno++;
		}

		$data['data_array_approved'] = $data_array_approved;
		$data['total_rows_approved'] = $total_rows_approved;
		$data['data_array_rejected'] = $data_array_rejected;
		$data['total_rows_rejected'] = $total_rows_rejected;
		
		$this->drawHeader('Executive Development Center');
		$this->load->view('edc_booking/booking_history',$data);
		$this->drawFooter();
	}		
}