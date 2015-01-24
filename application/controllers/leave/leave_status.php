<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Leave_status extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp'));
	}
	
	public function index()
	{
		$this->drawHeader("Leave Status");
		$this->load->view('leave/leave_status');
		$this->drawFooter();
	}
}
?>