<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pending_files extends MY_Controller{

	function __construct(){

		parent::__construct(array('emp','deo'));
		$this->addJS("file_tracking/file_tracking_script.js");
	}

	public function index()
	{
		$emp_id = $this->session->userdata('id');
		$header['title']='Pending Files';
		$this->load->model('file_tracking/file_move_details');
		$res = $this->file_move_details->get_pending_files($emp_id);
		//$emp = $this->file_move_details->get_faculty_by_id($emp_id);
		//$emp = array();
		/*foreach($res->result() as $row){
			$row->sent_by_emp_id = get_faculty_by_id($row->sent_by_emp_id);
		}*/
		$data['res'] = $res;
		//$data['emp'] = $emp;
		/*$data = array (
						'res' => $res
					  );*/
		$this->drawHeader ("Pending Files");
		$this->load->view('file_tracking/pending_files/pending_files',$data);
		$this->drawFooter ();
	}
}