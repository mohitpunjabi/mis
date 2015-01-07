<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','deo'));
	}

	public function index()
	{
		if($this->authorization->is_auth('deo'))
		{
			$header['title']="Edit Employee";
			$header['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/employee/edit_employee_script.js \" ></script>";

			$this->load->model('emp_basic_details_model','',TRUE);
			$data['employees']=$this->emp_basic_details_model->getAllEmployeesId();

			$this->load->model('Departments_model','',TRUE);
			$data['departments']=$this->Departments_model->get_departments();

			$this->load->view('templates/header',$header);
			$this->load->view('employee/edit/index',$data);
			$this->load->view('templates/footer');
		}
		else if($this->authorization->is_auth('emp'))
		{
			$header['title']="Edit Basic details";

			$emp_id=$data['emp_id']=$this->session->userdata('id');
			$this->load->model('user_details_model','',TRUE);
			$this->load->model('user_other_details_model','',TRUE);
			$this->load->model('emp_basic_details_model','',TRUE);
			$this->load->model('faculty_details_model','',TRUE);
			$this->load->model('emp_pay_details_model','',TRUE);
			$this->load->model('user_address_model','',TRUE);

			$data['user_details']=$this->user_details_model->getUserById($emp_id);
			$data['user_other_details']=$this->user_other_details_model->getUserById($emp_id);
			$data['emp']=$this->emp_basic_details_model->getEmployeeById($emp_id);
			$data['ft']=$this->faculty_details_model->getFacultyById($emp_id);
			$data['emp_pay_details']=$this->emp_pay_details_model->getEmpPayDetailsById($emp_id);
			$data['permanent_address']=$this->user_address_model->getAddrById($emp_id,'permanent');
			$data['present_address']=$this->user_address_model->getAddrById($emp_id,'present');

			$this->load->model('departments_model','',TRUE);
			$this->load->model('Designations_model','',TRUE);
			// get distinct pay bands
			$this->load->model('pay_scales_model','',TRUE);
			$data['pay_bands']=$this->pay_scales_model->get_pay_bands();

			$this->load->view('templates/header',$header);
			$this->load->view('employee/edit/own_basic_details',$data);
			$this->load->view('templates/footer');
		}
	}

	public function edit_form()
	{
		if(!$this->authorization->is_auth('deo'))
		{
			$this->session->set_flashdata('flashError','You are not authorized.');
			redirect('employee/menu');
			return;
		}

		$emp_id = $this->input->post('emp_id');
		$form = $this->input->post('form_name');

		// if some one refreshes the page then post values will be false, so saving the values in session.
		if($emp_id != '')
		{
			$this->session->set_userdata('EDIT_EMPLOYEE_ID',$emp_id);
			$this->session->set_userdata('EDIT_EMPLOYEE_FORM',$form);
		}

		if($emp_id == "" && !$this->session->userdata('EDIT_EMPLOYEE_ID'))
		{
			$this->session->set_flashdata('flashError','No employee selected.');
			redirect('employee/edit');
			return;
		}
		$emp_id = $this->session->userdata('EDIT_EMPLOYEE_ID',$emp_id);
		$form = $this->session->userdata('EDIT_EMPLOYEE_FORM',$emp_id);
		switch($form)
		{
			case 0: $this->_edit_profile_pic($emp_id);break;
			case 1:	$this->_edit_basic_details($emp_id);break;
			case 2: $this->_edit_prev_emp_details($emp_id);break;
			case 3: $this->_edit_family_details($emp_id);break;
			case 4: $this->_edit_education_details($emp_id);break;
			case 5: $this->_edit_last_5yr_stay_details($emp_id);break;
		}
	}

	private function _edit_profile_pic($emp_id)
	{
		$header['title']='Change Employee picture';
		$header['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/employee/emp_profile_picture_script.js \" ></script>";

		$this->load->model('user_details_model','',TRUE);
		$res=$this->user_details_model->getUserById($emp_id);
		$data['photopath'] = ($res == FALSE)?	FALSE:$res->photopath;
		$data['emp_id']=$emp_id;
		$this->load->view('templates/header',$header);
		$this->load->view('employee/edit/profile_pic',$data);
		$this->load->view('templates/footer');
	}

	function update_profile_pic($emp_id)
	{
		$upload = $this->_upload_image($emp_id,'photo');
		if($upload)
		{
			$this->load->model('user_details_model','',TRUE);
			$res=$this->user_details_model->getUserById($emp_id);
			$old_photo = ($res == FALSE)?	FALSE:$res->photopath;
			$this->user_details_model->updateById(array('photopath'=>$upload['file_name']),$emp_id);
			if($old_photo)	unlink(APPPATH.'../assets/images/employee/'.$emp_id.'/'.$old_photo);

			$this->edit_validation($emp_id,'profile_pic_status');

			$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' profile picture updated and sent for validation.');
			redirect('employee/edit');
		}
	}

	private function _edit_basic_details($emp_id)
	{
		$header['title']='Edit basic details';
		$header['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/employee/edit_basic_details_script.js \" ></script>";

		$data['emp_id']=$emp_id;
		$this->load->model('user_details_model','',TRUE);
		$this->load->model('user_other_details_model','',TRUE);
		$this->load->model('emp_basic_details_model','',TRUE);
		$this->load->model('faculty_details_model','',TRUE);
		$this->load->model('emp_pay_details_model','',TRUE);
		$this->load->model('user_address_model','',TRUE);

		$data['user_details']=$this->user_details_model->getUserById($emp_id);
		$data['user_other_details']=$this->user_other_details_model->getUserById($emp_id);
		$data['emp']=$this->emp_basic_details_model->getEmployeeById($emp_id);
		$data['ft']=$this->faculty_details_model->getFacultyById($emp_id);
		$data['emp_pay_details']=$this->emp_pay_details_model->getEmpPayDetailsById($emp_id);
		$data['permanent_address']=$this->user_address_model->getAddrById($emp_id,'permanent');
		$data['present_address']=$this->user_address_model->getAddrById($emp_id,'present');

		$this->load->model('departments_model','',TRUE);
		$this->load->model('Designations_model','',TRUE);
		// get distinct pay bands
		$this->load->model('pay_scales_model','',TRUE);
		$data['pay_bands']=$this->pay_scales_model->get_pay_bands();

		$this->load->view('templates/header',$header);
		$this->load->view('employee/edit/basic_details',$data);
		$this->load->view('templates/footer');
	}

	function update_basic_details($emp_id)
	{
		$user_details = array(
			'salutation' => $this->input->post('salutation') ,
			'first_name' => ucwords(strtolower($this->input->post('firstname'))) ,
			'middle_name' => ucwords(strtolower($this->input->post('middlename'))) ,
			'last_name' => ucwords(strtolower($this->input->post('lastname'))) ,
			'sex' => strtolower($this->input->post('sex')) ,
			'category' => $this->input->post('category') ,
			'dob' => $this->input->post('dob') ,
			'email' => $this->input->post('email') ,
			'marital_status' => strtolower($this->input->post('mstatus')) ,
			'physically_challenged' => strtolower($this->input->post('pd')) ,
			'dept_id' => $this->input->post('department')
		);

		$user_other_details = array(
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
				'research_interest' => strtolower($this->input->post('research_int'))
			);
		}

		$emp_pay_details = array(
			'pay_code' => $this->input->post('gradepay') ,
			'basic_pay' => $this->input->post('basicpay')
		);

		$user_present_address = array(
				'line1' => $this->input->post('line11') ,
				'line2' => $this->input->post('line21') ,
				'city' => strtolower($this->input->post('city1')) ,
				'state' => strtolower($this->input->post('state1')) ,
				'pincode' => $this->input->post('pincode1') ,
				'country' => strtolower($this->input->post('country1')) ,
				'contact_no' => $this->input->post('contact1') ,
		);

		//loading models
		$this->load->model('user_details_model','',TRUE);
		$this->load->model('user_other_details_model','',TRUE);
		$this->load->model('emp_basic_details_model','',TRUE);
		$this->load->model('faculty_details_model','',TRUE);
		$this->load->model('emp_pay_details_model','',TRUE);
		$this->load->model('user_address_model','',TRUE);

		//starting transaction for insertion in database

		$this->db->trans_start();

		$this->user_details_model->updateById($user_details,$emp_id);
		$this->user_other_details_model->updateById($user_other_details,$emp_id);
		$this->emp_basic_details_model->updateById($emp_basic_details,$emp_id);
		if($this->input->post('tstatus') == 'ft')
			$this->faculty_details_model->updateById($faculty_details,$emp_id);
		$this->emp_pay_details_model->updateById($emp_pay_details,$emp_id);
		$this->user_address_model->updatePresentAddrById($user_present_address,$emp_id);

		$this->db->trans_complete();
		//transaction completed

		$this->edit_validation($emp_id,'basic_details_status');

		$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' basic details updated and sent for validation.');
		redirect('employee/edit');
	}

	function update_own_basic_details($emp_id)
	{
		$user_details = array(
			'salutation' => $this->input->post('salutation') ,
			'email' => $this->input->post('email') ,
			'marital_status' => strtolower($this->input->post('mstatus')) ,
			'physically_challenged' => strtolower($this->input->post('pd'))
		);

		$user_other_details = array(
			'hobbies' => strtolower($this->input->post('hobbies')) ,
			'fav_past_time' => strtolower($this->input->post('favpast')) ,
			'mobile_no' => $this->input->post('mobile')
		);

		$emp_basic_details = array(
			'office_no' => $this->input->post('office') ,
			'fax' => $this->input->post('fax')
		);

		if($this->input->post('research_int'))
		{
			$faculty_details = array(
				'research_interest' => strtolower($this->input->post('research_int'))
			);
		}

		$user_present_address = array(
				'line1' => $this->input->post('line11') ,
				'line2' => $this->input->post('line21') ,
				'city' => strtolower($this->input->post('city1')) ,
				'state' => strtolower($this->input->post('state1')) ,
				'pincode' => $this->input->post('pincode1') ,
				'country' => strtolower($this->input->post('country1')) ,
				'contact_no' => $this->input->post('contact1') ,
		);

		//loading models
		$this->load->model('user_details_model','',TRUE);
		$this->load->model('user_other_details_model','',TRUE);
		$this->load->model('emp_basic_details_model','',TRUE);
		$this->load->model('faculty_details_model','',TRUE);
		$this->load->model('user_address_model','',TRUE);

		//starting transaction for insertion in database

		$this->db->trans_start();

		$this->user_details_model->updateById($user_details,$emp_id);
		$this->user_other_details_model->updateById($user_other_details,$emp_id);
		$this->emp_basic_details_model->updateById($emp_basic_details,$emp_id);
		if(isset($faculty_details))
			$this->faculty_details_model->updateById($faculty_details,$emp_id);
		$this->user_address_model->updatePresentAddrById($user_present_address,$emp_id);

		$this->db->trans_complete();
		//transaction completed

		$this->session->set_flashdata('flashSuccess','Your basic details have been updated.');
		redirect('employee/menu');
	}

	private function _edit_prev_emp_details($emp_id)
	{
		$header['title']='Edit Previous Employment Details';
		$header['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/employee/edit_prev_emp_details_script.js \" ></script>";

		$data['emp_id']=$emp_id;
		$this->load->model('emp_prev_exp_details_model','',TRUE);
		$data['emp_prev_exp_details'] = $this->emp_prev_exp_details_model->getEmpPrevExpById($emp_id);

		//joining date of the employee
		$this->load->model('emp_basic_details_model','',TRUE);
		$emp_basic_details = $this->emp_basic_details_model->getEmployeeByID($emp_id);
		if($emp_basic_details !== FALSE)
			$data['joining_date'] = $emp_basic_details->joining_date;
		else
			$data['joining_date'] = FALSE;

		$this->load->view('templates/header',$header);
		$this->load->view('employee/edit/previous_employment_details',$data);
		$this->load->view('templates/footer');
	}

	function update_prev_emp_details($emp_id)
	{
		$designation = $this->input->post('designation2');
		$from = $this->input->post('from2');
		$to = $this->input->post('to2');
		$payscale = $this->input->post('payscale2');
		$addr = $this->input->post('addr2');
		$reason = $this->input->post('reason2');

		$this->load->model('emp_prev_exp_details_model','',TRUE);

		$n = count($designation);
		$sno = count($this->emp_prev_exp_details_model->getEmpPrevExpById($emp_id));
		$i=0;
		while($i<$n && $designation[$i] != '')
		{
			$emp_prev_exp_details[$i]['id'] = $emp_id;
			$emp_prev_exp_details[$i]['sno'] = $sno+$i+1;
			$emp_prev_exp_details[$i]['designation'] = strtolower($designation[$i]);
			$emp_prev_exp_details[$i]['from'] = $from[$i];
			$emp_prev_exp_details[$i]['to'] = $to[$i];
			$emp_prev_exp_details[$i]['pay_scale'] = strtolower($payscale[$i]);
			$emp_prev_exp_details[$i]['address'] = strtolower($addr[$i]);
			$emp_prev_exp_details[$i]['remarks'] = strtolower($reason[$i]);
			$i++;
		}

		//check if there is any data to be inserted
		if(isset($emp_prev_exp_details))
		{
			$this->emp_prev_exp_details_model->insert_batch($emp_prev_exp_details);
			$this->edit_validation($emp_id,'prev_exp_status');
			$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' previous employment details updated and sent for validation.');
		}
		else
			$this->session->set_flashdata('flashInfo','Employee '.$emp_id.' : No details were added.');
		redirect('employee/edit');
	}

	function update_old_prev_emp_details($row)
	{
		$emp_id = $this->session->userdata('EDIT_EMPLOYEE_ID');

		$this->load->model('emp_prev_exp_details_model','',TRUE);

		$this->emp_prev_exp_details_model->update_record(array('designation'=>strtolower($this->input->post('designation'.$row)),
																'from'=>$this->input->post('from'.$row),
																'to'=>$this->input->post('to'.$row),
																'pay_scale'=>strtolower($this->input->post('payscale'.$row)),
																'address'=>strtolower($this->input->post('addr'.$row)),
																'remarks'=>strtolower($this->input->post('reason'.$row))),
															array('id'=>$emp_id, 'sno'=>$row));

		$this->edit_validation($emp_id,'prev_exp_status');
		$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' previous employment details updated and sent for validation.');
		redirect('employee/edit/edit_form');
	}

	private function _edit_family_details($emp_id)
	{
		$header['title']='Edit Family Details';
		$header['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/employee/edit_family_details_script.js \" ></script>";

		$data['emp_id']=$emp_id;
		$this->load->model('emp_family_details_model','',TRUE);
		$data['emp_family_details'] = $this->emp_family_details_model->getEmpFamById($emp_id);

		$this->load->view('templates/header',$header);
		$this->load->view('employee/edit/family_details',$data);
		$this->load->view('templates/footer');
	}

	function update_family_details($emp_id)
	{
		$name = $this->input->post('name3');
		$relationship = $this->input->post('relationship3');
		$profession = $this->input->post('profession3');
		$addr = $this->input->post('addr3');
		$dob = $this->input->post('dob3');
		$active = $this->input->post('active3');

		$this->load->model('emp_family_details_model','',TRUE);

		$n = count($name);
		$sno = count($this->emp_family_details_model->getEmpFamById($emp_id));
		$i = 0;

		$upload = $this->_upload_image($emp_id,'photo3',$n);

		if($upload !== FALSE)
		{
			while($i<$n && $name[$i] != '')
			{
				$emp_family_details[$i]['id'] = $emp_id;
				$emp_family_details[$i]['sno'] = $i+$sno+1;
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

		if(isset($emp_family_details))
		{
			$this->emp_family_details_model->insert_batch($emp_family_details);
			$this->edit_validation($emp_id,'family_details_status');
			$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' family details updated and sent for validation.');
		}
		else $this->session->set_flashdata('flashInfo','Employee '.$emp_id.' : No details were added.');
		redirect('employee/edit');
	}

	function update_old_fam_details($row)
	{
		$emp_id = $this->session->userdata('EDIT_EMPLOYEE_ID');

		$this->load->model('emp_family_details_model','',TRUE);

		$this->emp_family_details_model->update_record(array('dob'=>$this->input->post('dob'.$row),
															'profession'=>strtolower($this->input->post('profession'.$row)),
															'active_inactive'=>$this->input->post('active'.$row),
															'present_post_addr'=>strtolower($this->input->post('address'.$row))),
															array('id'=>$emp_id, 'sno'=>$row));

		$this->edit_validation($emp_id,'family_details_status');
		$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' family details updated and sent for validation.');
		redirect('employee/edit/edit_form');
	}

	private function _edit_education_details($emp_id)
	{
		$header['title']='Edit Educational Qualifications';
		$header['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/employee/edit_education_details_script.js \" ></script>";

		$data['emp_id']=$emp_id;
		$this->load->model('emp_education_details_model','',TRUE);
		$data['emp_education_details'] = $this->emp_education_details_model->getEmpEduById($emp_id);

		$this->load->view('templates/header',$header);
		$this->load->view('employee/edit/educational_details',$data);
		$this->load->view('templates/footer');
	}

	function update_education_details($emp_id)
	{
		$exam = $this->input->post('exam4');
		$branch = $this->input->post('branch4');
		$clgname = $this->input->post('clgname4');
		$year = $this->input->post('year4');
		$grade = $this->input->post('grade4');
		$div = $this->input->post('div4');

		$this->load->model('emp_education_details_model','',TRUE);

		$n = count($clgname);
		$sno = count($this->emp_education_details_model->getEmpEduById($emp_id));
		$i=0;
		while($i<$n && $clgname[$i] != '')
			{
				$emp_education_details[$i]['id'] = $emp_id;
				$emp_education_details[$i]['sno'] = $i+1+$sno;
				$emp_education_details[$i]['exam'] = strtolower($exam[$i]);
				$emp_education_details[$i]['branch'] = strtolower($branch[$i]);
				$emp_education_details[$i]['institute'] = strtolower($clgname[$i]);
				$emp_education_details[$i]['year'] = $year[$i];
				$emp_education_details[$i]['grade'] = strtolower($grade[$i]);
				$emp_education_details[$i]['division'] = strtolower($div[$i]);
				$i++;
			}

		//check if there is any data to be inserted
		if(isset($emp_education_details))
		{
			$this->emp_education_details_model->insert_batch($emp_education_details);
			$this->edit_validation($emp_id,'educational_status');
			$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' educational qualifications updated and sent for validation.');
		}
		else
			$this->session->set_flashdata('flashInfo','Employee '.$emp_id.' : No details were added.');
		redirect('employee/edit');
	}

	function update_old_education_details($row)
	{
		$emp_id = $this->session->userdata('EDIT_EMPLOYEE_ID');

		$this->load->model('emp_education_details_model','',TRUE);

		$this->emp_education_details_model->update_record(array('exam'=>strtolower($this->input->post('exam'.$row)),
																'branch'=>strtolower($this->input->post('branch'.$row)),
																'institute'=>strtolower($this->input->post('clgname'.$row)),
																'year'=>$this->input->post('year'.$row),
																'grade'=>strtolower($this->input->post('grade'.$row)),
																'division'=>strtolower($this->input->post('div'.$row))),
															array('id'=>$emp_id, 'sno'=>$row));

		$this->edit_validation($emp_id,'educational_status');
		$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' educational qualifications updated and sent for validation.');
		redirect('employee/edit/edit_form');
	}

	private function _edit_last_5yr_stay_details($emp_id)
	{
		$header['title']='Edit last 5 year stay details';
		$header['javascript']="<script type=\"text/javascript\" src=\"".base_url()."assets/js/employee/edit_last_5yr_stay_details_script.js \" ></script>";

		$data['emp_id']=$emp_id;
		$this->load->model('emp_last5yrstay_details_model','',TRUE);
		$data['emp_last5yrstay_details'] = $this->emp_last5yrstay_details_model->getEmpStayById($emp_id);

		$this->load->view('templates/header',$header);
		$this->load->view('employee/edit/last_five_year_stay_details',$data);
		$this->load->view('templates/footer');
	}

	function update_last_5yr_stay_details($emp_id)
	{
		$from = $this->input->post('from5');
		$to = $this->input->post('to5');
		$addr = $this->input->post('addr5');
		$district = $this->input->post('dist5');

		$this->load->model('emp_last5yrstay_details_model','',TRUE);

		$n = count($from);
		$sno = count($this->emp_last5yrstay_details_model->getEmpStayById($emp_id));
		$i=0;
		while($i<$n && $from[$i] != "")
		{
			$emp_last5yrstay_details[$i]['id'] = $emp_id;
			$emp_last5yrstay_details[$i]['sno'] = $i+1+$sno;
			$emp_last5yrstay_details[$i]['from'] = $from[$i];
			$emp_last5yrstay_details[$i]['to'] = $to[$i];
			$emp_last5yrstay_details[$i]['res_addr'] = $addr[$i];
			$emp_last5yrstay_details[$i]['dist_hq_name'] = strtolower($district[$i]);
			$i++;
		}

		//check if there is any data to be inserted
		if(isset($emp_last5yrstay_details))
		{
			$this->emp_last5yrstay_details_model->insert_batch($emp_last5yrstay_details);
			$this->edit_validation($emp_id,'stay_status');
			$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' last five year stay details updated and sent for validation.');
		}
		else
			$this->session->set_flashdata('flashInfo','Employee '.$emp_id.' : No details were added.');
		redirect('employee/edit');
	}

	function update_old_last_5yr_stay_details($row)
	{
		$emp_id = $this->session->userdata('EDIT_EMPLOYEE_ID');

		$this->load->model('emp_last5yrstay_details_model','',TRUE);

		$this->emp_last5yrstay_details_model->update_record(array('from'=>$this->input->post('from'.$row),
																'to'=>$this->input->post('to'.$row),
																'res_addr'=>$this->input->post('addr'.$row),
																'dist_hq_name'=>strtolower($this->input->post('dist'.$row))),
															array('id'=>$emp_id, 'sno'=>$row));

		$this->edit_validation($emp_id,'stay_status');
		$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' last five year stay details updated and sent for validation.');
		redirect('employee/edit/edit_form');
	}

	private function edit_validation($emp_id,$form)
	{
		$this->load->model('emp_validation_details_model','',TRUE);
		$res = $this->emp_validation_details_model->getValidationDetailsById($emp_id);
		//If no entry in the emp_validation_details table then insert the record else update the record.
		if($res == FALSE)
		{
			$validation_details = array('id'=>$emp_id,
										'profile_pic_status'=> 'approved',
										'basic_details_status'=> 'approved',
										'prev_exp_status'=> 'approved',
										'family_details_status'=> 'approved',
										'educational_status'=> 'approved',
										'stay_status'=> 'approved',
										'created_date'=> date('Y-m-d H:i:s',time()));
			$validation_details[$form] = 'pending';
			$this->emp_validation_details_model->insert($validation_details);
		}
		else
		{
			$this->emp_validation_details_model->updateById(array($form => 'pending'),$emp_id);
		}

		//Notify Employee about the change in details
		$this->load->model('users_model','',TRUE);
		$user = $this->users_model->getUserById($emp_id);
		if($user->auth_id == 'emp' && $user->password !='')
		{
			$msg='';
			switch($form)
			{
				case 'profile_pic_status' : $msg = "Your photograph have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
				case 'basic_details_status' : $msg = "Your basic details have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
				case 'prev_exp_status' : $msg = "Your previous employment details have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
				case 'family_details_status' : $msg = "Your family details have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
				case 'educational_status' : $msg = "Your educational qualifications have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
				case 'stay_status' : $msg = "Your last five year stay details have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
			}
			$this->notification->notify($emp_id, "Details Edited", $msg, "view/index/".(($this->session->userdata('EDIT_EMPLOYEE_FORM')==0)? $this->session->userdata('EDIT_EMPLOYEE_FORM'):($this->session->userdata('EDIT_EMPLOYEE_FORM')-1)));
		}
		//Notify Assistant registrar for validation
		$this->load->model('user_details_model','',TRUE);
		$user = $this->user_details_model->getUserById($emp_id);
		$emp_name = ucwords($user->salutation.' '.$user->first_name.(($user->middle_name != '')? ' '.$user->middle_name: '').(($user->last_name != '')? ' '.$user->last_name: ''));
		$this->load->model('user_auth_types_model','',TRUE);
		$res = $this->user_auth_types_model->getUserIdByAuthId('est_ar');
		foreach ($res as $row)
		{
			if($row->id == $emp_id)	continue;
			$this->notification->notify($row->id, "Validation Request", "Please validate ".$emp_name." details", "validation/validate_step/".$emp_id);
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
                    $filename='emp_'.$emp_id.'_'.date('YmdHis');
                }
	        }
	        else
	        {
	        	$this->session->set_flashdata('flashError','ERROR: File Name not set.');
	        	redirect('employee/edit/edit_form');
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
                    	$filename[$i]='emp_'.$emp_id.'_fam_'.($i+1).date('YmdHis').$ext;
                	}
	        	}
	        	else
	        	{
		        	$this->session->set_flashdata('flashError','ERROR: File Name not set.');
        			redirect('employee/edit/edit_form');
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
			$this->session->set_flashdata('flashError',$this->upload->display_errors('',''));
			redirect('employee/edit/edit_form');
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
/* End of file edit.php */
/* Location: mis/application/controllers/employee/edit.php */
