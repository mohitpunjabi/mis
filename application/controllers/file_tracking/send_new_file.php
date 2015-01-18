<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Send_new_file extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		$this->addJS ("file_tracking/file_tracking_script.js");
	}

	public function index()
	{
		$header['title']="Send New File";
		//Importing helper class, Ask someone
		//$this->load->helper('string');
		$this->load->model("file_tracking/file_details");

		$data['department'] = $this->file_details->get_department_by_id();

		$this->drawHeader ("Send New File");
		$this->load->view('file_tracking/send_new_file/send_new_file',$data);
		$this->drawFooter ();
	}
	public function insert_file_details ($file_sub, $rcvd_emp_id, $remarks)
	{
		$emp_id = $this->session->userdata('id');
		$this->load->helper('string');
		//$track_num = 371235816;
		$track_num = time();
		//$track_num 
		//echo $track_num;
//		$file_sub = $this->input->post ('file_sub');
//		$rcvd_emp_id = $this->input->post ('emp_id');
		$file_status = 0;
		//$timestamp = now();
		$data = array(
				'emp_id' => $emp_id ,
				'file_subject' => $file_sub ,
				'file_status' => $file_status ,
				'track_num'=> $track_num ,
				'remarks' => $remarks
			);
		
		$this->load->model ('file_tracking/file_details', '', TRUE);
		$arr = $this->file_details->insert($data, $track_num);
		$file_id = $arr['file_id'];
		//$track_num = $arr['track_num'];
	
		$this->insert_file_move_details ($file_id, $track_num, $rcvd_emp_id);
		//$this->notification->drawNotification ("", "File Successfully Sent");
	}
	public function insert_move_details ($file_id, $rcvd_emp_id)
	{
		$this->load->model ('file_tracking/File_details', '', TRUE);
		$track_num = $this->file_details->get_track_num ($file_id);
		
		$this->load->model ('file_tracking/File_move_details', '', TRUE);
   		$this->File_move_details->change_rcvd_status ($file_id);
		
		$this->insert_file_move_details ($file_id, $track_num, $rcvd_emp_id);
	}
	public function insert_file_move_details ($file_id, $track_num, $rcvd_emp_id)
	{
		$emp_id = $this->session->userdata('id');
		$data_arr = array (
			'file_id' => $file_id,
			'track_num' => $track_num,
			'sent_by_emp_id' => $emp_id,
			'sent_timestamp' => '',
			'rcvd_by_emp_id' => $rcvd_emp_id,
			'rcvd_timestamp' => '',
			'rcvd_status' => 0
				);

		$this->load->model ('file_tracking/File_move_details', '', TRUE);
		$this->File_move_details->insert ($data_arr);

		$this->notification->notify ($rcvd_emp_id, "emp", "File is Received","", "receive_file/validate_track_num/".$file_id, "");
		$data_arr2['track_num'] = $track_num;
		echo $track_num;
		$this->load->view('file_tracking/send_new_file/send_new_file_ajax2', $data_arr2);
	}
}