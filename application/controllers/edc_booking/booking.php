<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('ft','stu'));
		$this->addJS("edc_booking/booking.js");
	}
	
	function form ()
	{		
		$this->drawHeader('Executive Development Center');
		$data['auth'] = $this->session->userdata('auth')[0];

/*		$data = $this->session->all_userdata();
		var_dump($data);*/
		$this->load->view('edc_booking/booking_form', $data);
		$this->drawFooter();
	}
	
	function insert_edc_registration_details ()
	{		
		$this->load->model('edc_booking/edc_booking_model');

		$prec = 'EDC'; //optional
		$app_num = $prec.time();
		//echo $app_num."<br>";

		$app_date = date("Y-m-d");
		$user_id = $this->session->userdata('id');
//		$email_id = $this->session->userdata('email');
//		$dept_id = $this->session->userdata('dept_id');
		$purpose = $this->input->post('purpose');
		$purpose_of_visit = $this->input->post('purpose_of_visit');
		$name = $this->input->post('name');
		$designation = $this->input->post('designation');
		$check_in = $this->input->post('checkin');
		$check_out = $this->input->post('checkout');
					  
		//echo $user_id."<br>".$email_id."<br>".$dept_id."<br>".$purpose."<br>".$check_in."<br>".$check_out."<br>".$app_date."<br>";

		$no_of_guests = (int)$this->input->post('no_of_guests');
		//echo $numofguests;
		$single_AC = $this->input->post('single_AC');
		$double_AC = $this->input->post('double_AC');
		$suite_AC = $this->input->post('suite_AC');

		$school_guest = '0';
		$file_path = '';
		if ($this->input->post('school_guest') == '1') {
			$school_guest = '1';
			$upload=$this->upload_file('application_file');
			if ($upload)
				$file_path = $upload['file_name'];
		}

		$hod_status = '';
		$dsw_status = '';
		$pce_status = '';

		if ($this->session->userdata('auth')[0] == 'emp' && $purpose == 'Official') {
			$hod_status = 'Pending';

			$this->load->model ('user_model');
			$res = $this->user_model->getUsersByDeptAuth($this->session->userdata('dept_id'), 'hod');
			$hod = '';
			foreach ($res as $row)
				$hod = $row->id;
			$this->notification->notify ($hod, "hod", "Approve/Reject Pending Request", "EDC Room Booking Request (Application No. : ".$app_num." ) is Pending for your approval.", "edc_booking/booking_request/details/".$app_num."/hod", "");
		}

		if ($this->session->userdata('auth')[0] == 'emp' && $purpose == 'Personal') {
			$pce_status = 'Pending';

			$this->load->model ('user_model');
			$res = $this->user_model->getUsersByDeptAuth('all', 'pce');
			$pce = '';
			foreach ($res as $row)
				$pce = $row->id;

			$this->notification->notify ($pce, "pce", "Approve/Reject Pending Request", "EDC Room Booking Request (Application No. : ".$app_num." ) is Pending for your approval.", "edc_booking/booking_request/details/".$app_num."/pce", "");
		}
		if ($this->session->userdata('auth')[0] == 'stu')
			$dsw_status = 'Pending';
		
		$registration_data = array('app_num'=>$app_num,
			  'app_date'=>$app_date,
			  'user_id'=>$user_id,
			  'purpose'=>$purpose,
			  'purpose_of_visit'=>$purpose_of_visit,	
			  'name'=>$name,	
			  'designation'=>$designation,
			  'check_in'=>$check_in,
			  'check_out'=>$check_out,
			  'no_of_guests'=>$no_of_guests,
			  'single_AC'=>$single_AC,	
			  'double_AC'=>$double_AC,
			  'suite_AC'=>$suite_AC,
			  'school_guest'=>$school_guest,
			  'file_path'=>$file_path,
			  'hod_status'=>$hod_status,			  	
			  'dsw_status'=>$dsw_status,			  	
			  'pce_status'=>$pce_status,			  	
		);		

		$this->edc_booking_model->insert_edc_registration_details ($registration_data);

/*		$guest = $this->input->post('guest');
		for ($i =0;$i< $no_of_guests; $i++)
		{
			/*echo $guest[$i]['name'];
			echo $guest[$i]['address'];
			echo $guest[$i]['gender'];
			echo $guest[$i]['room_preference'];

			$data = array('app_num'=>$app_num,
					'name'=>$guest[$i]['name'],
					'address'=>$guest[$i]['address'],
					'gender'=>$guest[$i]['gender'],
					'room_prefered'=>$guest[$i]['room_preference']		
					);
			$this->edc_booking_model->insert_guest_details($data);
		}*/

		$this->session->set_flashdata('flashSuccess','Room Allotment request has been successfully sent.');
		redirect('edc_booking/booking/track_status');
	}

	function history()
	{	
		$this->load->model('edc_booking/edc_booking_model');
		$this->load->model('user_model');

		$res = $this->edc_booking_model->get_booking_history ($this->session->userdata('id'), "Approved");
		$total_rows_approved = count($res);
		$data_array_approved = array();
		$sno = 1;
		foreach ($res as $row)
		{
			$data_array_approved[$sno]=array();
			$j=1;
			$data_array_approved[$sno][$j++] = $row['app_num'];
			$data_array_approved[$sno][$j++] = date('j M Y g:i A', strtotime($row['app_date']));
			$data_array_approved[$sno][$j++] = $row['no_of_guests'];
			$sno++;
		}

		$res = $this->edc_booking_model->get_booking_history ($this->session->userdata('id'), "Rejected");
		$total_rows_rejected = count($res);
		$data_array_rejected = array();
		$sno = 1;
		foreach ($res as $row)
		{
			$data_array_rejected[$sno]=array();
			$j=1;
			$data_array_rejected[$sno][$j++] = $row['app_num'];
			$data_array_rejected[$sno][$j++] = date('j M Y g:i A', strtotime($row['app_date']));
			$data_array_rejected[$sno][$j++] = $row['no_of_guests'];
			$data_array_rejected[$sno][$j++] = "";
			if ($row['hod_approved_status'] == "Rejected")
				$data_array_rejected[$sno][4] = "Head of Department";
			else
				$data_array_rejected[$sno][4] = "PCE";				
			$sno++;
		}

		$data['data_array_approved'] = $data_array_approved;
		$data['total_rows_approved'] = $total_rows_approved;
		$data['data_array_rejected'] = $data_array_rejected;
		$data['total_rows_rejected'] = $total_rows_rejected;
		
		$this->drawHeader('Executive Development Center');
		$this->load->view('edc_booking/booking_history',$data);
		$this->drawFooter();
	}		


	function track_status()
	{
		$this->load->model('edc_booking/edc_booking_model');
		$res = $this->edc_booking_model->get_pending_booking_details($this->session->userdata('id'));
		
		if(count($res) == 0){
			$this->session->set_flashdata('flashError','You haven\'t any application form to track.');
			redirect('edc_booking/booking');
		}	

		$data = array();
		foreach ($res as $row)
		{
			$data['app_num'] = $row['app_num'];
			$data['app_date'] = date('j M Y g:i A', strtotime($row['app_date']));
			$data['purpose'] = $row['purpose'];
			$data['purpose_of_visit'] = $row['purpose_of_visit'];
			$data['name'] = $row['name'];
			$data['designation'] = $row['designation'];
			$data['check_in'] = $row['check_in'];
			$data['check_out'] = $row['check_out'];
			$data['no_of_guests'] = $row['no_of_guests'];
			$data['single_AC'] = $row['single_AC'];
			$data['double_AC'] = $row['double_AC'];
			$data['suite_AC'] = $row['suite_AC'];
			$data['school_guest'] = $row['school_guest'];
			$data['file_path'] = $row['file_path'];

			$data['hod_status'] = $row['hod_status'];
			$data['hod_action_timestamp'] = $row['hod_action_timestamp'];
			$data['dsw_status'] = $row['dsw_status'];
			$data['dsw_action_timestamp'] = $row['dsw_action_timestamp'];
			$data['pce_status'] = $row['pce_status'];
			$data['pce_action_timestamp'] = $row['pce_action_timestamp'];
			$data['deny_reason'] = $row['deny_reason'];
		}
		
		$data ['auth'] = $this->session->userdata('auth')[0];

		$this->drawHeader('Track Booking Status');
 		$this->load->view('edc_booking/booking_details_user', $data);
		$this->drawFooter();
	}


	private function upload_file($name ='')
	{
		$config['upload_path'] = 'assets/files/edc_booking';
		$config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png';
		$config['max_size']  = '1050';

			if(isset($_FILES[$name]['name']))
        	{
                if($_FILES[$name]['name'] == "")
            		$filename = "";
                else
				{
                    $filename=$this->security->sanitize_filename(strtolower($_FILES[$name]['name']));
                    $ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
                    $filename='FILE_'.date('YmdHis').$ext;
                }
	        }
	        else
	        {
	        	$this->session->set_flashdata('flashError','ERROR: File Name not set.');
	        	redirect('sah/booking/form');
				return FALSE;
	        }
	   
			$config['file_name'] = $filename;
			
			if(!is_dir($config['upload_path']))	//create the folder if it's not already exists
			{
				mkdir($config['upload_path'],0777,TRUE);
			}

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_multi_upload($name))		//do_multi_upload is back compatible with do_upload
			{
				$this->session->set_flashdata('flashError',$this->upload->display_errors('',''));
				redirect('sah/booking/form');
				return FALSE;
			}
			else
			{
				$upload_data = $this->upload->data();
				return $upload_data;
			}
	}

}