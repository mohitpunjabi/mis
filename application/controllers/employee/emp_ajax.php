<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emp_ajax extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// Will never be used
	}

	public function feedback_emp_detail($emp_id = '')
	{
		// fetching employee details from feedback_faculty from feedback_mis database
		if($emp_id === '')
		{
			$data['feedback_emp_detail'] = FALSE;
		}
		else
		{
			$this->load->model('employee/Feedback_faculty_model','',TRUE);
			$data['feedback_emp_detail'] = $this->Feedback_faculty_model->get_faculty_info($emp_id);
		}
		if($data['feedback_emp_detail'] !== FALSE)
			$this->load->view('employee/emp_ajax/fetch_feedback_emp_detail.php',$data);
	}

	public function delete_record($form = -1, $s = -1)
	{
		switch($form)
		{
			case 2: $this->load->model('emp_prev_exp_details_model','',TRUE);
					if($s != -1)	$this->emp_prev_exp_details_model->delete_record(array('id'=>$this->session->userdata('EDIT_EMPLOYEE_ID'), 'sno'=>$s));
					$this->edit_validation($this->session->userdata('EDIT_EMPLOYEE_ID'),'prev_exp_status');
					break;
			case 4: $this->load->model('emp_education_details_model','',TRUE);
					if($s != -1)	$this->emp_education_details_model->delete_record(array('id'=>$this->session->userdata('EDIT_EMPLOYEE_ID'), 'sno'=>$s));
					$this->edit_validation($this->session->userdata('EDIT_EMPLOYEE_ID'),'educational_status');
					break;
			case 5: $this->load->model('emp_last5yrstay_details_model','',TRUE);
					if($s != -1)	$this->emp_last5yrstay_details_model->delete_record(array('id'=>$this->session->userdata('EDIT_EMPLOYEE_ID'), 'sno'=>$s));
					$this->edit_validation($this->session->userdata('EDIT_EMPLOYEE_ID'),'stay_status');
					break;
		}
		if($form !=-1 && $s!=-1)
		{
			$this->load->model('emp_basic_details_model','',TRUE);
				$emp_basic_details=$this->emp_basic_details_model->getEmployeeByID($this->session->userdata('EDIT_EMPLOYEE_ID'));
			if($emp_basic_details)	$data['joining_date']=$emp_basic_details->joining_date;
			else $data['joining_date']=FALSE;
			$data['form'] = $form;
			$data['emp_id'] = $this->session->userdata('EDIT_EMPLOYEE_ID');
			$this->load->view('employee/emp_ajax/delete_record',$data);
		}
	}

	private function edit_validation($emp_id,$form)
	{
		$this->load->model('emp_validation_details_model','',TRUE);
		$res = $this->emp_validation_details_model->getValidationDetailsById($emp_id);
		//If no entry in the emp_validation_details table then insert the record else update the record.
		if($res == FALSE)
		{
			$validation_details = array('id'=>$emp_id,
										'profile_pic_status'=> 'approved',
										'basic_details_status'=> 'approved',
										'prev_exp_status'=> 'approved',
										'family_details_status'=> 'approved',
										'educational_status'=> 'approved',
										'stay_status'=> 'approved',
										'created_date'=> date('Y-m-d H:i:s',time()));
			$validation_details[$form] = 'pending';
			$this->emp_validation_details_model->insert($validation_details);
		}
		else
		{
			$this->emp_validation_details_model->updateById(array($form => 'pending'),$emp_id);
		}

		//Notify Employee about the change in details
		$this->load->model('users_model','',TRUE);
		$user = $this->users_model->getUserById($emp_id);
		if($user->auth_id == 'emp' && $user->password !='')
		{
			$msg='';
			switch($form)
			{
				case 'profile_pic_status' : $msg = "Your photograph have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
				case 'basic_details_status' : $msg = "Your basic details have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
				case 'prev_exp_status' : $msg = "Your previous employment details have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
				case 'family_details_status' : $msg = "Your family details have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
				case 'educational_status' : $msg = "Your educational qualifications have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
				case 'stay_status' : $msg = "Your last five year stay details have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
			}
			$this->notification->notify($emp_id, 'emp', "Details Edited", $msg, "employee/view/index/".(($this->session->userdata('EDIT_EMPLOYEE_FORM')==0)? $this->session->userdata('EDIT_EMPLOYEE_FORM'):($this->session->userdata('EDIT_EMPLOYEE_FORM')-1)));
		}
		//Notify Assistant registrar for validation
		$this->load->model('user_details_model','',TRUE);
		$user = $this->user_details_model->getUserById($emp_id);
		$emp_name = ucwords($user->salutation.' '.$user->first_name.(($user->middle_name != '')? ' '.$user->middle_name: '').(($user->last_name != '')? ' '.$user->last_name: ''));
		$this->load->model('user_auth_types_model','',TRUE);
		$res = $this->user_auth_types_model->getUserIdByAuthId('est_ar');
		foreach ($res as $row)
		{
			if($row->id == $emp_id)	continue;
			$this->notification->notify($row->id, 'est_ar', "Validation Request", "Please validate ".$emp_name." details", "employee/validation/validate_step/".$emp_id);
		}
	}
}

/* End of file Emp_ajax.php */
/* Location: Codeigniter/application/controllers/empolyee/Emp_ajax.php */
