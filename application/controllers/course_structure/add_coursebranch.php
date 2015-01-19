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
    $data["result_dept"]= $this->basic_model->get_depts();
		$this->drawHeader();
		$this->load->view('course_structure/add_coursebranch',$data);
		$this->drawFooter();
	}
  public function add()
  {
    $this->load->model('course_structure/coursebranch_model','',TRUE);
    $cb_details2['course_id'] = $this->input->post("course");
    $cb_details2['branch_id'] = $this->input->post("branch");
    $cb_details2['year'] = $this->input->post("year");
    $cb_details1['dept_id'] = $this->input->post("dept");
    $cb_details2['aggr_id']= $cb_details2['course_id'].'_'.$cb_details2['branch_id'].'_'.$cb_details2['year'];
    $cb_details1['aggr_id']= $cb_details2['aggr_id'];
    $data['error']= $this->coursebranch_model->insert_deptoffers($cb_details1);
    $data['error'] = $this->coursebranch_model->insert_coursebranch($cb_details2);
    $this->session->set_flashdata("flashSuccess","Course Branch Combination added successfully");
    redirect("course_structure/add_coursebranch");
  }
}
?>