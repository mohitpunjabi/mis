<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('emp'));
	}

	public function index()
	{
		//$header['title']='Information Management';
		$this->drawHeader("Information Management");
		$this->load->view('information/main_menu');
		$this->drawFooter();
	}
}

/* End of file menu.php */
/* Location: mis/application/controllers/information/menu.php */
