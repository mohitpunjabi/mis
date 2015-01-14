<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('deo'));
		$this->load->library('session');
		$this->load->model('CourseStructure/basic_model','',TRUE);
	}
	public function index()
	{
		$data = array();
		$data["result_course"] = $this->basic_model->get_course();
		$data["result_branch"] = $this->basic_model->get_branches();
		$this->drawHeader();
		$this->load->view('CourseStructure/edit',$data);
		$this->drawFooter();
	}
	
	public function ViewCourseStructure()
	{
		$data = array();
		$data["result_course"] = $this->basic_model->get_course();
		$data["result_branch"] = $this->basic_model->get_branches();
		$this->drawHeader("Course structure");  // TODO: Make titles more appropriate
		$this->load->view('CourseStructure/edit',$data);
		$this->drawFooter();
	}
	
}