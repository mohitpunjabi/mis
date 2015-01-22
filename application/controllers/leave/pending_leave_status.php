<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pending_leave_status extends MY_Controller
{

	

	public function index()
	{
		
		$header['title']='Pending Leave Status';
		$this->load->view('templates/header',$header);
		$this->load->model('leave/leave_status_model','',TRUE);
		$desc=$this->leave_status_model->pending_leave_status();
		$data['info']=$desc;
		$this->load->view('leave/pending_leave_status',$data);
		$this->load->view('templates/footer');
	}
}