<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map_dept extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo'));
		$this->addJS("course_structure/edit.js");
		$this->addCSS("course_structure/cs_layout.css");
		$this->load->model('course_structure/basic_model','',TRUE);
	}

	public function index($error='')
	{
		$data=array();
		$data['result_course'] = $this->basic_model->get_course();
		$data['result_branch'] = $this->basic_model->get_branches();
		$data['result_dept'] = $this->basic_model->get_depts();
		
    	$this->drawHeader();
		$this->load->view('course_structure/map_dept',$data);
		$this->drawFooter();
	}
  
  public function add()
  { 
    $course = $this->input->post("course");
    $branch = $this->input->post("branch");
	$session = $this->input->post("session");
	$dept_id = $this->input->post("dept");
	
	$aggr_id = $course."_".$branch."_".$session;
	if($this->basic_model->select_map_dept_with_aggr_id($dept_id,$aggr_id) > 0)
		$this->session->set_flashdata("flashError","This Mapping Already Exist.");
	else
	{
		$dept_course['dept_id'] = $dept_id;
		$dept_course['aggr_id'] = $aggr_id;
		$this->basic_model->insert_map_dept_with_aggr_id($dept_course);
		$this->session->set_flashdata("flashSuccess","Mapping Created Successfully.");
	}
	
	
    redirect("course_structure/map_dept");
  }
}
?>