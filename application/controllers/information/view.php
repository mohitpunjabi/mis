<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		//$header['title']='View Notice, Minutes or Circular';
		$this->drawHeader("View Notice, Minutes or Circular");
		$this->load->view('information/view');
		$this->drawFooter();
	}
}

/* End of file view.php */
/* Location: mis/application/controllers/information/view.php */
