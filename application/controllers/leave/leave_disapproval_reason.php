<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leave_disapproval_reason extends MY_Controller
{
	public function index()
	{
		$header['title']='Leave Disapproval Notifications';
		$this->load->view('templates/header',$header);
		$this->load->model('leave/leave_approval_model','',TRUE);
		$leave_id=$_POST['leave_index'];
		$comment=$_POST['comment'];
		$results=$this->leave_approval_model->disapproved_leave_comment($leave_id,$comment);
		$data['remarks']=$results;
		$this->load->view('leave/leave_disapproval_reason',$data);
		$this->load->view('templates/footer');
	}
}