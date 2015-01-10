<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validation extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('est_ar','deo'));
	}

	public function index()
	{
		$header['title']="Validation Requests";
		$header['javascript']="<script type=\"text/javascript\">function reject_reason(i){ alert(\"Reason behind Rejection : '\"+document.getElementById('rejected'+i).innerHTML+\"'\"); }</script>";

		$this->load->model('user_details_model','',TRUE);
		$this->load->model('emp_validation_details_model','',TRUE);
		$data['emp_validation_details']=$this->emp_validation_details_model->getValidationDetails();

		$this->load->view('templates/header',$header);
		$this->load->view('employee/validation/index',$data);
		$this->load->view('templates/footer');
	}

	function validate_step($emp_id='', $step='')
	{
		if(!$this->authorization->is_auth('est_ar'))
		{
			$this->session->set_flashdata('flashError','You are not authorized.');
			redirect('employee/menu');
			return;
		}

		if($emp_id == '')
		{
			redirect('employee/validation');
			return;
		}

		$header['title']="Employee Validation";
		$header['javascript']="<script type=\"text/javascript\">function reject_reason(i){ alert(\"Reason behind Rejection : '\"+document.getElementById('rejected'+i).innerHTML+\"'\"); }</script>";

		$this->load->model('user_details_model','',TRUE);
		$this->load->model('user_other_details_model','',TRUE);
		$this->load->model('emp_basic_details_model','',TRUE);
		$this->load->model('faculty_details_model','',TRUE);
		$this->load->model('emp_pay_details_model','',TRUE);
		$this->load->model('user_address_model','',TRUE);
		$this->load->model('emp_prev_exp_details_model','',TRUE);
		$this->load->model('departments_model','',TRUE);
		$this->load->model('designations_model','',TRUE);
		$this->load->model('emp_family_details_model','',TRUE);
		$this->load->model('emp_education_details_model','',TRUE);
		$this->load->model('emp_last5yrstay_details_model','',TRUE);
		$this->load->model('emp_validation_details_model','',TRUE);

		$data['user_details']=$this->user_details_model->getUserById($emp_id);
		$data['user_other_details']=$this->user_other_details_model->getUserById($emp_id);
		$data['emp']=$this->emp_basic_details_model->getEmployeeById($emp_id);
		$data['ft']=$this->faculty_details_model->getFacultyById($emp_id);
		$data['emp_pay_details']=$this->emp_pay_details_model->getEmpPayDetailsById($emp_id);
		$data['permanent_address']=$this->user_address_model->getAddrById($emp_id,'permanent');
		$data['present_address']=$this->user_address_model->getAddrById($emp_id,'present');
		$data['emp_prev_exp_details'] = $this->emp_prev_exp_details_model->getEmpPrevExpById($emp_id);
		$data['emp_family_details'] = $this->emp_family_details_model->getEmpFamById($emp_id);
		$data['emp_education_details'] = $this->emp_education_details_model->getEmpEduById($emp_id);
		$data['emp_last5yrstay_details'] = $this->emp_last5yrstay_details_model->getEmpStayById($emp_id);
		$data['emp_validation_details'] = $this->emp_validation_details_model->getValidationDetailsById($emp_id);

		if(!$data['emp_validation_details'])
		{
			$this->session->set_flashdata('flashInfo','The employee '.$emp_id.' details have been Approved');
			redirect('employee/validation');
			return;
		}

		$this->load->view('templates/header',$header);
		$this->load->view('employee/view/view_header',array('emp_id'=>$emp_id));

		$this->load->view('employee/validation/index',array('emp_validation_details'=>array($data['emp_validation_details'])));

		if($step!='')
		{
			$data['form']=$step-1;
			switch($step)
			{
				case 0: $this->load->view('employee/view/profile_pic',$data);break;
				case 1:	$this->load->view('employee/view/basic_details',$data);break;
				case 2: $this->load->view('employee/view/previous_employment_details',$data);break;
				case 3: $this->load->view('employee/view/family_details',$data);break;
				case 4: $this->load->view('employee/view/educational_details',$data);break;
				case 5: $this->load->view('employee/view/last_five_year_stay_details',$data);break;
			}
		}
		$this->load->view('employee/validation/validation',array('emp_id'=>$emp_id, 'step'=>$step,'emp_validation_details'=>$data['emp_validation_details']));
		//$this->load->view('employee/view/view_footer');
		$this->load->view('templates/footer');
	}

	function validate_details($emp_id, $step)
	{
		if(!$this->authorization->is_auth('est_ar'))
		{
			$this->session->set_flashdata('flashError','You are not authorized.');
			redirect('employee/menu');
			return;
		}

		$this->load->model('emp_validation_details_model','',TRUE);
		$this->load->model('users_model','',TRUE);
		$this->load->model('deo_modules_model','',TRUE);

		switch($step)
		{
			case 0: $form = 'profile_pic_status'; $msg='profile picture';break;
			case 1:	$form = 'basic_details_status'; $msg='basic details';break;
			case 2: $form = 'prev_exp_status'; $msg='previous employment details';break;
			case 3: $form = 'family_details_status'; $msg='dependent family member details';break;
			case 4: $form = 'educational_status'; $msg='educational qualificatons';break;
			case 5: $form = 'stay_status'; $msg='last 5 year stay details';break;
		}

		$user = $this->users_model->getUserById($emp_id);
		$date = date("Y-m-d H:i:s",time());

		if($this->input->post('approve'))
		{
			//pending --> approved
			$this->emp_validation_details_model->updateById(array($form => 'approved'),$emp_id);
			// delete reject details for the same
			$this->emp_validation_details_model->deleteRejectReasonWhere(array('id'=>$emp_id, 'step'=>$step));
			//Notify Employee about the same
			if($user->auth_id == 'emp' && $user->password !='')
			{
				$this->notification->notify($emp_id, "Validation Request Approved", "Your validation request for ".$msg." have been approved.", "view/index/".(($step==0)? $step:($step-1)),"success");
			}
		}
		else if($this->input->post('reject'))
		{
			//pending --> rejected
			$this->emp_validation_details_model->updateById(array($form => 'rejected'),$emp_id);
			// insert or update reject details
			$reason=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=>$step));
			if($reason)
				$this->emp_validation_details_model->updateRejectReason(array('reason'=>$this->input->post('reason')),array('id'=>$emp_id,'step'=>$step));
			else
				$this->emp_validation_details_model->insertRejectReason(array('id'=>$emp_id,
																				'step'=>$step,
																				'reason'=>$this->input->post('reason'),
																				'created_date'=> $date));
			//Notify Employee about the same
			if($user->auth_id == 'emp' && $user->password !='')
			{
				$this->notification->notify($emp_id, "Validation Request Rejected", "Your validation request for ".$msg." have been rejected. Contact the Establishment Section for the same.", "view/index/".(($step==0)? $step:($step-1)),"error");
			}
			//Notify Deo of employee about the same
			$deo = $this->deo_modules_model->getDeoByModuleId('employee');
			foreach($deo as $row)
			{
				$this->notification->notify($row->id, "Validation Request Rejected", "Validation request for employee ".$emp_id." ".$msg." have been rejected.", "validation","error");
			}
		}

		//If all the status are approved
		$this->emp_validation_details_model->deleteValidationDetailsWhere(array('profile_pic_status'=> 'approved',
																				'basic_details_status'=> 'approved',
																				'prev_exp_status'=> 'approved',
																				'family_details_status'=> 'approved',
																				'educational_status'=> 'approved',
																				'stay_status'=> 'approved'));
		$emp_validation_details = $this->emp_validation_details_model->getValidationDetailsById($emp_id);
		if($emp_validation_details)
			redirect('employee/validation/validate_step/'.$emp_id);
		else
		{
			//for new user
			if($user->auth_id == 'emp' && $user->password =='')
			{
				$pass='p';
				$encode_pass=$this->authorization->strclean($pass);
				$encode_pass=$this->authorization->encode_password($encode_pass,$date);
				$this->users_model->update(array('password' => $encode_pass, 'created_date' => $date), array('id' => $emp_id));

				#email the user and pass
				/*
				$email_query=mysql_query("SELECT email FROM user_details WHERE id='".$emp_id."'");
				$row=mysql_fetch_row($email_query);
				$to = $row[0];
				$subject = "Registration on Online ISM MIS Portal";
				$message = "You are registered on the Online ISM MIS Portal. Your Username and password are \n Username:".$emp_id ."\n Password:".$pass;
				$from = "xyz@example.com";
				$headers = "From:" . $from;
		//		mail($to,$subject,$message,$headers);
				echo "Mail Sent";
				*/
			}
			redirect('employee/validation');
		}
	}
}
/* End of file validation.php */
/* Location: mis/application/controllers/employee/validation.php */