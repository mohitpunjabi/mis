<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Allot_date extends MY_Controller {

	function __construct()
	{
		parent::__construct(array('tpo'));
		$this->load->model('course_structure/basic_model','',true);
		$this->load->model('tnpcell/tnp_basic_model','',true);
	}
	public function index()
	{
		$data = array();
		$data['company_basic_info'] = $this->tnp_basic_model->get_company_basic_details("");
		$this->drawHeader("Manage Training and Placement Calender");
		$this->load->view('tnpcell/allot_date',$data);
		$this->drawFooter();
	}
 
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>