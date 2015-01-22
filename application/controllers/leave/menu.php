<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller
{

	

	public function index()
	{
		
		$header['title']='Leave Management';
		$this->load->view('templates/header',$header);
		$this->load->view('leave/main_menu');
		$this->load->view('templates/footer');
	}
}

/* End of file menu.php */
/* Location: mis/application/controllers/employee/menu.php */
