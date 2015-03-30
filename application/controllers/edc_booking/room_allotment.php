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
			$data['check_in'] = $row['check_in'];
			$data['check_out'] = $row['check_out'];
			$data['single_AC'] = $row['single_AC'];
			$data['double_AC'] = $row['double_AC'];
			$data['suite_AC'] = $row['suite_AC'];
			$data['allocation_confirm_status'] = $row['allocation_confirm_status'];
		}
		$data['app_num'] = $app_num;
		//$total_alloc_rooms = $this->edc_allotment_model->get_allocated_rooms($app_num);
		//$data['total_alloc_rooms'] = $total_alloc_rooms;
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
		//$check_in = urldecode($check_in);
		//$check_out = urldecode($check_out);
		$result_uavail_rooms = $this->edc_allotment_model->check_unavail($check_in,$check_out);
		//print_r($result_uavail_rooms);
		//$data['app_detail'] = $result_avail_rooms;
		//$result_booked_history = $this->edc_allotment_model->booking_history($result_avail_rooms);
		$floor_array = $this->edc_allotment_model->get_floors($building);
		//print_r($result_booked_history);
		$flr = 1;
		foreach($floor_array as $floor)
		{
			$temp_query = $this->edc_allotment_model->get_rooms($building,$floor['floor']);
			$result_floor_wise[$flr][0] = $temp_query;
			$result_floor_wise[$flr++][1] = $floor['floor'];
			//$result_floor_wise[$flr++][2] = $temp_query['room_type'];
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
				$data_array[$i][$sno][0] = $row['id'];
				$data_array[$i][$sno][1] = $row['room_no'];
				$data_array[$i][$sno][2] = $row['room_type'];
				if($flag==0)
				{
					$data_array[$i][$sno++][3] = 1;
				}
				else
				{
					$data_array[$i][$sno++][3] = 0;
				}

			}
			$i++;
		}
		//print_r($data_array);
		$data['floor_room_array'] = $data_array;
		$data['room_array'] = $this->edc_allotment_model->get_room_types();
		//print_r($res);
		$this->load->view('edc_booking/edc_rooms',$data);
	}
	function insert_edc_allotment($app_num)
	{
		//$app_num = $this->input->post('app_num');
		$room_list = $this->input->post('room_list');

		$this->load->model('edc_booking/edc_allotment_model');
		$this->edc_allotment_model->set_ctk_status("Approved",$app_num);
		$this->edc_allotment_model->delete_room_detail($app_num);
		foreach($room_list as $room)
		{
			$input_data = array(
				'app_num' => $app_num,
				'room_id'	=> $room,
			);
			//print_r($input_data);
			$this->edc_allotment_model->insert_booking_details ($input_data);
		}
		//$this->edc_allotment_model->insert_confirmation_details ($app_num);
		$this->load->model ('user_model');
		$res = $this->user_model->getUsersByDeptAuth('all', 'pce');
		$pce = '';
		foreach ($res as $row)
			$pce = $row->id;
		$this->notification->notify ($pce, "pce", "Approve/Reject Pending Request", "EDC Room Booking Request (Application No. : ".$app_num." ) is Pending for your approval.", "edc_booking/booking_request/details_final/".$app_num."/pce", "");
		$this->session->set_flashdata('flashSuccess','Room Allotment has been done successfully.');
		redirect('home');

	}

}
