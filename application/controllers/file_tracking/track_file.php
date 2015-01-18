<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Track_file extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('emp','deo'));
		$this->addJS("file_tracking/file_tracking_script.js");
	}

	public function index()
	{
		//$this->load->model('employee/Emp_current_entry_model','',TRUE);
		//$data['entry']=$this->Emp_current_entry_model->get_current_entry();
		$emp_id = $this->session->userdata('id');
		$header['title']='File Tracking';
		$this->load->model('file_tracking/file_move_details');
		$res = $this->file_move_details->files_to_be_tracked($emp_id);
		$data['res'] = $res;
		//$header['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/file_tracking/file_tracking_script.js \" ></script>";	
			
		//$this->load->view('templates/header',$header);
		$this->drawHeader ("File Tracking");
		$this->load->view('file_tracking/track_file/track_file',$data);
		$this->drawFooter ();
	}
	public function validate_track_num ($track_num)
	{
		$this->load->model ('file_tracking/file_details');
		$res = $this->file_details->get_file_id ($track_num);
		if(!$res || $res->num_rows() == 0) 
			$this->notification->drawNotification("Enter valid Track Number", "");
		else
		{
			foreach($res->result() as $row) 
			{
				$file_id = $row->file_id;
				$file_subject = $row->file_subject;
				$file_status = $row->file_status;
				$emp_id = $row->emp_id;
			}
			$this->load->model ('file_tracking/file_move_details');
			$result = $this->file_move_details->get_move_details ($file_id);
			$data = array (
						'file_id' => $file_id,
						'file_subject' => $file_subject,
						'file_status' => $file_status,
						'emp_id' => $emp_id,
						'result' => $result
						  );
			$this->load->view ('file_tracking/track_file/track_table', $data);
		}
	}
	public function validate_track_number ($track_num)
	{
		$this->load->model ('file_tracking/file_details');
		$res = $this->file_details->get_file_id($track_num);
		$file = $res->row();
		if(!$res || $res->num_rows() == 0) 
			$this->notification->drawNotification("Enter valid Track Number", "");
		else
		{
			$emp_id = $this->session->userdata('id');
			$res = $this->file_details->get_file_details($file->file_id);
			$data = array (
							'res' => $res
						  );
			
			$this->load->view('file_tracking/send_running_file/file_details',$data);
		}
	}
}

/* End of file menu.php */
/* Location: mis/application/controllers/employee/menu.php */
