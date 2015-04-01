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
		$data['guest_details'] = $this->edc_booking_model->get_guest_detail($app_num);
		$data['count_guest']=count($data['guest_details']);
		$this->drawHeader('Add Guest Details');
		$this->load->view('edc_booking/add_checkin_checkout',$data);
		$this->drawFooter();

	}
	function insert_guest()
	{
		$data = array('app_num'=>$this->input->post('app_num'),
						  'name'=>$this->input->post('name'),
						  'designation'=>$this->input->post('designation'), 
						  'address'=>$this->input->post('address'),
						  'room_alloted'=>$this->input->post('room_alloted'),
						  'gender'=>$this->input->post('gender'));
		$this->load->model ('edc_booking/edc_booking_model', '', TRUE);
		$this->edc_booking_model->insert_guest_details($data);
		$this->session->set_flashdata('flashSuccess','Check In Successfull.');
		redirect('edc_booking/guest_details/edit/'.$this->input->post('app_num'));
	}
	function add_checkout($app_num,$room_alloted)
	{
		$this->load->model ('edc_booking/edc_booking_model', '', TRUE);
		$this->edc_booking_model->checkout($app_num,$room_alloted);
		$this->session->set_flashdata('flashSuccess','Check Out Successfull.');
		redirect('edc_booking/guest_details/edit/'.$app_num);

	}
}