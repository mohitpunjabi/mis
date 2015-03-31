<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student_rejected extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('acad_da1'));
	}

	function index()
	{
		$this->load->model('student/student_rejected_detail_model','',TRUE);
		$data["rejected_users"] = $this->student_rejected_detail_model->get_all_stu_status_details();
		$this->addJS('student/rejected_student_script.js');
		$this->drawHeader('Select Student To Edit Details');
		$this->load->view('student/edit/rejected_student_list',$data);
		$this->drawFooter();
	}

	function loadRejectedUsers()
	{
		$this->load->model('student/student_rejected_detail_model','',TRUE);
		$this->load->view('student/edit/rejected_student_table',array("rejected_users" => $this->student_rejected_detail_model->get_all_stu_status_details()));
	}

	function fetch_stu_details()
	{
		$stu_id = $this->input->post('stu_id');
		redirect('student/student_edit/open_edit_form/'.$stu_id);
	}

}