<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Supervisor extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','stu'));
//		$this->addJS ("file_tracking/file_tracking_script.js");
//		$this->addCSS("file_tracking/file_tracking_layout.css");
	}

	public function open_complaint_list($supervisor)
	{
//		$this->load->model("file_tracking/file_details");

//		$data['department'] = $this->file_details->get_department_by_id();
		$this->drawHeader ("Open Complaint List");
		$this->load->view('complaint/supervisor/open_complaint_list');
		$this->drawFooter ();
	}

	public function view_closed_complaint($supervisor)
	{
		$this->drawHeader ("View Closed Complaint List");
		$this->load->view('complaint/supervisor/view_closed_complaint');
		$this->drawFooter ();		
	}

	public function view_rejected_complaint($supervisor)
	{
		$this->drawHeader ("View Rejected Complaint List");
		$this->load->view('complaint/supervisor/view_rejected_complaint');
		$this->drawFooter ();				
	}

	public function view_all_complaint($supervisor)
	{
		$this->drawHeader ("View All Complaint List");
		$this->load->view('complaint/supervisor/view_all_complaint');
		$this->drawFooter ();				
	}

}