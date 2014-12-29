<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','deo'));
	}

	public function index($form_no = 5)
	{
		if($this->authorization->is_auth('deo'))
		{
			$header['title']="View Employee";
			$header['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/employee/edit_employee_script.js \" ></script>";

			$this->load->model('emp_basic_details_model','',TRUE);
			$data['employees']=$this->emp_basic_details_model->getAllEmployeesId();

			$this->load->model('departments_model','',TRUE);
			$data['departments']=$this->departments_model->get_departments();

			$this->load->view('templates/header',$header);
			$this->load->view('employee/view/index',$data);
			$this->load->view('templates/footer');
		}
		else if($this->authorization->is_auth('emp'))
		{
			$this->_load_view($this->session->userdata('id'),$form_no);
		}
	}

	function view_form()
	{
		if(!$this->authorization->is_auth('deo'))
		{
			$this->session->set_flashdata('flashError','You are not authorized.');
			redirect('employee/menu');
			return;
		}

		$emp_id = $this->input->post('emp_id');
		$form = $this->input->post('form_name');

		// if some one refreshes the page then post values will be false, so saving the values in session.
		if($emp_id != '')
		{
			$this->session->set_userdata('VIEW_EMPLOYEE_ID',$emp_id);
			$this->session->set_userdata('VIEW_EMPLOYEE_FORM',$form);
		}

		if($emp_id == "" && !$this->session->userdata('VIEW_EMPLOYEE_ID'))
		{
			$this->session->set_flashdata('flashError','No employee selected.');
			redirect('employee/view');
			return;
		}
		$emp_id = $this->session->userdata('VIEW_EMPLOYEE_ID',$emp_id);
		$form = $this->session->userdata('VIEW_EMPLOYEE_FORM',$emp_id);

		$this->_load_view($emp_id, $form);
	}

	private function _load_view($emp_id, $form)
	{
		$header['title']='View Employee Details';
		$header['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/employee/print_script.js \" ></script>";

		$data['emp_id'] = $emp_id;
		$data['form'] = $form;

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

		$this->load->view('templates/header',$header);
		$this->load->view('employee/view/view_header',array('emp_id'=>$emp_id));
		$this->load->view('employee/view/profile_pic',$data);
		switch($form)
		{
			case 0:	$this->load->view('employee/view/basic_details',$data);break;
			case 1: $this->load->view('employee/view/previous_employment_details',$data);break;
			case 2: $this->load->view('employee/view/family_details',$data);break;
			case 3: $this->load->view('employee/view/educational_details',$data);break;
			case 4: $this->load->view('employee/view/last_five_year_stay_details',$data);break;
			case 5: $this->load->view('employee/view/basic_details',$data);
					$this->load->view('employee/view/previous_employment_details',$data);
					$this->load->view('employee/view/family_details',$data);
					$this->load->view('employee/view/educational_details',$data);
					$this->load->view('employee/view/last_five_year_stay_details',$data);
		}
		$this->load->view('employee/view/view_footer');
		$this->load->view('templates/footer');
	}
}
/* End of file view.php */
/* Location: mis/application/controllers/employee/view.php */