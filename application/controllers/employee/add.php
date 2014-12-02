<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function index($error='')
	{
		$this->load->model('employee/Emp_current_entry_model','',TRUE);
		$entry=$this->Emp_current_entry_model->get_current_entry();
		if($entry === FALSE)
			$this->step(0,'',$error);
		else
			$this->step($entry->curr_step,$entry->id,$error);
	}

	private function _add_basic_details($error='')
	{
		// Handling Errors
		$data['error'] = $error;

		// by default faculty designations are to be fetched
		$this->load->model('Designations_model','',TRUE);
		$data['designations']=$this->Designations_model->get_designations("type in ('ft','others')");

		// get distinct pay bands
		$this->load->model('Pay_scales_model','',TRUE);
		$data['pay_bands']=$this->Pay_scales_model->get_pay_bands();

		// get academic departments ........ as faculty is selected by default
		$this->load->model('Departments_model','',TRUE);
		$data['academic_departments']=$this->Departments_model->get_departments('academic');

		//javascript
		$data['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/employee/basic_details_script.js \" ></script>";

		//view
		$this->load->view('employee/add/basic_details',$data);
	}

	public function insert_basic_details()
	{
		$emp_id = strtolower($this->input->post('emp_id'));
		$upload = $this->_upload_image($emp_id,'photo');
		if($upload !== FALSE)
		{
			$users = array(
				'id' => $emp_id ,
				'password' => '' ,
				'auth_id' => 'emp' ,
				'created_date' => ''
			);

			$user_details = array(
				'id' => $emp_id ,
				'salutation' => $this->input->post('salutation') ,
				'first_name' => ucwords(strtolower($this->input->post('firstname'))) ,
				'middle_name' => ucwords(strtolower($this->input->post('middlename'))) ,
				'last_name' => ucwords(strtolower($this->input->post('lastname'))) ,
				'sex' => strtolower($this->input->post('sex')) ,
				'category' => $this->input->post('category') ,
				'dob' => $this->input->post('dob') ,
				'email' => $this->input->post('email') ,
				'photopath' => $upload['file_name'] ,
				'marital_status' => strtolower($this->input->post('mstatus')) ,
				'physically_challenged' => strtolower($this->input->post('pd')) ,
				'dept_id' => $this->input->post('department')
			);

			$user_other_details = array(
				'id' => $emp_id ,
				'religion' => strtolower($this->input->post('religion')) ,
				'nationality' => strtolower($this->input->post('nationality')) ,
				'kashmiri_immigrant' => $this->input->post('kashmiri') ,
				'hobbies' => strtolower($this->input->post('hobbies')) ,
				'fav_past_time' => strtolower($this->input->post('favpast')) ,
				'birth_place' => strtolower($this->input->post('pob')) ,
				'mobile_no' => $this->input->post('mobile') ,
				'father_name' => ucwords(strtolower($this->input->post('father'))) ,
				'mother_name' => ucwords(strtolower($this->input->post('mother')))
			);

			$emp_basic_details = array(
				'id' => $emp_id ,
				'auth_id' => $this->input->post('tstatus') ,
				'designation' => $this->input->post('designation') ,
				'office_no' => $this->input->post('office') ,
				'fax' => $this->input->post('fax') ,
				'joining_date' => $this->input->post('entrance_age') ,
				'retirement_date' => $this->input->post('retire') ,
				'employment_nature' => strtolower($this->input->post('empnature'))
			);

			if($this->input->post('tstatus') == 'ft')
			{
				$faculty_details = array(
					'id' => $emp_id ,
					'research_interest' => strtolower($this->input->post('research_int'))
				);
			}

			$emp_pay_details = array(
				'id' => $emp_id ,
				'pay_code' => $this->input->post('gradepay') ,
				'basic_pay' => $this->input->post('basicpay')
			);

			$user_address = array(
				array(
					'id' => $emp_id ,
					'line1' => $this->input->post('line11') ,
					'line2' => $this->input->post('line21') ,
					'city' => strtolower($this->input->post('city1')) ,
					'state' => strtolower($this->input->post('state1')) ,
					'pincode' => $this->input->post('pincode1') ,
					'country' => strtolower($this->input->post('country1')) ,
					'contact_no' => $this->input->post('contact1') ,
					'type' => 'present'
				),
				array(
					'id' => $emp_id ,
					'line1' => $this->input->post('line12') ,
					'line2' => $this->input->post('line22') ,
					'city' => strtolower($this->input->post('city2')) ,
					'state' => strtolower($this->input->post('state2')) ,
					'pincode' => $this->input->post('pincode2') ,
					'country' => strtolower($this->input->post('country2')) ,
					'contact_no' => $this->input->post('contact2') ,
					'type' => 'permanent'
				)
			);

			$emp_current_entry = array(
				'id' => $emp_id ,
				'curr_step' => 1
			);

			//loading models

			$this->load->model('Users_model','',TRUE);
			$this->load->model('User_details_model','',TRUE);
			$this->load->model('User_other_details_model','',TRUE);
			$this->load->model('Emp_basic_details_model','',TRUE);
			$this->load->model('Faculty_details_model','',TRUE);
			$this->load->model('Emp_pay_details_model','',TRUE);
			$this->load->model('User_address_model','',TRUE);
			$this->load->model('employee/Emp_current_entry_model','',TRUE);

			//starting transaction for insertion in database

			$this->db->trans_start();

			$this->Users_model->insert($users);
			$this->User_details_model->insert($user_details);
			$this->User_other_details_model->insert($user_other_details);
			$this->Emp_basic_details_model->insert($emp_basic_details);
			if($this->input->post('tstatus') == 'ft')
				$this->Faculty_details_model->insert($faculty_details);
			$this->Emp_pay_details_model->insert($emp_pay_details);
			$this->User_address_model->insert_batch($user_address);
			$this->Emp_current_entry_model->insert($emp_current_entry);

			$this->db->trans_complete();
			//transaction completed

			$this->index();
		}
	}

	private function _add_prev_emp_details($emp_id = '', $error = '')
	{
		$data['error'] = $error;	// Handling Errors
		$data['add_emp_id'] = $emp_id;

		//joining date of the employee
		$this->load->model('emp_basic_details_model','',TRUE);
		$emp_basic_details=$this->emp_basic_details_model->getbyID($emp_id);
		if($emp_basic_details!==FALSE)
			$data['joining_date']=$emp_basic_details->joining_date;
		else $data['joining_date']=FALSE;

		//javascript
		$data['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/employee/prev_emp_details_script.js \" ></script>";

		//view
		$this->load->view('employee/add/previous_employment_details',$data);
	}

	public function insert_prev_emp_details($emp_id = '', $error = '')
	{
		if($emp_id != '')
		{
			$designation = $this->input->post('designation2');
			$from = $this->input->post('from2');
			$to = $this->input->post('to2');
			$payscale = $this->input->post('payscale2');
			$addr = $this->input->post('addr2');
			$reason = $this->input->post('reason2');

			$n = count($designation);
			$i = 0;

			while($designation[$i] != '' && $i<$n)
			{
				$emp_prev_exp_details[$i]['id'] = $emp_id;
				$emp_prev_exp_details[$i]['sno'] = $i+1;
				$emp_prev_exp_details[$i]['designation'] = strtolower($designation[$i]);
				$emp_prev_exp_details[$i]['from'] = $from[$i];
				$emp_prev_exp_details[$i]['to'] = $to[$i];
				$emp_prev_exp_details[$i]['pay_scale'] = strtolower($payscale[$i]);
				$emp_prev_exp_details[$i]['address'] = strtolower($addr[$i]);
				$emp_prev_exp_details[$i]['remarks'] = strtolower($reason[$i]);
				$i++;
			}

			//loading models

			$this->load->model('emp_prev_exp_details_model','',TRUE);
			$this->load->model('employee/emp_current_entry_model','',TRUE);

			//starting transaction for insertion in database

			$this->db->trans_start();

			$this->emp_prev_exp_details_model->insert_batch($emp_prev_exp_details);
			$this->emp_current_entry_model->update(array('curr_step' => 2),array('id' => $emp_id));

			$this->db->trans_complete();
			//transaction completed

		}
		else
			$error = 'ERROR : No employee id selected. You are not supposed to be here.';

		$this->index($error);
	}

	private function _add_family_details($emp_id = '', $error = '')
	{
		$data['error'] = $error;	// Handling Errors
		$data['add_emp_id'] = $emp_id;

		//javascript
		$data['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/employee/family_details_script.js \" ></script>";

		//view
		$this->load->view('employee/add/family_details',$data);
	}

	public function insert_family_details($emp_id = '', $error = '')
	{
		if($emp_id != '')
		{
			$name = $this->input->post('name3');
			$relationship = $this->input->post('relationship3');
			$profession = $this->input->post('profession3');
			$addr = $this->input->post('addr3');
			$dob = $this->input->post('dob3');
			$active = $this->input->post('active3');

			$n = count($name);
			$i = 0;

			$upload = $this->_upload_image($emp_id,'photo3',$n);

			if($upload !== FALSE)
			{
				while($name[$i] != '' && $i<$n)
				{
					$emp_family_details[$i]['id'] = $emp_id;
					$emp_family_details[$i]['sno'] = $i+1;
					$emp_family_details[$i]['name'] = ucwords(strtolower($name[$i]));
					$emp_family_details[$i]['relationship'] = $relationship[$i];
					$emp_family_details[$i]['profession'] = strtolower($profession[$i]);
					$emp_family_details[$i]['present_post_addr'] = strtolower($addr[$i]);
					$emp_family_details[$i]['photopath'] = (isset($upload[$i]['file_name']))? $upload[$i]['file_name'] : '';
					$emp_family_details[$i]['dob'] = $dob[$i];
					$emp_family_details[$i]['active_inactive'] = $active[$i];
					$i++;
				}
			}
			else return;

			//loading models

			$this->load->model('emp_family_details_model','',TRUE);
			$this->load->model('employee/emp_current_entry_model','',TRUE);

			//starting transaction for insertion in database

			$this->db->trans_start();

			$this->emp_family_details_model->insert_batch($emp_family_details);
			$this->emp_current_entry_model->update(array('curr_step' => 3),array('id' => $emp_id));

			$this->db->trans_complete();
			//transaction completed

		}
		else
			$error = 'ERROR : No employee id selected. You are not supposed to be here.';

		$this->index($error);
	}

	public function step($num = 0,$employee = '',$error = '')
	{
		switch ($num)
		{
			case 0:	$this->_add_basic_details($error);break;
			case 1: $this->_add_prev_emp_details($employee,$error);break;
			case 2: $this->_add_family_details($employee,$error);break;
			case 3: $this->load->view('employee/add/educational_details',$data);break;
			case 4: $this->load->view('employee/add/last_five_year_stay_details',$data);break;
		}
	}

	private function _upload_image($emp_id = '', $name ='', $n_family = FALSE)
	{
		$config['upload_path'] = 'assets/images/employee/'.strtolower($emp_id).'/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']  = '200';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		if($n_family === FALSE)
		{
			if(isset($_FILES[$name]['name']))
        	{
                if($_FILES[$name]['name'] == "")
            		$filename = "";
                else
				{
                    $filename=$this->security->sanitize_filename(strtolower($_FILES[$name]['name']));
                    $ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
                    $filename='emp_'.$emp_id.'_'.$filename;
                }
	        }
	        else
	        {
	        	$this->index('ERROR: File Name not set.');
				return FALSE;
	        }
	    }
	    else
    	{
    		$i=0;
    		while($i<$n_family)
    		{
    			if(isset($_FILES[$name]['name'][$i]))
        		{
	                if($_FILES[$name]['name'][$i] == "")
            			$filename[$i] = "";
                	else
					{
	                    $filename[$i] = $this->security->sanitize_filename(strtolower($_FILES[$name]['name'][$i]));
                    	$ext =  strrchr( $filename[$i], '.' ); // Get the extension from the filename.
                    	$filename[$i]='emp_'.$emp_id.'_fam_'.($i+1).$ext;
                	}
	        	}
	        	else
	        	{
		        	$this->index('ERROR: File Name not set.');
					return FALSE;
	        	}
	        	$i++;
    		}
    	}
    	//dont upload files with no file name
		for($i=0 ; $i < $n_family ; $i++)
			if($_FILES[$name]["name"][$i] == '')
			{
				unset($_FILES[$name]["name"][$i]);
			}

		$config['file_name'] = $filename;
		//$this->load->view('welcome_message',array('d'=>array('photo_image'=>$_FILES,'config'=>$config)));
		//return FALSE;

		if(!is_dir($config['upload_path']))	//create the folder if it's not already exists
	    {
			mkdir($config['upload_path'],0777,TRUE);
    	}

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_multi_upload($name))		//do_multi_upload is back compatible with do_upload
		{
			$error = $this->upload->display_errors();
			$this->index('ERROR: '.$error);
			return FALSE;
		}
		else
		{
			if($n_family === FALSE)						//single upload
				$upload_data = $this->upload->data();
			else 										//multiple upload using name array
				$upload_data = $this->upload->get_multi_upload_data();
			return $upload_data;
		}
	}
}
/* End of file add.php */
/* Location: mis/application/controllers/employee/add.php */
