<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_coursebranch extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo'));
		
		//$this->addJS("course_structure/add.js");
		$this->addJS("course_structure/edit.js");
		$this->addCSS("course_structure/cs_layout.css");
		$this->load->library('session');
		$this->load->model('course_structure/basic_model','',TRUE);
	}

	public function index($error='')
	{
		$data = array();
		$data["result_course"] = $this->basic_model->get_course();
		$data["result_branch"] = $this->basic_model->get_branches();
		$this->drawHeader();
		$this->load->view('course_structure/add_coursebranch',$data);
		$this->drawFooter();
	}
  public function add()
  {
    $this->load->model('course_structure/coursebranch_model','',TRUE);
    $cb_details['course_id'] = $this->input->post("course");
    $cb_details['branch_id'] = $this->input->post("branch");
    $cb_details['year'] = $this->input->post("year");
    $cb_details['aggr_id']= $cb_details['course_id'].'_'.$cb_details['branch_id'].'_'.$cb_details['year'];
    $data['error'] = $this->coursebranch_model->insert($cb_details);
    $this->session->set_flashdata("flashSuccess","Course Branch Combination added successfully");
    redirect("course_structure/add_coursebranch");
  }
}
?>