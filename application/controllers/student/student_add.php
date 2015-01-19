<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student_add extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('deo'));
	}

	public function index($error='')
	{
		$this->load->model('student/Student_current_entry_model','',TRUE);
		$entry = $this->Student_current_entry_model->get_current_entry();
		if($entry === FALSE)
			$this->step(0,'',$error);
		else
			$this->step($entry->curr_step,$entry->id,$error);
	}

	private function step($num = 0,$student = '',$error = '')
	{
		switch($num)
		{
			case 0: $this->add_basic_details($error);break;
			case 1: $this->add_student_education_details($student,$error);break;
		}
	}

	public function add_basic_details($error = '')
	{
		//Handling Error
		$data['error'] = $error;

		//Fetching Departments
		$this->load->model('Departments_model','',TRUE);
		$data['academic_departments']=$this->Departments_model->get_departments('academic');
		$depts = $data['academic_departments'];
		//var_dump($depts[0]->id);
		$this->load->model('Branches_model','',TRUE);
		$data['branches']=$this->Branches_model->get_branches_by_department($depts[0]->id);
		//var_dump($data['branches']);

		$branch = $data['branches'];
		$this->load->model('Courses_model','',TRUE);
		if($branch)
			$data['courses']=$this->Courses_model->get_courses_by_branch($branch[0]->id);
		else
			$data['courses']=FALSE;

		//javascript
		$this->addJS('student/basic_details_script.js');
		//$this->addJS("employee/print_script.js");

		//view
		$this->drawHeader("Add Student Details");
		$this->load->view('student/add/student_detail',$data);
		$this->drawFooter();

	}

	public function add_student_education_details($stu_id = '' ,$error = '')
	{
		$data['error'] = $error;
		$data['stu_id'] = $stu_id;
		$this->addJS("student/education_details_script.js");
		$this->drawHeader('Add Education Details');
		$this->load->view('student/add/student_educational_details',$data);
		$this->drawFooter();
	}

	public function insert_basic_details()
	{
		$stu_id = strtolower($this->input->post('stu_id'));
		$upload = $this->upload_image($stu_id,'photo');
		if($upload !== FALSE)
		{
			//.var_dump($upload);return;
			$users = array(
				'id' => $stu_id ,
				'password' => '' ,
				'auth_id' => 'stu' ,
				'created_date' => ''
			);

			$user_details = array(
				'id' => $stu_id ,
				'salutation' => $this->input->post('salutation') ,
				'first_name' => ucwords(strtolower($this->input->post('firstname'))) ,
				'middle_name' => ucwords(strtolower($this->input->post('middlename'))) ,
				'last_name' => ucwords(strtolower($this->input->post('lastname'))) ,
				'sex' => strtolower($this->input->post('sex')) ,
				'category' => $this->input->post('category') ,
				'dob' => $this->input->post('dob') ,
				'email' => $this->input->post('email') ,
				'photopath' => 'student/'.$stu_id.'/'.$upload['file_name'] ,
				'marital_status' => strtolower($this->input->post('mstatus')) ,
				'physically_challenged' => strtolower($this->input->post('pd')) ,
				'dept_id' => $this->input->post('department')
			);

			$user_other_details = array(
				'id' => $stu_id ,
				'religion' => strtolower($this->input->post('religion')) ,
				'nationality' => strtolower($this->input->post('nationality')) ,
				'kashmiri_immigrant' => $this->input->post('kashmiri') ,
				'hobbies' => strtolower($this->input->post('hobbies')) ,
				'fav_past_time' => strtolower($this->input->post('favpast')) ,
				'birth_place' => strtolower($this->input->post('pob')) ,
				'mobile_no' => $this->input->post('mobile') ,
				'father_name' => ucwords(strtolower($this->input->post('father_name'))) ,
				'mother_name' => ucwords(strtolower($this->input->post('mother_name')))
			);

			$stu_details = array(
				'admn_no' => $stu_id ,
				'admn_date' => $this->input->post('entrance_date') ,
				'enrollment_no' => $this->input->post('roll_no') ,
				'enrollment_year' => date('Y',strtodate($this->input->post('entrance_date'))) ,
				'admn_based_on' => $this->input->post('admn_based_on') ,
				'type' => '' ,
				'session' => '' ,
				'identification_mark' => strtolower($this->input->post('identification_mark')) ,
				'parent_mobile_no' => $this->input->post('parent_mobile') ,
				'parent_landline_no' => $this->input->post('parent_landline') ,
				'alternate_email_id' => $this->input->post('alternate_email_id') ,
				'migration_cert' => $this->input->post('migration_cert')
			);

			$stu_fee_details = array(
				'id' => $stu_id ,
				'fee_mode' => $this->input->post('fee_paid_mode') ,
				'account_no' => $this->input->post('bank_account_no') ,
				'fee_date' => $this->input->post('fee_paid_date') ,
				'fee_amount' => $this->input->post('fee_paid_amount') ,
				'fee_in_favour' => 'Indian School of Mines' ,
				'payment_made_on' => $this->input->post('fee_paid_date') ,
				'bank_name' => $this->input->post('bank_name') ,
				'transaction_id' => $this->input->post('fee_paid_dd_chk_onlinetransaction_cashreceipt_no')
			);

			$stu_other_details = array(
				'id' => $stu_id ,
				'fathers_occupation' => $this->input->post('father_occupation') ,
				'mothers_occupation' => $this->input->post('mother_occupation') ,
				'fathers_annual_income' => $this->input->post('father_gross_income') ,
				'mothers_annual_income' => $this->input->post('mother_gross_income') ,
				'gaurdian_name' => $this->input->post('guardian_name') ,
				'gaurdian_relation' => $this->input->post('guardian_relation_name')
			);

			if($this->input->post('admn_based_on') == 'others')
			{
				$stu_academic = array(
					'id' => $stu_id ,
					'auth_id' => $this->input->post('stu_type') ,
					'course_id' => $this->input->post('course') ,
					'branch_id' => $this->input->post('branch') ,
					'course_year' => '' ,
					'semester' => '' ,
					'section' => '' ,
					'admission_based_on' => $this->input->post('other_mode_of_admission')
				);
			}
			else
			{
				$stu_academic = array(
					'id' => $stu_id ,
					'auth_id' => $this->input->post('stu_type') ,
					'course_id' => $this->input->post('course') ,
					'branch_id' => $this->input->post('branch') ,
					'course_year' => '' ,
					'semester' => '' ,
					'section' => '' ,
					'admission_based_on' => $this->input->post('admn_based_on')
				);
			}

			if($this->input->post('corresopndence_addr'))
			{
				$user_address = array(
					array(
						'id' => $stu_id ,
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
						'id' => $stu_id ,
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
			}
			else
			{
				$user_address = array(
					array(
						'id' => $stu_id ,
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
						'id' => $stu_id ,
						'line1' => $this->input->post('line12') ,
						'line2' => $this->input->post('line22') ,
						'city' => strtolower($this->input->post('city2')) ,
						'state' => strtolower($this->input->post('state2')) ,
						'pincode' => $this->input->post('pincode2') ,
						'country' => strtolower($this->input->post('country2')) ,
						'contact_no' => $this->input->post('contact2') ,
						'type' => 'permanent'
					),
					array(
						'id' => $stu_id ,
						'line1' => $this->input->post('line13') ,
						'line2' => $this->input->post('line23') ,
						'city' => strtolower($this->input->post('city3')) ,
						'state' => strtolower($this->input->post('state3')) ,
						'pincode' => $this->input->post('pincode3') ,
						'country' => strtolower($this->input->post('country3')) ,
						'contact_no' => $this->input->post('contact3') ,
						'type' => 'correspondance'
					)
				);
			}

			$stu_current_entry = array(
				'id' => $stu_id ,
				'curr_step' => 1
			);

			$this->load->model('user/Users_model','',TRUE);
			$this->load->model('user/User_details_model','',TRUE);
			$this->load->model('user/User_other_details_model','',TRUE);
			$this->load->model('user/User_address_model','',TRUE);
			$this->load->model('student/Student_details_model','',TRUE);
			$this->load->model('student/Student_other_details_model','',TRUE);
			$this->load->model('student/Student_fee_details_model','',TRUE);
			$this->load->model('student/Student_academic_model','',TRUE);
			$this->load->model('student/Student_current_entry_model','',TRUE);

			$this->db->trans_start();

			$this->Users_model->insert($users);
			$this->User_details_model->insert($user_details);
			$this->User_other_details_model->insert($user_other_details);
			$this->User_address_model->insert_batch($user_address);
			$this->Student_academic_model->insert($stu_academic);
			$this->Student_details_model->insert($stu_details);
			$this->Student_other_details_model->insert($stu_other_details);
			$this->Student_fee_details_model->insert($stu_fee_details);
			$this->Student_current_entry_model->insert($stu_current_entry);

			$this->db->trans_complete();

			redirect('student/student_add');
		}
	}

	function insert_education_details()
	{
		$stu_id = strtolower($this->input->post('student_id'));
		$exam = $this->input->post('exam4');
		$branch = $this->input->post('branch4');
		$clgname = $this->input->post('clgname4');
		$year = $this->input->post('year4');
		$grade = $this->input->post('grade4');
		$div = $this->input->post('div4');

		$n = count($exam);
		$i = 0;
		while($i<$n)
		{
			$stu_education_details[$i]['id'] = $stu_id;
			$stu_education_details[$i]['sno'] = $i+1;
			$stu_education_details[$i]['exam'] = strtolower($exam[$i]);
			$stu_education_details[$i]['branch'] = strtolower($branch[$i]);
			$stu_education_details[$i]['institute'] = strtolower($clgname[$i]);
			$stu_education_details[$i]['year'] = $year[$i];
			$stu_education_details[$i]['grade'] = strtolower($grade[$i]);
			$stu_education_details[$i]['division'] = strtolower($div[$i]);
			$i++;
		}

		$this->load->model('student/student_education_details_model','',TRUE);
		$this->load->model('student/student_current_entry_model','',TRUE);

		$this->db->trans_start();

		$this->student_education_details_model->insert_batch($stu_education_details);
		$this->student_current_entry_model->delete($stu_id);

		$this->db->trans_complete();

		redirect('student/student_add');
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

	    //dont upload files with no file name
		/*for($i=0 ; $i < $n_family ; $i++)
			if($_FILES[$name]["name"][$i] == '')
			{
				unset($_FILES[$name]["name"][$i]);
			}*/

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