<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Supervisor extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','stu'));
//		$this->addJS ("file_tracking/file_tracking_script.js");
//		$this->addCSS("file_tracking/file_tracking_layout.css");
	}

	public function complaint_details ($complaint_id)
	{
		$this->load->model ('complaint/complaint_details', '', TRUE);
		$res = $this->complaint_details->get_complaint_details($complaint_id);
		
		$this->load->model('user_model', '', TRUE);
		
		//$total_rows = $res->num_rows();
		$data = array();
		//$sno = 1;
		foreach ($res->result() as $row)
		{
			//$data_array[$sno]=array();
			$j=1;
			$data['complaint_id'] = $row->complaint_id;
			$data['complaint_by'] = $this->user_model->getNameById($row->user_id);
			$data['date_n_time'] = $row->date_n_time;
			$data['location'] = $row->location;
			$data['location_details'] = urldecode($row->location_details);
			$data['problem_details'] = urldecode($row->problem_details);
			$data['pref_time'] = $row->pref_time;
			//$data['status'] = $row->status;
			$data['remarks'] = $row->remarks;
			
			$data['mobile'] = 9000000000;
			$data['email'] = $this->user_model->getEmailById($row->user_id);
			//$data_array[$sno][$j++] = $row->pref_time;
			//$sno++;
		}
	
		$this->drawHeader ("Complaint Details");
		$this->load->view('complaint/supervisor/complaint_details',$data);
		$this->drawFooter();		
	}
	
	public function update_complaint_details ($complaint_id)
	{
		$status = $this->input->post('status');
     	$action_taken = $this->input->post('action_taken');
		$fresh_action = $this->input->post('fresh_action');
		
		$date = date('Y/m/d H:i:s');
		$fresh_action = $date." : ".$fresh_action;
		
		/*echo $status."<br>";
		echo $action_taken."<br>";
		echo $fresh_action."<br>";*/
	}
	
	public function open_complaint_list($supervisor)
	{
		$this->load->model ('complaint/complaint_details', '', TRUE);
		$status = "Under Processing";
		$res = $this->complaint_details->complaint_list($status, $supervisor);
		
		$this->load->model('user_model', '', TRUE);
		
		$total_rows = $res->num_rows();
		$data_array = array();
		$sno = 1;
		foreach ($res->result() as $row)
		{
			$data_array[$sno]=array();
			$j=1;
			$data_array[$sno][$j++] = $row->complaint_id;
			$data_array[$sno][$j++] = $this->user_model->getNameById($row->user_id);
			$data_array[$sno][$j++] = $row->date_n_time;
			$data_array[$sno][$j++] = $row->location;
			$data_array[$sno][$j++] = urldecode($row->location_details);
			$data_array[$sno][$j++] = urldecode($row->problem_details);
			$data_array[$sno][$j++] = $row->remarks;
			//$data_array[$sno][$j++] = $row->pref_time;
			$sno++;
		}
	
		$data['data_array'] = $data_array;
		$data['total_rows'] = $total_rows;
		
		if ($total_rows == 0)
		{
			$this->drawHeader ("No Complaints registered");
			$this->drawFooter();
		}
		else 
		{
			$this->drawHeader ("List of all Complaints");
			$this->load->view('complaint/supervisor/open_complaint_list',$data);
			$this->drawFooter();
		}
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