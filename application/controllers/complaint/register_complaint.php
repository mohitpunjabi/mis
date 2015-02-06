<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Register_complaint extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','stu'));
	//	$this->addJS ("file_tracking/file_tracking_script.js");
	//	$this->addCSS("file_tracking/file_tracking_layout.css");
	}

	public function index()
	{
//		$this->load->model("file_tracking/file_details");

//		$data['department'] = $this->file_details->get_department_by_id();

		$this->drawHeader ("Register your Complaint");
		$this->load->view('complaint/register_complaint');
		$this->drawFooter ();
	}
	public function insert ()
	{
		$type = $this->input->post('type');
     	$location = $this->input->post('location');
		$location_details = $this->input->post('locationDetails');
		$pref_time = $this->input->post('time');
		$problem_details = $this->input->post('problemDetails');
		
		$user_id = $this->session->userdata('id');
		$complaint_id = time();
		$complaint_id = $type."_".$complaint_id.$user_id;
		$data = array(
				'user_id' => $user_id,
				'type' => $type,
				'location'=> $location,
				'location_details' => $location_details, 
				'problem_details' => $problem_details,	  
				'pref_time' => $pref_time,	  
				'complaint_id' => $complaint_id	  
					  );
		
		$this->load->model ('complaint/complaint_details', '', TRUE);
		$this->complaint_details->insert($data);

		$this->drawHeader ("View Closed Complaint List");
		$this->drawFooter ();		

/*		echo $type."<br>";
		echo $location."<br>";
		echo $location_details."<br>";
		echo $pref_time."<br>";
		echo $problem_details."<br>";
		echo $user_id."<br>";
		echo $complaint_id."<br>";*/
	}
}