<?php 

class Send_new_file_ajax extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// Will never be used
	}

	public function get_dept()
	{
		$this->load->model('departments_model','',TRUE);
		$data['dept'] = $this->departments_model->get_departments ();
		$this->load->view('file_tracking/send_new_file/send_new_file_ajax',$data);
	}
//	public function get_track_num ($file_id)
//	{
//		$this->load->model('file_details', '', TRUE);
//		$data['track_num'] = $this->get_track_num ($file_id);
//		$this->load->view('file_tracking/send_new_file/send_new_file_ajax2', $data);
//	}
	public function get_faculty_name_by_department_id($dept_id)
	{
		$this->load->model('file_tracking/file_details');
		$data['faculty'] = $this->file_details->get_faculty_by_department_id($dept_id);
		$this->load->view('file_tracking/send_new_file/send_new_file_faculty_name',$data);
	}
}