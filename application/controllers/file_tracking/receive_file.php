<?php 

class Receive_file extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','deo'));
		$this->addJS ("file_tracking/file_tracking_script.js");
	}
	public function index()
	{
		//$this->load->model('employee/Emp_current_entry_model','',TRUE);
		//$data['entry']=$this->Emp_current_entry_model->get_current_entry();
		$emp_id = $this->session->userdata('id');
		$header['title']='Receive File';
		
		$this->load->model('file_tracking/user_notifications');
		$res = $this->user_notifications->get_user_notifications ($emp_id);
		$data = array (
						'res' => $res
					  );
		$this->drawHeader ("Receive File");
		$this->load->view('file_tracking/receive_file/notifications', $data);
		$this->drawFooter ();
	}
	public function validate_track_num ($file_id)
	{
		$header['title']='Send Running File';
		//$header['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/file_tracking/file_tracking_script.js \" ></script>";
		$data = array (
						'file_id' => $file_id
					  );
		$this->drawHeader ("Validate Track Number");
		$this->load->view('file_tracking/receive_file/validate_track_num',$data);
		$this->drawFooter ();
	}
}

/* End of file menu.php */
/* Location: mis/application/controllers/employee/menu.php */
