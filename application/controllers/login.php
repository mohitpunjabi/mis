<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function index()
	{

		if($this->session->userdata('isLoggedIn'))
			redirect('home');
		else
			$this->showlogin();
	}

	function showlogin($error_code = 0)
	{
		$data['error_code'] = $error_code;
    	$this->load->view('login',$data);
	}

	function login_user()
	{
    	$user = $this->input->post('username');
     	$pass = $this->input->post('password');
     	$this->load->model('users_model','',TRUE);

		//Ensure values exist for user and pass, and validate the user's credentials
		if( $user && $pass && $this->users_model->validate_user($user,$pass))
		{
			redirect('home');
		}
		else
			$this->showlogin(1);
	}
}

/* End of file login.php */
/* Location: mis/application/controllers/login.php */
