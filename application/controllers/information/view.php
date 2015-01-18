<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('emp','stu'));
	}

	public function index()
	{
		$header['title']='View Notice, Minutes or Circular';
		$this->load->view('templates/header',$header);
		$this->load->view('information/view');
		$this->load->view('templates/footer');
	}
}

/* End of file view.php */
/* Location: mis/application/controllers/information/view.php */
