<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Leave_history extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp'));
	}
	
	public function index()
	{
		$header['title']='Leave History';
		$this->load->view('templates/header',$header);
		$this->load->view('leave/leave_history');
		$this->load->view('templates/footer');
	}
}
?>