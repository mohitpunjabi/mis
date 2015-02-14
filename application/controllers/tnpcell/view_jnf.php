<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_jnf extends MY_Controller {

	function __construct()
	{
		parent::__construct(array('tpo', 'stu'));
		$this->load->model('tnpcell/basic_model','',TRUE);
	}
	public function index()
	{
		$this->load->helper();
    	$this->drawHeader();
		$this->load->view('tnpcell/view_jnf');
		$this->drawFooter();
	}
 
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>