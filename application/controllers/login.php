<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($this->session->userdata('isLoggedIn'))
			redirect('home');
		else
			$this->showlogin();
	}

	//access private so that it can't be called from outside
	private function showlogin($error_code = 0)
	{
		$data['error_code'] = $error_code;
    	$this->load->view('login',$data);
	}

	function login_user()
	{
    	$user = $this->input->post('username');
     	$pass = $this->input->post('password');
     	$this->load->model('user/users_model','',TRUE);

		//Ensure values exist for user and pass, and validate the user's credentials
		if( $user && $pass && $this->users_model->validate_user($user,$pass))
		{
			$this->db->insert("user_login_attempts", array("id" => $this->session->userdata('id'), "time" => date('Y-m-d H:i:s')));
			if($this->session->userdata('last_login') == false)
				redirect('change_password');
			else
			{
				redirect('home');
			}
		}
		else
			$this->showlogin(1);
	}

	function logout($error_code = 0)
	{
        $this->session->sess_destroy();
        $this->showlogin($error_code);
	}
}

/* End of file login.php */
/* Location: mis/application/controllers/login.php */
