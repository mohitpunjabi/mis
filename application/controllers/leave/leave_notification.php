<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leave_notification extends MY_Controller
{

	

	public function index()
	{
		if(isset($_POST['approve'])||isset($_POST['submit_reason']))
		{
			if($_POST['approve']=='Approve')
			{
				$header['title']='Leave Approval Notification';
				$this->load->view('templates/header',$title);
				$this->load->model('leave/leave_notification_model','',TRUE);
				$this->load->model('leave/leave_approval_model','',TRUE);
				$leave_id=$_POST['id'];
				$data['status']='Approve';
				$this->leave_approval_model->index_approved($leave_id);
				$data['approval_comment']=$this->leave_approval_model->approved_leave_comment($leave_id);
				$data['leaves_pending_for_approval']=$this->leave_notification_model->notifications();
				$this->load->view('leave/leave_notification',$data);
				$this->drawFooter();
			}
			else
			{
				if(!isset($_POST['submit_reason'])){
					$this->drawHeader("Leave Disapproval Notifications");
					$data['status']='Disapprove';
					$data['id']=$_POST['id'];
					$this->load->model('leave/leave_notification_model','',TRUE);
					$data['leaves_pending_for_approval']=$this->leave_notification_model->notifications();
					$this->load->view('leave/leave_notification',$data);
					$this->drawFooter();
				}
				else{
						$this->drawHeader("Leave Disapproval Reason");
						$this->load->model('leave/leave_approval_model','',TRUE);
						$leave_id=$_POST['leave_index'];
						$comment=$_POST['comment'];
						$results=$this->leave_approval_model->disapproved_leave_comment($leave_id,$comment);
						$this->load->model('leave/leave_notification_model','',TRUE);
						$data['leaves_pending_for_approval']=$this->leave_notification_model->notifications();
						$data['status']='Disapproval_Reason';
						$data['remarks']=$results;
						$this->load->view('leave/leave_notification',$data);
						$this->drawFooter();
				}
			}
		}
		else{
		$this->drawHeader("Leave Notifications");
		$this->load->model('leave/leave_notification_model','',TRUE);
		$desc=$this->leave_notification_model->notifications();
		$data['status']='NULL';
		$data['leaves_pending_for_approval']=$desc;
		$this->load->view('leave/leave_notification',$data);
		$this->drawFooter();}
	}
}