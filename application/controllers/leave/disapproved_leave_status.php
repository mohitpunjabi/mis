<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Disapproved_leave_status extends MY_Controller
{

	

	public function index()
	{
		
		$this->drawHeader("Disapproved Leave Status");
		$this->load->model('leave/leave_status_model','',TRUE);
		$desc=$this->leave_status_model->rejected_leave_status();
		$data['info']=$desc;
		$this->load->view('leave/disapproved_leave_status',$data);
		$this->drawFooter();
	}
}