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
		$this->load->model('course_structure/course_model','',TRUE);
	}

	public function index($error='')
	{
		$data=array();
		$data['result_course'] = $this->basic_model->get_course();
    	$this->drawHeader();
		$this->load->view('course_structure/map_dept',$data);
		$this->drawFooter();
	}
  
  public function add()
  {
    
    $branch_details['id'] = $this->input->post("branch_id");
    $branch_details['name'] = $this->input->post("branch_name");
	
	$course_branch_details['course_id'] = $this->input->post("course");
	$course_branch_details['branch_id'] = $branch_details['id'];
	$course_branch_details['year'] = $this->input->post("year");
	$course_branch_details['aggr_id'] = $course_branch_details['course_id']."_".$course_branch_details['branch_id']."_".$course_branch_details['year'];
	
	$course_aggr['dept_id'] = $this->input->post("dept");
	$course_aggr['aggr_id'] = $course_branch_details['aggr_id'];
	
    $result_branch = $this->basic_model->get_branch_details_by_id($branch_details['id']);
	
	if(!$result_branch)
	{
		$result_insert_branch = $this->course_model->insert_branch($branch_details);
		if($result_insert_branch)
		{
			$result_course_branch = $this->basic_model->insert_course_branch($course_branch_details);
			if($result_course_branch)
				$this->session->set_flashdata("flashSuccess","Branch added and mapping done successfully.");	
			else
				$this->session->set_flashdata("flashError","Error in Mapping Branch.");	
				$result_insert_overall = true;	
		}
		else
			$this->session->set_flashdata("flashError","Error in Adding Branch.");
	}
	else
	{
		if(!$this->basic_model->select_course_branch($course_branch_details['aggr_id']))
		{
			$result_course_branch = $this->basic_model->insert_course_branch($course_branch_details);
		
			if($result_course_branch)
				$this->session->set_flashdata("flashSuccess","Course and Branch mapping done successfully.");	
			else
				$this->session->set_flashdata("flashError","Error in Mapping Branch.");		
		}
		else
			$this->session->set_flashdata("flashError","Mapping Already Exist.");		
		
	}
	
	
    redirect("course_structure/add_branch");
  }
}
?>