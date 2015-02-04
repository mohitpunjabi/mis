<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_complaint extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','stu'));
//		$this->addJS ("file_tracking/file_tracking_script.js");
//		$this->addCSS("file_tracking/file_tracking_layout.css");
	}

	public function index()
	{
//		$this->load->model("file_tracking/file_details");

//		$data['department'] = $this->file_details->get_department_by_id();

		$this->drawHeader ("View all your Complaint");
		$this->load->view('complaint/view_complaint');
		$this->drawFooter ();
	}
}