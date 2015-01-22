<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Disapproved_leave_history extends MY_Controller
{

	

	public function index()
	{
		
		$header['title']='Disapproved Leave History';
		$this->load->view('templates/header',$header);
		$this->load->model('leave/leave_history_model','',TRUE);
		$desc=$this->leave_history_model->rejected_leave_history();
		$data['info']=$desc;
		$this->load->view('leave/disapproved_leave_history',$data);
		$this->load->view('templates/footer');
	}
}