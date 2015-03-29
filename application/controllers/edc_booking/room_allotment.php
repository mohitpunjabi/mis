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
			$data['single_AC'] = $row['single_AC'];
			$data['double_AC'] = $row['double_AC'];
			$data['suite_AC'] = $row['suite_AC'];
		}
		$data['app_num'] = $app_num;
		$total_alloc_rooms = $this->edc_allotment_model->get_allocated_rooms($app_num);
		$data['total_alloc_rooms'] = $total_alloc_rooms;
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
	function get_room_plans($building,$check_in,$check_out)
	{
		$this->load->model ('edc_booking/edc_allotment_model', '', TRUE);

		$result_uavail_rooms = $this->edc_allotment_model->check_unavail($check_in,$check_out);
		//print_r($res);
		//$data['app_detail'] = $result_avail_rooms;
		//$result_booked_history = $this->edc_allotment_model->booking_history($result_avail_rooms);
		$floor_array = $this->edc_allotment_model->get_floors($building);
		//print_r($result_booked_history);
		$flr = 1;
		foreach($floor_array as $floor)
		{
			$result_floor_wise[$flr][0] = $this->edc_allotment_model->get_rooms($building,$floor['floor']);
			$result_floor_wise[$flr++][1] = $floor['floor'];
		}
		//print_r($result_floor_wise);
		$data_array = array();
		//for($i = 1; $i < $flr; $i++)
		$i = 0;
		foreach($result_floor_wise as $floor)
		{
			$sno=1;
			$data_array[$i][0] = $floor[1];
			foreach($floor[0] as $row)
			{
					$flag=0;
				foreach($result_uavail_rooms as $room_unavailable)
				{
					if($row['id']==$room_unavailable['room_id'])
						$flag = 1;
				}
				if($flag==0)
				{
					$data_array[$i][$sno][0] = $row['id'];
					$data_array[$i][$sno][1] = $row['room_no'];
					$data_array[$i][$sno++][2] = $row['room_type'];
				}
			}
			$i++;
		}
		//print_r($data_array);
		$data['floor_room_array'] = $data_array;
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
