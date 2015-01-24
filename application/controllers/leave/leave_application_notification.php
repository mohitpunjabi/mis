<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Leave_application_notification extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp'));
	}
	
	public function index()
	{
		$leave_type=$_POST['leave_type'];
		$leave_from=$_POST['from'];
		$leave_to=$_POST['to'];
		$header['title']='Leave Application Notification';
		$this->load->view('templates/header',$header);
		$this->load->model('leave/leave_application_notification_model','',TRUE);
		$sess_var=$this->leave_application_notification_model->session_variables();
		$desc=$this->leave_application_notification_model->check_acceptable_leave($leave_type,$leave_from,$leave_to);
		$diff=strtotime($leave_to)-strtotime($leave_from);
		$period = floor($diff/ (60*60*24))+1;
		if($desc[0]==TRUE)
		{
			$data['var']=TRUE;
			$description="Your ".$leave_type." request from ".$leave_from." to ".$leave_to." has been sent for approval to your reporting officer";
			$data['desc']=$description;
			$lev_st=1;
			$this->leave_application_notification_model->insert($sess_var[0],$sess_var[1],$leave_type,$leave_from,$leave_to,$period,$lev_st);
		}
		else
		{
			$data['var']=$desc[0];
			$data['desc']=$desc[1];
		}
		$this->load->view('leave/leave_application_notification',$data);
		$this->load->view('templates/footer');
	}
}
?>