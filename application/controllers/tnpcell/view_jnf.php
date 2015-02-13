<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_jnf extends MY_Controller {

	function __construct()
	{
		parent::__construct(array('tpo', 'stu'));
		$this->load->model('course_structure/basic_model','cs_basic_model');
		//$this->load->model('tnpcell/basic_model','tnp_basic_model');
	}
	public function index()
	{
		$data = array();
		$this->load->helper();
		$data['company_info'] = $this->tnp_basic_model->get_all_company_id();
		$this->drawHeader("Select Company");
		$this->load->view('tnpcell/select_company',$data);
		$this->drawFooter();
	}
	public function ViewJNF()
	{
		$data = array();
		$auth_data = $this->session->userdata('auth');
		//var_dump($auth_data);
		//if user is other than student then show contact details in JNF.
		
		if(in_array('tpo',$auth_data))
		{
				
		}
		else
		{
			
		}
		
		$this->drawHeader("View Job Notification Form");
		$this->load->view('tnpcell/view_jnf',$data);
		$this->drawFooter();
	}
 
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>