<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guest_details extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','stu'));
		
	}
	function get_guests ($app_num)
	{
		$this->load->model('edc_booking/edc_booking_model');
		$res = $this->edc_booking_model->get_guest_details ($app_num);
		$data['guests'] = $res;
		$this->drawHeader('Guest Details');
		$room_allocated = 0;
		foreach ($res as $row) {
			if ($row['room_alloted'])
				$room_allocated = 1;
			break;
		}
		$data['room_allocated'] = $room_allocated;
		$data['app_num'] = $app_num;
		$this->load->view('edc_booking/guest_list',$data);
		$this->drawFooter();
	}	
}