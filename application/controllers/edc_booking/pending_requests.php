<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pending_requests extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod'));
	}
	
	function index()
	{
		$this->load->model('edc_booking/edc_booking_model');
		$data['requests'] = $this->edc_booking_model->get_pending_requests ($this->session->userdata('dept_id'));
		
		$this->drawHeader('Executive Development Center');
		if(count($data['requests']) == 0)
		{
			$ui = new UI();
			$ui->callout()
			   ->uiType("info")
			   ->title("No Pending Requests.")
			   ->desc("")
			   ->show();
		}	
		else
			$this->load->view('edc_booking/pending_requests',$data);
		$this->drawFooter();
	}
}
