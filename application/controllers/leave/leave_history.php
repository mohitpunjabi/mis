<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Leave_history extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp'));
	}
	
	public function index()
	{
		$this->drawHeader("Leave History");
		$this->load->view('leave/leave_history');
		$this->drawFooter();
	}
}
?>