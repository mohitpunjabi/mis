<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Send_running_file extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('emp','deo'));
		$this->addJS("file_tracking/file_tracking_script.js");
	}

	public function index($file_id)
	{
		$emp_id = $this->session->userdata('id');
		$header['title']='Send Running File';
		//$header['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/file_tracking/file_tracking_script.js \" ></script>";
		//$this->load->model ('file_tracking/file_move_details');
		//$res = $this->file_move_details->get_pending_files ($emp_id);
		//$data['res'] = $res;
		/*$data = array (
						'res' => $res
					  );*/
		$this->load->model("file_tracking/file_details");
		$data['emp_id'] = $emp_id;
		$data['department'] = $this->file_details->get_department_by_id();
		$data['file_id'] = $file_id;
		$this->drawHeader ("Send Running File");
		//$this->load->view('templates/header',$header);
		$this->load->view('file_tracking/send_running_file/send_running_file',$data);
		//$this->load->view('templates/footer');
		$this->drawFooter ();
	}
	public function get_file_details($file_id)
	{
		$emp_id = $this->session->userdata('id');
		$this->load->model ('file_tracking/file_details');
		$res = $this->file_details->get_file_details($file_id);
		$data = array (
						'res' => $res
					  );
		
		$this->load->view('file_tracking/send_running_file/file_details',$data);
	}
}

/* End of file menu.php */
/* Location: mis/application/controllers/employee/menu.php */
