<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','deo','est_ar'));
	}

	public function index($form_no = 5, $emp_id = '')
	{
		if($this->authorization->is_auth('deo'))
		{
			$this->addJS('employee/edit_employee_script.js');

			$this->load->model('employee/emp_basic_details_model','',TRUE);
			$data['employees']=$this->emp_basic_details_model->getAllEmployeesId();

			$this->load->model('departments_model','',TRUE);
			$data['departments']=$this->departments_model->get_departments();

			$this->drawHeader("View Employee");
			$this->load->view('employee/view/index',$data);
			$this->drawFooter();
		}
		else if($this->authorization->is_auth('emp'))
		{
			if($emp_id !='')
				$this->_load_view($emp_id,0);
			else
				$this->_load_view($this->session->userdata('id'),$form_no);
		}
	}

	function view_form()
	{
		if(!$this->authorization->is_auth('deo'))
		{
			$this->session->set_flashdata('flashError','You are not authorized.');
			redirect('home');
			return;
		}

		$emp_id = $this->input->post('emp_id');

		// if some one refreshes the page then post values will be false, so saving the values in session.
		if($emp_id != '')
			$this->session->set_userdata('VIEW_EMPLOYEE_ID',$emp_id);

		if($emp_id == "" && !$this->session->userdata('VIEW_EMPLOYEE_ID'))
		{
			$this->session->set_flashdata('flashError','No employee selected.');
			redirect('employee/view');
			return;
		}
		$emp_id = $this->session->userdata('VIEW_EMPLOYEE_ID',$emp_id);

		$this->_load_view($emp_id);
	}

	private function _load_view($emp_id,$form=5)
	{
		$this->addJS('employee/print_script.js');

		$data['emp_id'] = $emp_id;
		$data['step']=$form;
		$this->load->model('employee_model','',TRUE);
		$this->load->model('employee/faculty_details_model','',TRUE);
		$this->load->model('employee/emp_validation_details_model','',TRUE);
		$this->load->model('departments_model','',TRUE);
		$this->load->model('designations_model','',TRUE);


		$data['emp']=$this->employee_model->getById($emp_id);
		$data['ft']=$this->faculty_details_model->getFacultyById($emp_id);
		$data['emp_prev_exp_details'] = $this->employee_model->getPreviousEmploymentDetailsById($emp_id);
		$data['emp_family_details'] = $this->employee_model->getFamilyDetailsById($emp_id);
		$data['emp_education_details'] = $this->employee_model->getEducationDetailsById($emp_id);
		$data['emp_last5yrstay_details'] = $this->employee_model->getStayDetailsById($emp_id);
		$data['emp_validation_details'] = $this->emp_validation_details_model->getValidationDetailsById($emp_id);

		$this->drawHeader("View Employee Details","<h4><b>Employee Id </b>< ".$emp_id.' ></h4>');
		$this->load->view('employee/view/view',$data);
		$this->drawFooter();
	}
}
/* End of file view.php */
/* Location: mis/application/controllers/employee/view.php */