<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','stu'));
		$this->addJS("edc_booking/booking.js");
	}
	
	function index ()
	{		
		$this->drawHeader('Executive Development Center');
		//$data['data'] = $this->session->all_userdata();
		$this->load->view('edc_booking/booking_form');
		$this->drawFooter();
	}
	
	function insert ()
	{		
		$this->load->model('edc_booking/edc_booking_model');

		$prec = 'EDC'; //optional
		$app_num = $prec.time();
		//echo $app_num."<br>";

		$user_id = $this->session->userdata('id');
		$email_id = $this->session->userdata('email');
		$dept_id = $this->session->userdata('dept_id');
		$purpose = $this->input->post('purpose');
		$check_in = $this->input->post('checkin');
		$check_out = $this->input->post('checkout');
		$app_date = date("Y-m-d");
					  
		//echo $user_id."<br>".$email_id."<br>".$dept_id."<br>".$purpose."<br>".$check_in."<br>".$check_out."<br>".$app_date."<br>";

		$no_of_guests = (int)$this->input->post('no_of_guests');
		//echo $numofguests;

		$registration_data = array('app_num'=>$app_num,
			  'user_id'=>$user_id,
			  'email_id'=>$email_id,
			  'dept_id'=>$dept_id,
			  'purpose'=>$purpose,
			  'no_of_guests'=>$no_of_guests,
			  'proposed_check_in'=>$check_in,
			  'proposed_check_out'=>$check_out,
			  'amount_deposited'=>1000,
			  'amount_name'=> 'Hitesh Sharma'
		);		
	  
		$this->edc_booking_model->insert_edc_registration_details ($registration_data);

		$guest = $this->input->post('guest');
		for ($i =0;$i< $no_of_guests; $i++)
		{
			/*echo $guest[$i]['name'];
			echo $guest[$i]['address'];
			echo $guest[$i]['gender'];
			echo $guest[$i]['room_preference'];*/

			$data = array('app_num'=>$app_num,
					'name'=>$guest[$i]['name'],
					'address'=>$guest[$i]['address'],
					'gender'=>$guest[$i]['gender'],
					'room_prefered'=>$guest[$i]['room_preference']		
					);
			$this->edc_booking_model->insert_guest_details($data);
		}
		$this->session->set_flashdata('flashSuccess','Room Allotment request has been successfully sent.');
		redirect('edc_booking/booking/track_status');
	}

	function track_status()
	{
		$this->drawHeader('Executive Development Center');
		$this->drawFooter();
	}
	
	function history()
	{	
		$this->drawHeader('Executive Development Center');
		$this->drawFooter();
	}
		
}