<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_prev extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('hod','est_ar','exam_dr','dt','dsw'));
	}

	public function index()
	{
		$header['title']='Search Previous Versions of Notice, Circular or Minutes';
		$this->load->view('templates/header',$header);
		$this->load->view('information/search_prev_menu');
		$this->load->view('templates/footer');
	}
}

/* End of file search_prev.php */
/* Location: mis/application/controllers/information/search_prev.php */
