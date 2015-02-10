<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validation extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('est_ar','deo'));
	}

	public function index()
	{
		$this->addJS('employee/reject_reason_script.js');

		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('employee/emp_validation_details_model','',TRUE);
		$data['emp_validation_details']=$this->emp_validation_details_model->getValidationDetails();

		$this->drawHeader("Validation Requests");
		$this->load->view('employee/validation/index',$data);
		$this->drawFooter();
	}

	function validate_step($emp_id='', $step=-1)
	{
		if(!$this->authorization->is_auth('est_ar')) {
			$this->session->set_flashdata('flashError','You are not authorized.');
			redirect('home');
			return;
		}

		if($emp_id == '') {
			redirect('employee/validation');
			return;
		}

		$this->addJS('employee/reject_reason_script.js');

		$this->load->model('employee_model','',TRUE);
		$this->load->model('employee/faculty_details_model','',TRUE);
		$this->load->model('departments_model','',TRUE);
		$this->load->model('designations_model','',TRUE);
		$this->load->model('employee/emp_validation_details_model','',TRUE);

		$data['emp_id']=$emp_id;
		$data['step']=$step;
		$data['emp']=$this->employee_model->getById($emp_id);
		$data['ft']=$this->faculty_details_model->getFacultyById($emp_id);
		$data['emp_prev_exp_details'] = $this->employee_model->getPreviousEmploymentDetailsById($emp_id);
		$data['emp_family_details'] = $this->employee_model->getFamilyDetailsById($emp_id);
		$data['emp_education_details'] = $this->employee_model->getEducationDetailsById($emp_id);
		$data['emp_last5yrstay_details'] = $this->employee_model->getStayDetailsById($emp_id);
		$data['emp_validation_details'] = $this->emp_validation_details_model->getValidationDetailsById($emp_id);

		if(!$data['emp_validation_details']) {
			$this->session->set_flashdata('flashInfo','The employee '.$emp_id.' details have been Approved');
			redirect('employee/validation');
			return;
		}

		$this->drawHeader("Employee Validation","<h4><b>Employee Id </b>< ".$emp_id.' ></h4>');
		$this->load->view('employee/validation/index',array('emp_validation_details'=>array($data['emp_validation_details'])));
		$this->load->view('employee/validation/view',$data);
		$this->drawFooter();
	}

	function validate_details($emp_id, $step)
	{
		if(!$this->authorization->is_auth('est_ar'))
		{
			$this->session->set_flashdata('flashError','You are not authorized.');
			redirect('home');
			return;
		}

		$this->load->model('employee/emp_validation_details_model','',TRUE);
		$this->load->model('user/users_model','',TRUE);
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

		if($this->input->post('approve'.$step))
		{
			//pending --> approved
			$this->emp_validation_details_model->updateById(array($form => 'approved'),$emp_id);
			// delete reject details for the same
			$this->emp_validation_details_model->deleteRejectReasonWhere(array('id'=>$emp_id, 'step'=>$step));
			//Notify Employee about the same
			if($user->auth_id == 'emp' && $user->password !='')
			{
				$this->notification->notify($emp_id,'emp', "Validation Request Approved", "Your validation request for ".$msg." have been approved.", "employee/view/index/".(($step==0)? $step:($step-1)),"success");
			}
		}
		else if($this->input->post('reject'.$step))
		{
			//pending --> rejected
			$this->emp_validation_details_model->updateById(array($form => 'rejected'),$emp_id);
			// insert or update reject details
			$reason=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=>$step));
			if($reason)
				$this->emp_validation_details_model->updateRejectReason(array('reason'=>$this->input->post('reason'.$step)),array('id'=>$emp_id,'step'=>$step));
			else
				$this->emp_validation_details_model->insertRejectReason(array('id'=>$emp_id,
																				'step'=>$step,
																				'reason'=>$this->input->post('reason'.$step),
																				'created_date'=> $date));
			//Notify Employee about the same
			if($user->auth_id == 'emp' && $user->password !='')
			{
				$this->notification->notify($emp_id,'emp', "Validation Request Rejected", "Your validation request for ".$msg." have been rejected. Contact the Establishment Section for the same.", "employee/view/index/".(($step==0)? $step:($step-1)),"error");
			}
			//Notify Deo of employee about the same
			$deo = $this->deo_modules_model->getDeoByModuleId('employee');
			foreach($deo as $row)
			{
				$this->notification->notify($row->id,'deo', "Validation Request Rejected", "Validation request for employee ".$emp_id." ".$msg." have been rejected.", "employee/validation","error");
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