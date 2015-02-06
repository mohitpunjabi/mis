<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller
{

	

	public function index()
	{
		
		$this->drawHeader("Leave Management");
		$this->load->view('leave/main_menu');
		$this->drawFooter();
	}
}

/* End of file menu.php */
/* Location: mis/application/controllers/employee/menu.php */
