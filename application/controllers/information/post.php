<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('hod','est_ar','exam_dr','dt','dsw'));
	}

	public function index()
	{
		//$header['title']='Post Notice, Minutes or Circular';
		$this->drawHeader("Post Notice, Minutes or Circular");
		$this->load->view('information/post');
		$this->drawFooter();
	}
}

/* End of file post.php */
/* Location: mis/application/controllers/information/post.php */
