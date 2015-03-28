<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('ft','stu'));
		$this->addJS("edc_booking/booking.js");
	}
	
	function index ()
	{		
		$this->drawHeader('Executive Development Center');
		$data['auth'] = $this->session->userdata('auth')[0];

/*		$data = $this->session->all_userdata();
		var_dump($data);*/
		$this->load->view('edc_booking/booking_form', $data);
		$this->drawFooter();
	}
	
	function insert ()
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
			$this->notification->notify ($hod, "hod", "Approve/Reject Pending Request", "EDC Room Booking Request (Application No. : ".$app_num." ) is Pending for your approval.", "edc_booking/booking_details/details/".$app_num."/hod", "");
		}

		if ($this->session->userdata('auth')[0] == 'emp' && $purpose == 'Personal') {
			$pce_status = 'Pending';

			$this->load->model ('user_model');
			$res = $this->user_model->getUsersByDeptAuth('all', 'pce');
			$pce = '';
			foreach ($res as $row)
				$pce = $row->id;

			$this->notification->notify ($pce, "pce", "Approve/Reject Pending Request", "EDC Room Booking Request (Application No. : ".$app_num." ) is Pending for your approval.", "edc_booking/booking_details/details/".$app_num."/pce", "");
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
		redirect('edc_booking/track_status');
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