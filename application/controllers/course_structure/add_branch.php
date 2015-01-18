<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_branch extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo'));
		
		$this->addJS("course_structure/add.js");
		$this->addJS("course_structure/edit.js");
		$this->addCSS("course_structure/cs_layout.css");
		$this->load->library('session');
		$this->load->model('course_structure/branch_model','',TRUE);
	}

	public function index($error='')
	{
		$data=array();
    $this->drawHeader();
		$this->load->view('course_structure/add_branch',$data);
		$this->drawFooter();
	}
  
  public function add()
  {
    $this->load->model('course_structure/branch_model','',TRUE);
    $branch_details['id'] = $this->input->post("branch_id");
    $branch_details['name'] = $this->input->post("branch_name");
    $data['error'] = $this->branch_model->insert($branch_details);
    $this->session->set_flashdata("flashSuccess","Branch added successfully");
    redirect("course_structure/add_branch");
  }
}
?>