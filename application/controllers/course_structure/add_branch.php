<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_branch extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo'));
		
		$this->addJS("course_structure/add.js");	
		$this->load->library('session');
		$this->load->model('course_structure/basic_model','',TRUE);
	}

	public function index($error='')
	{
		$data=array();
		$data['result_course'] = $this->basic_model->get_course();
		$data['result_dept'] = $this->basic_model->get_depts();	
    	$this->drawHeader("Add or Map a Branch with Course");
		$this->load->view('course_structure/add_branch',$data);
		$this->drawFooter();
	}
  
  public function add()
  {
    
    $branch_details['id'] = $this->input->post("branch_id");
	$branch_details['id'] = strtolower(trim($branch_details['id']));
    $branch_details['name'] = $this->input->post("branch_name");
	
	$course_branch_details['course_branch_id'] = uniqid();
	$course_branch_details['course_id'] = $this->input->post("course");
	$course_branch_details['branch_id'] = $branch_details['id'];
	$course_branch_details['year_starting'] = $this->input->post("year");
	$course_branch_details['year_ending'] = 0;
	
	$aggr_id = $course_branch_details['course_id']."_".$course_branch_details['branch_id']."_".$course_branch_details['year_starting'];
	
	$dept_course_details['course_branch_id'] = $course_branch_details['course_branch_id'];
	$dept_course_details['dept_id'] = $this->input->post("dept");
	$dept_course_details['aggr_id'] = $aggr_id;
	$dept_course_details['date'] = date('Y-m-d');

	
    $result_branch = $this->basic_model->get_branch_details_by_id($branch_details['id']);
	
	if(!$result_branch)	//if branch does not exist then insert it first.
	{
		$result_insert_branch = $this->basic_model->insert_branch($branch_details);
		if($result_insert_branch)
		{
			$result_course_branch = $this->basic_model->insert_course_branch($course_branch_details);
			if($result_course_branch)
			{
				$result_dept_course = $this->basic_model->insert_dept_course($dept_course_details);
				if($result_dept_course)
					$this->session->set_flashdata("flashSuccess","Branch added and mapping done successfully.");
				else
						$this->session->set_flashdata("flashError","Error in mapping department.");
			}
				
			else
				$this->session->set_flashdata("flashError","Error in Mapping Branch.");	
				$result_insert_overall = true;	
		}
		else
			$this->session->set_flashdata("flashError","Error in Adding Branch.");
	}
	else
	{
		if(!$this->basic_model->select_course_branch($course_branch_details['course_id'],$course_branch_details['branch_id']))
		{
			$result_course_branch = $this->basic_model->insert_course_branch($course_branch_details);
		
			if($result_course_branch)
			{
				$result_dept_course = $this->basic_model->insert_dept_course($dept_course_details);
				if($result_dept_course)
					$this->session->set_flashdata("flashSuccess","Mapping done successfully.");	
				else
						$this->session->set_flashdata("flashError","Error in mapping department.");	
			}
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