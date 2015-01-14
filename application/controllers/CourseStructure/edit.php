<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo'));
		$this->load->library('session');
		$this->load->model('CourseStructure/basic_model','',TRUE);
	}

	public function index($error='')
	{
		//edited
		$data = array();
		$data["result_course"] = $this->basic_model->get_course();
		$data["result_branch"] = $this->basic_model->get_branches();
		$this->drawHeader();
		$this->load->view('CourseStructure/Edit/edit',$data);
		$this->drawFooter();
	}
	
	public function ViewCourseStructure()
	{
		$data = array();
		$data["CS_session"]['course_name'] = $this->input->post("course");
		$data["CS_session"]['branch'] = $this->input->post("branch");
		$data["CS_session"]['semester'] = $this->input->post("sem");
		$data["CS_session"]['session'] = $this->input->post("session");
		
		$course = $data["CS_session"]['course_name'];
		$branch = $data["CS_session"]['branch'];
		$semester = $data["CS_session"]['semester'];
		$session = $data["CS_session"]['session'];
		
		$aggr_id = $course.'_'.$branch.'_'.$session;
		
		$result_common_all_subjects_sorted = $this->
		
		
		$this->session->set_userdata($data);
		
		$this->drawHeader("Course structure");  
		$this->load->view('CourseStructure/print_cs',$data);
		$this->drawFooter();
	}
	
}