<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Add extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('deo'));
	}

	public function index($error='')
	{
		$this->load->model('student/Stu_current_entry_model','',TRUE);
		$entry = $this->Stu_current_entry_model->get_current_entry();
		if($entry === FALSE)
			$this->step(0,'',$error);
		else
			$thsi->step($entry->curr_step,$entry->id,$error);
	}

	private function step($num = 0,$employee = '',$error = '')
	{
		switch($num)
		{
			case 0: $this->add_basic_details($error);break;
		}
	}

	public function add_basic_details($error = '')
	{
		//Handling Error
		$data['error'] = $error;

		//Fetching Departments
		$this->load->model('Departments_model','',TRUE);
		$data['academic_departments']=$this->Departments_model->get_departments('academic');
		$depts = $data['academic_departments'];
		var_dump($depts[0]->id);
		//javascript
		$this->addJS('student/basic_details_script.js');

		//view
		$this->drawHeader("Add Student Details");
		$this->load->view('student/add/stu_detail',$data);
		$this->drawFooter();

	}

	public function add_education_details($error = '')
	{
		$data['error'] = $error;
		$this->addJS("employee/print_script.js");
		$this->drawHeader('Add Education Details');
		$this->load->view('student/add/student_educational_details',$data);
		$this->drawFooter();
	}

	public function insert_basic_details()
	{

	}
}