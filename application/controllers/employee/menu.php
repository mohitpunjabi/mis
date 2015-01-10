<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller
{

	public function index()
	{
		$this->load->helper('url');
		$this->load->model('employee/Emp_current_entry_model','',TRUE);
		$data['title']='Employee Management';
		$data['entry']=$this->Emp_current_entry_model->get_current_entry();
		$this->load->view('employee/main_menu',$data);
	}

	private function _basic_details()
	{
		// by default faculty designations are to be fetched
		$this->load->model('Designations_model','',TRUE);
		$data['designations']=$this->Designations_model->get_designations("type in ('ft','others')");

		// get distinct pay bands
		$this->load->model('Pay_scales_model','',TRUE);
		$data['pay_bands']=$this->Pay_scales_model->get_pay_bands();

		// get academic departments ........ as faculty is selected by default
		$this->load->model('Departments_model','',TRUE);
		$data['academic_departments']=$this->Departments_model->get_departments('academic');


		//javascript
		$data['javascript']="<script type=\"text/javascript\" src=\"../../../assets/js/employee/basic_details_script.js\" ></script>";

		//view
		$this->load->view('employee/add/basic_details',$data);
	}

	public function add($num = 0,$employee = '')
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('javascript');

		if($num!=0)	$data['curr_emp_entry_id']=$employee;
		switch ($num)
		{
			case 0:	$this->_basic_details();break;
			case 1: $this->load->view('employee/add/previous_employment_details',$data);break;
			case 2: $this->load->view('employee/add/family_details',$data);break;
			case 3: $this->load->view('employee/add/educational_details',$data);break;
			case 4: $this->load->view('employee/add/last_five_year_stay_details',$data);break;
		}
	}

	public function edit()
	{
	}
}

/* End of file menu.php */
/* Location: Codeigniter/application/controllers/employee/menu.php */