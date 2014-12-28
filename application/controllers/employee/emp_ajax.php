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
			case 2: $this->load->model('emp_prev_exp_details_model','',TRUE);break;
			case 4: $this->load->model('emp_education_details_model','',TRUE);break;
			case 5: $this->load->model('emp_last5yrstay_details_model','',TRUE);break;
		}
		if($form !=-1 && $s!=-1)
		{
			$this->load->model('emp_basic_details_model','',TRUE);
				$emp_basic_details=$this->emp_basic_details_model->getEmployeeByID($this->session->userdata('EDIT_EMPLOYEE_ID'));
			if($emp_basic_details)	$data['joining_date']=$emp_basic_details->joining_date;
			else $data['joining_date']=FALSE;
			$data['form'] = $form;
			$data['s'] = $s;
			$data['emp_id'] = $this->session->userdata('EDIT_EMPLOYEE_ID');
			$this->load->view('employee/emp_ajax/delete_record',$data);
		}
	}
}

/* End of file Emp_ajax.php */
/* Location: Codeigniter/application/controllers/empolyee/Emp_ajax.php */
