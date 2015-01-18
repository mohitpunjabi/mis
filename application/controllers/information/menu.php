<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('emp'));
	}

	public function index()
	{
		$header['title']='Information Management';
		$this->load->view('templates/header',$header);
		$this->load->view('information/main_menu');
		$this->load->view('templates/footer');
	}
}

/* End of file menu.php */
/* Location: mis/application/controllers/information/menu.php */
