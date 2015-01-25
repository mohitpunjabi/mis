<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leave_approval extends MY_Controller
{
	public function index()
	{
		$header['title']='Leave Approval Notifications';
		$this->load->view('templates/header',$header);
		$this->load->model('leave/leave_approval_model','',TRUE);
		$leave_id=$_POST['id'];
		$approval_type=$_POST['approve'];
		$data['id']=$leave_id;
		if($approval_type=='Approve')
		{
			$this->leave_approval_model->index_approved($leave_id);
			$comment=$this->leave_approval_model->approved_leave_comment($leave_id);
			$data['remarks']=$comment;
			$data['approve']='Approved';
		}
		else
		{
			$data['approve']='Disapproved';
		}
		$this->load->view('leave/leave_approval',$data);
		$this->load->view('templates/footer');
	}
}