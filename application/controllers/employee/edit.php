<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends MY_Controller
{
	function __construct()
	{
		parent::__construct('emp','deo');
	}

	public function index()
	{
		if($this->authorization->is_auth('deo'))
		{
			$header['title']="Edit Employee";
			$this->load->view('templates/header',$header);
			$this->load->view('employee/edit/index',$data);
			$this->load->view('templates/footer');

		}
		else if($this->authorization->is_auth('emp'))
		{

		}
	}

	public function action_menu()
	{

	}
}
/* End of file edit.php */
/* Location: mis/application/controllers/employee/edit.php */
