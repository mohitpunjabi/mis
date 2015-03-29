<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room_allotment extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('edc_ctk'));
		$this->addJS("edc_booking/booking.js");
	}
	function ctk_action($app_num)
	{
		$this->load->model ('edc_booking/edc_allotment_model', '', TRUE);
		$res = $this->edc_allotment_model->get_app_details($app_num);
		$data = array();
		//print_r($res);
		foreach($res as $row)
		{
			$data['check_in'] = date('j M Y g:i A', strtotime($row['check_in']));
			$data['check_out'] = date('j M Y g:i A', strtotime($row['check_out']));
		}
		$data['app_num'] = $app_num;
		$this->drawHeader ("Room Allotment");
		$this->load->view('edc_booking/edc_allotment_view',$data);
		$this->drawFooter();
	}
	function get_floor_plans($building)
	{
		$this->load->model ('edc_booking/edc_allotment_model', '', TRUE);
		$res = $this->edc_allotment_model->get_floors($building);
		$data = array();
		$data['floor_array'] = $res;
		//print_r($res);
		$this->load->view('edc_booking/edc_floor',$data);
	}
	function get_room_plans($building,$floor,$check_in,$check_out)
	{
		$this->load->model ('edc_booking/edc_allotment_model', '', TRUE);

		$result_uavail_rooms = $this->edc_allotment_model->check_unavail($check_in,$check_out);
		//print_r($res);
		//$data['app_detail'] = $result_avail_rooms;
		//$result_booked_history = $this->edc_allotment_model->booking_history($result_avail_rooms);

		//print_r($result_booked_history);
		$result_floor_wise = $this->edc_allotment_model->get_rooms($building,$floor);
		//print_r($result_floor_wise);
		$data_array = array();
		$sno=1;
		foreach($result_floor_wise as $row)
		{
				$flag=0;
			foreach($result_uavail_rooms as $room_unavailable)
			{
				if($row['id']==$room_unavailable['room_id'])
					$flag = 1;
			}
			if($flag==0)
			{
				$data_array[$sno][0] = $row['id'];
				$data_array[$sno++][1] = $row['room_no'];
			}
		}
		$data['room_array'] = $data_array;
		//print_r($res);
		$this->load->view('edc_booking/edc_rooms',$data);
	}
	function insert_edc_allotment()
	{
		$room_list = $this->input->post('room_list');
		$app_num = $this->input->post('app_num');

		$this->load->model('edc_booking/edc_allotment_model');
		foreach($room_list as $room)
		{
			$input_data = array(
				'app_num' => $app_num,
				'room_id'	=> $room,
			);
			$this->edc_allotment_model->insert_booking_details ($input_data);
		}
		$this->load->model ('user_model');
		$res = $this->user_model->getUsersByDeptAuth('all', 'pce');
		$pce = '';
		foreach ($res as $row)
			$pce = $row->id;
		$this->notification->notify ($pce, "pce", "Approve/Reject Pending Request", "EDC Room Booking Request (Application No. : ".$app_num." ) is Pending for your approval.", "edc_booking/booking_request/details/".$app_num."/pce", "");
		$this->session->set_flashdata('flashSuccess','Room Allotment has been done successfully.');
		redirect('home');

	}

}
