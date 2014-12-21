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
}

/* End of file Emp_ajax.php */
/* Location: Codeigniter/application/controllers/empolyee/Emp_ajax.php */
