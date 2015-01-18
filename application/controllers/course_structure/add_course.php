<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_course extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo'));
		
		$this->addJS("course_structure/add.js");
		$this->addJS("course_structure/edit.js");
		$this->addCSS("course_structure/cs_layout.css");
		$this->load->library('session');
	}

	public function index($error='')
	{
		$data=array();
    $this->drawHeader();
		$this->load->view('course_structure/add_course',$data);
		$this->drawFooter();
	}
	public function add()
  {
    $this->load->model('course_structure/course_model','',TRUE);
    $course_details['id'] = $this->input->post("course_id");
    $course_details['name'] = $this->input->post("course_name");
    $course_details['duration'] = $this->input->post("course_duration");
    $data['error'] = $this->course_model->insert($course_details);
    $this->session->set_flashdata("flashSuccess","Course added successfully");
    redirect("course_structure/add_course");
  }
}
?>