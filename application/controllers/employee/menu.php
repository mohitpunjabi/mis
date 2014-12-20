<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$this->load->model('employee/Emp_current_entry_model','',TRUE);
		$data['entry']=$this->Emp_current_entry_model->get_current_entry();
		$header['title']='Employee Management';
		$this->load->view('templates/header',$header);
		$this->load->view('employee/main_menu',$data);
		$this->load->view('templates/footer');
	}
}

/* End of file menu.php */
/* Location: mis/application/controllers/employee/menu.php */
