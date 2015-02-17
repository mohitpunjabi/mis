<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student_add extends CI_Controller//MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}


	var $_css;
	var $_js;
	var $userId;

	function isValidRequest($id, $token) {

		if($id && $token) {
			$this->load->model("user_model", "", TRUE);
			if($this->user_model->getById($id) !== false) return false;
			$fb = $this->load->database("feedback", TRUE);
			$row = $fb->select("count(*) as count")
				      ->where("username", $id)
				      ->where("password", $token)
				      ->get("feedback_users");

			return $row->row()->count == 1;
		}
		return false;
	}

	function drawFooter() {
		$this->load->view("student/add/footer");
	}

	function addJS($js) {
		$this->_js .= "<script type=\"text/javascript\" src=\"".base_url()."assets/js/".$js." \" ></script>";
	}

	function addCSS($css) {
		$this->_css .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."assets/css/".$css."\" />";
	}

	public function index($error='')
	{
		$this->add_basic_details($error);
	}

	public function add_basic_details($error = '')
	{
		/*if(!$this->isValidRequest($this->input->get("id"), $this->input->get("token"))) {
			show_404();	
		}
		else $this->userId = $this->input->get("id");*/

		$this->userId = '2011JE0786'; // delete this and uncomment the above lines

		$_css = "";
		$_js = "";
		//Handling Error
		$data['error'] = $error;

		$data['stu_id'] = $this->userId;

		//Fetching Departments
		$this->load->model('course_structure/basic_model','',TRUE);
		$data['academic_departments']=$this->basic_model->get_depts();
		$depts = $data['academic_departments'];

		$data['courses']=$this->basic_model->get_course_offered_by_dept($depts[0]->id);

		$course = $data['courses'];
		if($course)
			$data['branches'] = $this->basic_model->get_branches_by_course_and_dept($courses[0]->id,$depts[0]->id);
		else
		{
			$data['courses'] = FALSE;
			$data['branches'] = FALSE;
		}

		//javascript
		$this->addJS('student/basic_details_script.js');

		//view
		$this->load->view('templates/header_assets', array("title" => "Management Information System - Please fill your details",
													"javascript" => $this->_js,
													"css" => $this->_css));
		$this->load->view('student/add/student_detail',$data);
		$this->drawFooter();

	}

	public function add_student_education_details($stu_id = '' ,$student_type = '' ,$error = '')
	{
		$data['error'] = $error;
		$data['stu_id'] = $stu_id;
		$data['stu_type'] = $student_type;
		$this->addJS("student/education_details_script.js");
		$this->drawHeader('Add Education Details');
		$this->load->view('student/add/student_educational_details',$data);
		$this->drawFooter();
	}

	public function _passwordRegex($password)
	{
		if (preg_match('/^\S+$/', $password ))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function insert_basic_details($stu_id)
	{
		var_dump($stu_id);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'required|callback__passwordRegex|matches[confirm_password]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');
		$this->form_validation->set_rules('firstname','First Name','trim|required');
		$this->form_validation->set_rules('stud_name_hindi','Student Name in Hindi','required');
		if($this->input->post('depends_on'))
		{
		 	$this->form_validation->set_rules('guardian_name','Guardian Name','trim|required');
		 	$this->form_validation->set_rules('guardian_relation_name','Guardian Relation','trim|required');
		}
		else
		{
		 	$this->form_validation->set_rules('father_name','Father Name','trim|required');
		 	$this->form_validation->set_rules('mother_name','Mother Name','trim|required');
		 	$this->form_validation->set_rules('father_occupation','Father Occupation','trim|required');
		 	$this->form_validation->set_rules('mother_occupation','Mother Occupation','trim|required');
		 	$this->form_validation->set_rules('father_gross_income','Father Income','required|numeric');
		 	$this->form_validation->set_rules('mother_gross_income','Mothere Income','required|numeric');
		 }
		$this->form_validation->set_rules('parent_mobile','Parent Mobile','required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('parent_landline','Parent Landline','numeric');
		$this->form_validation->set_rules('pob','Place of Birth','trim|required');
		$admn_based_on = $this->input->post('admn_based_on');
		if($admn_based_on === 'others')
			$this->form_validation->set_rules('other_mode_of_admission','Other Mode of Admission','trim|required');
		else if($admn_based_on === 'iitjee')
		{
			$this->form_validation->set_rules('iitjee_rank','IIT JEE Rank','required|numeric');
			$this->form_validation->set_rules('iitjee_cat_rank','IIT JEE Category Rank','required|numeric');
		}
		else if($admn_based_on === 'gate')
			$this->form_validation->set_rules('gate_score','Gate Score','required|numeric');
		else if($admn_based_on === 'cat')
			$this->form_validation->set_rules('cat_score','Cat Score','required|numeric');
		$this->form_validation->set_rules('identification_mark','Identification Mark','trim|required');
		$this->form_validation->set_rules('migration_cert','Migration Certificate','trim|required');
		$this->form_validation->set_rules('nationality','Nationality','trim|required');
		$this->form_validation->set_rules('bank_name','Bank Name','trim|required');
		$this->form_validation->set_rules('bank_account_no','Account No','trim|required');
		$this->form_validation->set_rules('line11','Address Line 11','trim|required');
		$this->form_validation->set_rules('line21','Address Line 21','trim|required');
		$this->form_validation->set_rules('city1','Address City 1','trim|required');
		$this->form_validation->set_rules('state1','Address State 1','trim|required');
		$this->form_validation->set_rules('pincode1','Address Pincode 1','required|numeric');
		$this->form_validation->set_rules('country1','Address Country 1','trim|required');
		$this->form_validation->set_rules('contact1','Address Contact 1','required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('line12','Address Line 12','trim|required');
		$this->form_validation->set_rules('line22','Address Line 22','trim|required');
		$this->form_validation->set_rules('city2','Address City 2','trim|required');
		$this->form_validation->set_rules('state2','Address State 2','trim|required');
		$this->form_validation->set_rules('pincode2','Address Pincode 2','required|numeric');
		$this->form_validation->set_rules('country2','Address Country 2','trim|required');
		$this->form_validation->set_rules('contact2','Address Contact 2','required|regex_match[/^[0-9]{10}$/]');
		if(!$this->input->post('correspondence_addr'))
		{
			$this->form_validation->set_rules('line13','Address Line 13','trim|required');
			$this->form_validation->set_rules('line23','Address Line 23','trim|required');
			$this->form_validation->set_rules('city3','Address City 3','trim|required');
			$this->form_validation->set_rules('state3','Address State 3','trim|required');
			$this->form_validation->set_rules('pincode3','Address Pincode 3','required|numeric');
			$this->form_validation->set_rules('country3','Address Country 3','trim|required');
			$this->form_validation->set_rules('contact3','Address Contact 3','required|regex_match[/^[0-9]{10}$/]');
		}
		//$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		//$this->form_validation->set_rules('alternate_email_id','Alternate Email','trim|valid_email');
		$this->form_validation->set_rules('mobile','Mobile No','required|regex_match[/^[0-9]{10}$/]');
		//$this->form_validation->set_rules('alternate_mobile','Alternate Mobile No','required|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('fee_paid_amount','Fee Paid Amount','numeric');
		if($this->form_validation->run() === FALSE)
		{
			$this->session->set_flashdata('flashError','You did not fill some of the fields properly. Please switch on ypur Javascript if it is off.');
			redirect('student/student_add');
		}
		$upload = $this->upload_image($stu_id,'photo');
		if($upload !== FALSE)
		{
			$date = date("Y-m-d H:i:s",time());
			$encode_pass=$this->authorization->strclean($this->input->post('password'));
			$encode_pass=$this->authorization->encode_password($encode_pass,$date);
			$users = array(
				'id' => $stu_id ,
				'password' => $encode_pass ,
				'auth_id' => 'stu' ,
				'created_date' => $date
			);

			$user_details = array(
				'id' => $stu_id ,
				'salutation' => $this->input->post('salutation') ,
				'first_name' => ucwords(strtolower($this->authorization->strclean($this->input->post('firstname')))) ,
				'middle_name' => ucwords(strtolower($this->authorization->strclean($this->input->post('middlename')))) ,
				'last_name' => ucwords(strtolower($this->authorization->strclean($this->input->post('lastname')))) ,
				'sex' => $this->input->post('sex') ,
				'category' => $this->input->post('category') ,
				'dob' => $this->input->post('dob') ,
				'email' => $this->authorization->strclean($this->input->post('email')) ,
				'photopath' => 'student/'.$stu_id.'/'.$upload['file_name'] ,
				'marital_status' => $this->input->post('mstatus') ,
				'physically_challenged' => $this->input->post('pd') ,
				'dept_id' => $this->input->post('department')
			);

			if($this->input->post('depends_on'))
			{
				$father_name = 'na';
				$mother_name = 'na';
				$father_occupation = 'na';
				$mother_occupation = 'na';
				$father_income = '0';
				$mother_income = '0';
				$guardian_name = ucwords(strtolower($this->authorization->strclean($this->input->post('guardian_name'))));
				$guardian_relation = ucwords(strtolower($this->authorization->strclean($this->input->post('guardian_relation_name'))));
			}
			else
			{
				$father_name = ucwords(strtolower($this->authorization->strclean($this->input->post('father_name'))));
				$mother_name = ucwords(strtolower($this->authorization->strclean($this->input->post('mother_name'))));
				$father_occupation = ucwords(strtolower($this->authorization->strclean($this->input->post('father_occupation'))));
				$mother_occupation = ucwords(strtolower($this->authorization->strclean($this->input->post('mother_occupation'))));
				$father_income = $this->input->post('father_gross_income');
				$mother_income = $this->input->post('mother_gross_income');
				$guardian_name = 'na';
				$guardian_relation = 'na';
			}

			$user_other_details = array(
				'id' => $stu_id ,
				'religion' => strtolower($this->input->post('religion')) ,
				'nationality' => strtolower($this->authorization->strclean($this->input->post('nationality'))) ,
				'kashmiri_immigrant' => $this->input->post('kashmiri') ,
				'hobbies' => strtolower($this->authorization->strclean($this->input->post('hobbies'))) ,
				'fav_past_time' => strtolower($this->authorization->strclean($this->input->post('favpast'))) ,
				'birth_place' => strtolower($this->authorization->strclean($this->input->post('pob'))) ,
				'mobile_no' => $this->input->post('mobile') ,
				'father_name' => $father_name ,
				'mother_name' => $mother_name
			);

			$admn_based_on = $this->input->post('admn_based_on');
			$iit_jee_rank = $this->input->post('iitjee_rank');
			$iit_jee_cat_rank = $this->input->post('iitjee_cat_rank');
			$cat_score = $this->input->post('cat_score');
			$gate_score = $this->input->post('gate_score');
			if($admn_based_on === 'others')
			{
				$admn_based_on = $this->input->post('other_mode_of_admission');
				$iit_jee_rank = '0';
				$iit_jee_cat_rank = '0';
				$cat_score = '0';
				$gate_score = '0';
			}
			else if($admn_based_on === 'iitjee')
			{
				$cat_score = '0';
				$gate_score = '0';
			}
			else if($admn_based_on === 'gate')
			{
				$iit_jee_rank = '0';
				$iit_jee_cat_rank = '0';
				$cat_score = '0';
			}
			else if($admn_based_on === 'cat')
			{
				$iit_jee_rank = '0';
				$iit_jee_cat_rank = '0';
				$gate_score = '0';
			}
			else
			{
				$iit_jee_rank = '0';
				$iit_jee_cat_rank = '0';
				$cat_score = '0';
				$gate_score = '0';
			}

			$stu_details = array(
				'admn_no' => $stu_id ,
				'admn_date' => $this->input->post('entrance_date') ,
				'enrollment_no' => $this->input->post('roll_no') ,
				'type' => $this->input->post('stu_type') ,
				'identification_mark' => strtolower($this->authorization->strclean($this->input->post('identification_mark'))) ,
				'parent_mobile_no' => $this->input->post('parent_mobile') ,
				'parent_landline_no' => $this->input->post('parent_landline') ,
				'alternate_mobile_no' => $this->input->post('alternate_mobile') ,
				'alternate_email_id' => $this->input->post('alternate_email_id') ,
				'migration_cert' => $this->input->post('migration_cert') ,
				'name_in_hindi' => $this->input->post('stud_name_hindi') ,
				'blood_group' => $this->input->post('blood_group')
			);

			$stu_fee_details = array(
				'id' => $stu_id ,
				'fee_mode' => $this->input->post('fee_paid_mode') ,
				'fee_amount' => $this->input->post('fee_paid_amount') ,
				'fee_in_favour' => 'indian school of mines' ,
				'payment_made_on' => $this->input->post('fee_paid_date') ,
				'transaction_id' => $this->input->post('fee_paid_dd_chk_onlinetransaction_cashreceipt_no')
			);

			$stu_other_details = array(
				'id' => $stu_id ,
				'fathers_occupation' => $father_occupation ,
				'mothers_occupation' => $mother_occupation ,
				'fathers_annual_income' => $father_income ,
				'mothers_annual_income' => $mother_income ,
				'guardian_name' => $guardian_name ,
				'guardian_relation' => $guardian_relation ,
				'bank_name' => $this->authorization->strclean($this->input->post('bank_name')) ,
				'account_no' => $this->authorization->strclean($this->input->post('bank_account_no')) ,
				'aadhaar_card_no' => $this->authorization->strclean($this->input->post('aadhaar_no')) ,
				'extra_curricular_activity' => strtolower($this->authorization->strclean($this->input->post('extra_activity'))) ,
				'other_relevant_info' => strtolower($this->authorization->strclean($this->input->post('any_other_information')))
			);

			$stu_academic = array(
				'id' => $stu_id ,
				'auth_id' => $this->input->post('stu_type') ,
				'enrollment_year' => date('Y',strtotime($this->input->post('entrance_date'))) ,
				'admn_based_on' => $admn_based_on ,
				'iit_jee_rank' => $iit_jee_rank ,
				'iit_jee_cat_rank' => $iit_jee_cat_rank ,
				'cat_score' => $cat_score ,
				'gate_score' => $gate_score ,
				'course_id' => $this->input->post('course') ,
				'branch_id' => $this->input->post('branch') ,
				'semester' => $this->input->post('semester')
			);

			if($this->input->post('correspondence_addr'))
			{
				$user_address = array(
					array(
						'id' => $stu_id ,
						'line1' => $this->authorization->strclean($this->input->post('line11')) ,
						'line2' => $this->authorization->strclean($this->input->post('line21')) ,
						'city' => strtolower($this->authorization->strclean($this->input->post('city1'))) ,
						'state' => strtolower($this->authorization->strclean($this->input->post('state1'))) ,
						'pincode' => $this->input->post('pincode1') ,
						'country' => strtolower($this->authorization->strclean($this->input->post('country1'))) ,
						'contact_no' => $this->input->post('contact1') ,
						'type' => 'present'
					),
					array(
						'id' => $stu_id ,
						'line1' => $this->authorization->strclean($this->input->post('line12')) ,
						'line2' => $this->authorization->strclean($this->input->post('line22')) ,
						'city' => strtolower($this->authorization->strclean($this->input->post('city2'))) ,
						'state' => strtolower($this->authorization->strclean($this->input->post('state2'))) ,
						'pincode' => $this->input->post('pincode2') ,
						'country' => strtolower($this->authorization->strclean($this->input->post('country2'))) ,
						'contact_no' => $this->input->post('contact2') ,
						'type' => 'permanent'
					)
				);
			}
			else
			{
				$user_address = array(
					array(
						'id' => $stu_id ,
						'line1' => $this->authorization->strclean($this->input->post('line11')) ,
						'line2' => $this->authorization->strclean($this->input->post('line21')) ,
						'city' => strtolower($this->authorization->strclean($this->input->post('city1'))) ,
						'state' => strtolower($this->authorization->strclean($this->input->post('state1'))) ,
						'pincode' => $this->input->post('pincode1') ,
						'country' => strtolower($this->authorization->strclean($this->input->post('country1'))) ,
						'contact_no' => $this->input->post('contact1') ,
						'type' => 'present'
					),
					array(
						'id' => $stu_id ,
						'line1' => $this->authorization->strclean($this->input->post('line12')) ,
						'line2' => $this->authorization->strclean($this->input->post('line22')) ,
						'city' => strtolower($this->authorization->strclean($this->input->post('city2'))) ,
						'state' => strtolower($this->authorization->strclean($this->input->post('state2'))) ,
						'pincode' => $this->input->post('pincode2') ,
						'country' => strtolower($this->authorization->strclean($this->input->post('country2'))) ,
						'contact_no' => $this->input->post('contact2') ,
						'type' => 'permanent'
					),
					array(
						'id' => $stu_id ,
						'line1' => $this->authorization->strclean($this->input->post('line13')) ,
						'line2' => $this->authorization->strclean($this->input->post('line23')) ,
						'city' => strtolower($this->authorization->strclean($this->input->post('city3'))) ,
						'state' => strtolower($this->authorization->strclean($this->input->post('state3'))) ,
						'pincode' => $this->input->post('pincode3') ,
						'country' => strtolower($this->authorization->strclean($this->input->post('country3'))) ,
						'contact_no' => $this->input->post('contact3') ,
						'type' => 'correspondance'
					)
				);
			}

			$exam = $this->input->post('exam4');
			$branch = $this->input->post('branch4');
			$clgname = $this->input->post('clgname4');
			$year = $this->input->post('year4');
			$grade = $this->input->post('grade4');
			$div = $this->input->post('div4');

			$n = count($clgname);
			$i = 0;
			$class = '10';
			while($i<2)
			{
				$stu_education_details[$i]['id'] = $stu_id;
				$stu_education_details[$i]['sno'] = $i+1;
				$stu_education_details[$i]['exam'] = strtolower($this->authorization->strclean($exam[$i]));
				$stu_education_details[$i]['branch'] = $class;
				$stu_education_details[$i]['institute'] = strtolower($this->authorization->strclean($clgname[$i]));
				$stu_education_details[$i]['year'] = $year[$i];
				$stu_education_details[$i]['grade'] = strtolower($this->authorization->strclean($grade[$i]));
				$stu_education_details[$i]['division'] = strtolower($div[$i]);
				$class = '12';
				$i++;
			}
			while($i<$n)
			{
				$stu_education_details[$i]['id'] = $stu_id;
				$stu_education_details[$i]['sno'] = $i+1;
				$stu_education_details[$i]['exam'] = strtolower($this->authorization->strclean($exam[$i]));
				$stu_education_details[$i]['branch'] = strtolower($this->authorization->strclean($branch[$i-2]));
				$stu_education_details[$i]['institute'] = strtolower($this->authorization->strclean($clgname[$i]));
				$stu_education_details[$i]['year'] = $year[$i];
				$stu_education_details[$i]['grade'] = strtolower($this->authorization->strclean($grade[$i]));
				$stu_education_details[$i]['division'] = strtolower($div[$i]);
				$i++;
			}

			$this->load->model('user/users_model','',TRUE);
			$this->load->model('user/user_details_model','',TRUE);
			$this->load->model('user/user_other_details_model','',TRUE);
			$this->load->model('user/user_address_model','',TRUE);
			$this->load->model('student/student_details_model','',TRUE);
			$this->load->model('student/student_other_details_model','',TRUE);
			$this->load->model('student/student_fee_details_model','',TRUE);
			$this->load->model('student/student_academic_model','',TRUE);
			$this->load->model('student/student_education_details_model','',TRUE);

			$this->db->trans_start();

			$this->users_model->insert($users);
			$this->user_details_model->insert($user_details);
			$this->user_other_details_model->insert($user_other_details);
			$this->user_address_model->insert_batch($user_address);
			$this->student_academic_model->insert($stu_academic);
			$this->student_details_model->insert($stu_details);
			$this->student_other_details_model->insert($stu_other_details);
			$this->student_fee_details_model->insert($stu_fee_details);
			$this->student_education_details_model->insert_batch($stu_education_details);

			$this->db->trans_complete();

			redirect("ftp_login(ftp_stream, username, password)");
		}
		else
		{}
	}

	function upload_image($stu_id = '', $name ='')
	{
		$config['upload_path'] = 'assets/images/student/'.strtolower($stu_id).'/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']  = '200';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		if(isset($_FILES[$name]['name']))
    	{
            if($_FILES[$name]['name'] == "")
        		$filename = "";
            else
			{
                $filename=$this->security->sanitize_filename(strtolower($_FILES[$name]['name']));
                $ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
                $filename='stu_'.$stu_id.'_'.date('YmdHis').$ext;
            }
        }
        else
        {
	       	$this->index('ERROR: File Name not set.');
			return FALSE;
	    }

		$config['file_name'] = $filename;

		if(!is_dir($config['upload_path']))	//create the folder if it's not already exists
	    {
			mkdir($config['upload_path'],0777,TRUE);
    	}

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($name))		//do_multi_upload is back compatible with do_upload
		{
			$error = $this->upload->display_errors();
			$this->index('ERROR: '.$error);
			return FALSE;
		}
		else
		{
			$upload_data = $this->upload->data();
			return $upload_data;
		}
	}
}