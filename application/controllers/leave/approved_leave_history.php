<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approved_leave_history extends MY_Controller
{

	

	public function index()
	{
		
		$this->drawHeader("Approved Leave History");
		$this->load->model('leave/leave_history_model','',TRUE);
		$desc=$this->leave_history_model->approved_leave_history();
		$data['info']=$desc;
		$this->load->view('leave/approved_leave_history',$data);
		$this->drawFooter();
	}
}