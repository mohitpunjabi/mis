<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Leave_balance extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp'));
	}
	
	public function index()
	{
		
		
		$this->load->model('leave/leave_balance_model','',TRUE);
		$desc=$this->leave_balance_model->get_leave_balance();
		$data['casual']=$desc[0];
		$data['rh']=$desc[1];
		$data['earned']=$desc[2];
		$data['half_pay']=$desc[3];
		$data['commuted']=$desc[4];
		$data['vacation']=$desc[5];
		$this->drawHeader("Leave Balance");
		$this->load->view('leave/leave_balance_view',$data);
		$this->drawFooter();
	}
}
?>