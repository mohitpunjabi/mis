<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leave_Application extends MY_Controller
{

	

	public function index()
	{
		 $pattern1 = '/^(0?\d|1\d|2[0-3]):[0-5]\d:[0-5]\d$/';
		 $pattern2 = '/^(0?\d|1[0-2]):[0-5]\d\s(am|pm)$/i';
		$check=FALSE;
		$data['leave_name']='$';
		$data['submit_leave_from']='';
		$data['submit_leave_to']='';
		$data['avail_leave_st']='$';
		$data['avail_date_st']='';
		$data['avail_date_end']='';
		$data['avail_time_st']='';
		$data['avail_time_end']='';
		$data['avail_add']='';
		$data['avail_reason']='';
		$data['leave_reason']='';
		$data['desc_leave']="display:none;";
		$data['desc_avail']="display:none;";
		if(isset($_POST['submit']))
		{
			$data['leave_name']=$_POST['leave_type'];
			$data['submit_leave_from']=$_POST['from'];
			$data['submit_leave_to']=$_POST['to'];
			$data['avail_date_st']=$_POST['leave_st_date'];
			$data['avail_leave_st']=$_POST['avail_leave_station'];
			$data['avail_date_end']=$_POST['return_st_date'];
			$data['avail_time_st']=$_POST['leave_st_time'];
			$data['avail_time_end']=$_POST['return_st_time'];
			$data['avail_add']=$_POST['absence_address'];
			$data['avail_reason']=$_POST['leave_station_purpose'];
			$data['leave_reason']=$_POST['purpose_reason'];
			if($_POST['avail_leave_station']=='yes')
				$data['desc_avail']="";
			if($_POST['leave_type']=='Casual Leave')
				$data['desc_leave']="";
			$this->load->model('leave/leave_application_notification_model','',TRUE);
			$data['set']=TRUE;
			if($_POST['leave_type']=='$')
			{
				$data['var']=FALSE;
				$data['desc']="Please select a valid leave type";
			}
			else if($_POST['leave_type']=='Casual Leave' && (($_POST['purpose_reason']=='')))
			{
				$data['var']=FALSE;
				$data['desc']="Please specify the purpose for availing Casual Leave";
			}
			else if(!strtotime($_POST['from']))
			{
				$data['var']=FALSE;
				$data['desc']="Please fill the starting date";
			}
			else if(!strtotime($_POST['to']))
			{
				$data['var']=FALSE;
				$data['desc']="Please fill the ending date";
			}
			else if(($_POST['avail_leave_station']=='$'))
			{
				$data['var']=FALSE;
				$data['desc']="Please select whether you want to request for permission to leave station.";
			}
			else if($_POST['avail_leave_station']=='yes')
			{
				if(($_POST['leave_station_purpose']==''))
				{
					$data['var']=FALSE;
					$data['desc']="Please specify the purpose of leaving station";
				}
				else if(!strtotime($_POST['leave_st_date']))
				{
					$data['var']=FALSE;
					$data['desc']="Please specify the date of leaving station";
				}
				else if($_POST['leave_st_time']=='')
				{
					$data['var']=FALSE;
					$data['desc']="Please specify the time of leaving station";
				}
				else if(!strtotime($_POST['return_st_date']))
				{
					$data['var']=FALSE;
					$data['desc']="Please specify the date of returning to station";
				}
				else if(($_POST['return_st_time']==''))
				{
					$data['var']=FALSE;
					$data['desc']="Please specify the time of returning to station.";
				}
				else if(!isset($_POST['absence_address']))
				{
					$data['var']=FALSE;
					$data['desc']="Please specify your address during absence from station.";
				}
				else
					$check=TRUE;
			}
			else
				$check=TRUE;
			if($check==TRUE){
			$leave_type=$_POST['leave_type'];
			$leave_from=$_POST['from'];
			$leave_to=$_POST['to'];
			$sess_var=$this->leave_application_notification_model->session_variables();
			$desc=$this->leave_application_notification_model->check_acceptable_leave($leave_type,$leave_from,$leave_to);
			$diff=strtotime($leave_to)-strtotime($leave_from);
			$period = floor($diff/ (60*60*24))+1;
			if($desc[0]==TRUE)
			{
				$data['leave_name']='$';
				$data['submit_leave_from']='';
				$data['submit_leave_to']='';
				$data['avail_leave_st']='$';
				$data['avail_date_st']='';
				$data['avail_date_end']='';
				$data['avail_time_st']='';
				$data['avail_time_end']='';
				$data['avail_add']='';
				$data['avail_reason']='';
				$data['leave_reason']='';
				$data['desc_leave']="display:none;";
				$data['desc_avail']="display:none;";
				$data['var']=TRUE;
				$modify_leave_from=$this->leave_application_notification_model->modify_date($leave_from);
				$modify_leave_to=$this->leave_application_notification_model->modify_date($leave_to);
				$description="Your ".$leave_type." request from ".$modify_leave_from." to ".$modify_leave_to." has been sent for approval to your reporting officer";
				$data['desc']=$description;
				$lev_st=1;
				$this->leave_application_notification_model->insert($sess_var[0],$sess_var[1],$leave_type,$leave_from,$leave_to,$period,$lev_st);
				$leave_id=$this->leave_application_notification_model->get_leave_id($sess_var[0],$sess_var[1],$leave_type,$leave_from,$leave_to);
				if($_POST['avail_leave_station']=='yes')
					$this->leave_application_notification_model->insert_leave_station_details($leave_id,$_POST['leave_st_date'],$_POST['leave_st_time'],$_POST['return_st_date'],$_POST['return_st_time'],$_POST['leave_station_purpose'],$_POST['absence_address']);
				if($leave_type=='Casual Leave')
					$this->leave_application_notification_model->insert_purpose_details($leave_id,$_POST['purpose_reason']);
			}
			else
			{
				$data['var']=$desc[0];
				$data['desc']=$desc[1];
			}}
			$header['title']='Leave Application Notification';
			$this->load->view('templates/header',$header);
			$this->load->view('leave/leave_application',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			$header['title']='Leave Management';
			$this->load->view('templates/header',$header);
			$data['set']=FALSE;
			$this->load->view('leave/leave_application',$data);
			$this->load->view('templates/footer');
		}
	
		/*$header['title']='Leave Management';
		$this->load->view('templates/header',$header);
		$this->load->view('leave/leave_application');
		$this->load->view('templates/footer');*/
	}
}