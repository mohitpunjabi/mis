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
			$data['type'] = $row->type;
			//$data_array[$sno][$j++] = $row->pref_time;
			//$sno++;
		}
	
		$this->drawHeader ("Complaint Details");
		$this->load->view('complaint/supervisor/complaint_details',$data);
		$this->drawFooter();		
	}
	
	public function update_complaint_details ($complaint_id, $type)
	{
		$this->load->model ('complaint/complaint_details', '', TRUE);
		$status = $this->input->post('status');
		$fresh_action = $this->input->post('fresh_action');
     	$action_taken = $this->complaint_details->get_remarks($complaint_id);

		$date = date('Y/m/d H:i:s');
		
		if ($action_taken == "NA")
			$fresh_action = $date." : ".$fresh_action;
		else
			$fresh_action = $action_taken."<br/>".$date." : ".$fresh_action;

		$this->complaint_details->update_complaint($complaint_id, $status, $fresh_action);		
		$this->session->set_flashdata('flashSuccess','Complaint : '.$complaint_id.' successfully processed');
		redirect('complaint/supervisor/open_complaint_list/'.$type);
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
			$data_array[$sno][$j++] = $row->location_details;
			$data_array[$sno][$j++] = $row->problem_details;
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
		$this->load->model ('complaint/complaint_details', '', TRUE);
		$status = "Closed";
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
			$data_array[$sno][$j++] = $row->location_details;
			$data_array[$sno][$j++] = $row->problem_details;
			$data_array[$sno][$j++] = $row->remarks;
			//$data_array[$sno][$j++] = $row->pref_time;
			$sno++;
		}
	
		$data['data_array'] = $data_array;
		$data['total_rows'] = $total_rows;
		
		if ($total_rows == 0)
		{
			$this->drawHeader ("Closed Complaint not found");
			$this->drawFooter();
		}
		else 
		{
			$this->drawHeader ("Closed Complaint List");
			$this->load->view('complaint/supervisor/view_closed_complaint', $data);
			$this->drawFooter();
		}
	}

	public function view_rejected_complaint($supervisor)
	{
		$this->load->model ('complaint/complaint_details', '', TRUE);
		$status = "Rejected";
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
			$data_array[$sno][$j++] = $row->location_details;
			$data_array[$sno][$j++] = $row->problem_details;
			$data_array[$sno][$j++] = $row->remarks;
			//$data_array[$sno][$j++] = $row->pref_time;
			$sno++;
		}
	
		$data['data_array'] = $data_array;
		$data['total_rows'] = $total_rows;
		
		if ($total_rows == 0)
		{
			$this->drawHeader ("Rejected Complaint not found");
			$this->drawFooter();
		}
		else 
		{
			$this->drawHeader ("Rejected Complaint List");
			$this->load->view('complaint/supervisor/view_rejected_complaint', $data);
			$this->drawFooter();
		}
	}

	public function view_all_complaint($supervisor)
	{
		$this->load->model ('complaint/complaint_details', '', TRUE);
		$res = $this->complaint_details->all_complaint_list($supervisor);
		
		$this->load->model('user_model', '', TRUE);
		
		$total_rows = $res->num_rows();
		$data_array = array();
		$sno = 1;
		foreach ($res->result() as $row)
		{
			$data_array[$sno]=array();
			$j=1;
			$data_array[$sno][$j++] = $row->complaint_id;
			$data_array[$sno][$j++] = $row->status;
			$data_array[$sno][$j++] = $this->user_model->getNameById($row->user_id);
			$data_array[$sno][$j++] = $row->date_n_time;
			$data_array[$sno][$j++] = $row->location;
			$data_array[$sno][$j++] = $row->location_details;
			$data_array[$sno][$j++] = $row->problem_details;
			$data_array[$sno][$j++] = $row->remarks;
			//$data_array[$sno][$j++] = $row->pref_time;
			$sno++;
		}
	
		$data['data_array'] = $data_array;
		$data['total_rows'] = $total_rows;
		
		if ($total_rows == 0)
		{
			$this->drawHeader ("No Complaint found");
			$this->drawFooter();
		}
		else 
		{
			$this->drawHeader ("All Complaint List");
			$this->load->view('complaint/supervisor/view_all_complaint', $data);
			$this->drawFooter();
		}
	}
}