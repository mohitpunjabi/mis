<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{
		$this->session->set_userdata('auth','deo');	//check for auth deo
		if(!$this->session->userdata('auth'))
		{
			$this->session->set_flashdata('flashError', 'Auth variable in session not set.');
			redirect('employee/menu','location');
		}
		else if($this->session->userdata('auth')=='deo')
		{
			$header['title']="Edit Employee";
			$this->load->view('templates/header',$header);
			$this->load->view('employee/edit/index',$data);
			$this->load->view('templates/footer');

		}
		else if($this->session->userdata('auth')=='emp')
		{

		}
		else
		{
		}
	}

	public function action_menu()
	{

	}
}
/* End of file edit.php */
/* Location: mis/application/controllers/employee/edit.php */
