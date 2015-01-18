<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Close_file extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('emp','deo'));
		$this->addJS ("file_tracking/file_tracking_script.js");
	}

	public function index($file_id)
	{
		$emp_id = $this->session->userdata('id');
		$header['title']='Close File';
		//$header['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/file_tracking/file_tracking_script.js \" ></script>";
		$this->load->model ('file_tracking/file_move_details');
		$res = $this->file_move_details->get_pending_files ($emp_id);
		$data['res'] = $res;
		$data['file_id'] = $file_id;

		/*$data = array (
						'res' => $res
					  );*/
		
		//$this->load->model('employee/Emp_current_entry_model','',TRUE);
		//$data['entry']=$this->Emp_current_entry_model->get_current_entry();
		$header['title']='Close File';
		$this->drawHeader ("Close File");
		$this->load->view('file_tracking/close_file/close_file',$data);
		$this->drawFooter ();
	}
	public function get_file_details($file_id)
	{
		$emp_id = $this->session->userdata('id');
		$this->load->model ('file_tracking/file_basic_details');
		$res = $this->file_basic_details->get_file_details ($file_id);
		$data = array (
						'res' => $res
					  );
		
		$this->load->view('file_tracking/close_file/file_details',$data);
	}
	public function insert_close_details ($file_id)
	{
		$emp_id = $this->session->userdata('id');
		
		$this->load->model ('file_tracking/file_closed_details');
		$this->load->model ('file_tracking/file_basic_details');
		$this->load->model ('file_tracking/file_move_details');
		
		$track_num = $this->file_basic_details->get_track_num ($file_id);
		$this->file_closed_details->insert ($file_id, $emp_id, $track_num);
		$this->file_move_details->change_rcvd_status ($file_id);
		$this->file_basic_details->change_file_status ($file_id);

		$this->load->view('file_tracking/close_file/close_file_notification');
	}
}

/* End of file menu.php */
/* Location: mis/application/controllers/employee/menu.php */
