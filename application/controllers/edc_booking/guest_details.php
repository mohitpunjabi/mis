<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guest_details extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','stu'));
		
	}
	function index()
	{
		$this->load->model('edc_booking/edc_booking_model');
		$data['applications'] = $this->edc_booking_model->get_alloted_application();
		$total_rows_approved = count($data['applications']);
		//echo $total_rows_approved;
		$this->drawHeader('Add Guest Details');
		$this->load->view('edc_booking/show_alloted_applications',$data);
		$this->drawFooter();
	}
	function edit($app_num='')
	{
		$this->load->model ('edc_booking/edc_booking_model', '', TRUE);
		$data = array();
		$data['app_details'] = $this->edc_booking_model->get_booking_details($app_num);
		$data['room_booking_details'] =  $this->edc_booking_model->get_rooms_for_application($app_num);
		$this->drawHeader('Add Guest Details');
		$this->load->view('edc_booking/add_checkin_checkout',$data);
		$this->drawFooter();

	}
}