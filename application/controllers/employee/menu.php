<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('emp','deo'));
	}

	public function index()
	{
		$this->load->model('employee/Emp_current_entry_model','',TRUE);
		$this->load->model('user_model','',TRUE);
		$data['entry']=$this->Emp_current_entry_model->get_current_entry();
		$data['users']=$this->user_model->getAddressById('1050');
		$this->drawHeader('Employee Management');
		$this->load->view('employee/main_menu',$data);
		$this->drawFooter();
	}
}

/* End of file menu.php */
/* Location: mis/application/controllers/employee/menu.php */
