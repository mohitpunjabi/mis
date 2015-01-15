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

	public function index()
	{
		//edited
		$data = array();
		$data["result_course"] = $this->basic_model->get_course();
		$data["result_branch"] = $this->basic_model->get_branches();
		$this->drawHeader();
		//$this->load->view('CourseStructure/Edit/edit_home',$data);
		$this->drawFooter();
	}
		
}