<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approved_leave_status extends MY_Controller
{

	

	public function index()
	{
		
		$header['title']='Approved Leave Status';
		$this->load->view('templates/header',$header);
		$this->load->model('leave/leave_status_model','',TRUE);
		$desc=$this->leave_status_model->approved_leave_status();
		$data['info']=$desc;
		$this->load->view('leave/approved_leave_history',$data);
		$this->load->view('templates/footer');
	}
}