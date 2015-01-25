<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student_edit extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('deo'));
	}

	function index($error = '')
	{
		$this->addJS('student/edit_student_details_script.js');
		$data['error'] = $error;
		$this->drawHeader('Edit Student Details');
		$this->load->view('student/edit/student_edit_detail_index',$data);
		$this->drawFooter();
		//$this->select_form($error);
	}

	function select_form($error = '')
	{
	}

	function select_details_to_edit()
	{
		$form = $this->input->post('select_form');
		$stu_id = $this->input->post('stu_id');
		switch($form)
		{
			case 0: $this->edit_profile_pic($stu_id);break;
			case 1:	$this->edit_basic_details($stu_id);break;
			case 2: $this->edit_education_details($stu_id);break; 
		}
	}

	function edit_profile_pic($stu_id = '')
	{
		$this->addJS("student/edit_profile_picture_script.js");
		$this->load->model('user/user_details_model','',TRUE);
		$res=$this->user_details_model->getUserById($stu_id);
		$data['photopath'] = ($res == FALSE)?	FALSE:$res->photopath;
		$data['stu_id']=$stu_id;
		$this->drawHeader('Change Student picture');
		$this->load->view('student/edit/profile_pic',$data);
		$this->drawFooter();
	}

	function update_profile_pic($stu_id)
	{
		$upload = $this->upload_image($stu_id,'photo');
		if($upload)
		{
			$this->load->model('user/user_details_model','',TRUE);
			$res=$this->user_details_model->getUserById($stu_id);
			$old_photo = ($res == FALSE)?	FALSE:$res->photopath;
			$this->user_details_model->updateById(array('photopath'=>'student/'.$stu_id.'/'.$upload['file_name']),$stu_id);
			if($old_photo)	unlink(APPPATH.'../assets/images/'.$old_photo);

			//$this->edit_validation($stu_id,'profile_pic_status');

			$this->session->set_flashdata('flashSuccess','student '.$stu_id.' profile picture updated and sent for validation.');
			redirect('student/student_edit');
		}
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

	private function edit_basic_details($stu_id)
	{
		$this->addJS("student/edit_basic_details_script.js");

		$data['stu_id']=$stu_id;
		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('user/user_other_details_model','',TRUE);
		$this->load->model('student/student_details_model','',TRUE);
		$this->load->model('student/student_other_details_model','',TRUE);
		$this->load->model('student/student_fee_details_model','',TRUE);
		$this->load->model('student/student_academic_model','',TRUE);
		$this->load->model('user/user_address_model','',TRUE);

		$data['user_details']=$this->user_details_model->getUserById($stu_id);
		$data['user_other_details']=$this->user_other_details_model->getUserById($stu_id);
		$data['stu_basic_details']=$this->student_details_model->get_student_details_by_id($stu_id);
		$data['stu_other_details']=$this->student_other_details_model->get_student_other_details_by_id($stu_id);
		$data['stu_fee_details']=$this->student_fee_details_model->get_stu_fee_details_by_id($stu_id);
		$data['stu_academic_details']=$this->student_academic_model->get_stu_academic_details_by_id($stu_id);
		$data['permanent_address']=$this->user_address_model->getAddrById($stu_id,'permanent');
		$data['present_address']=$this->user_address_model->getAddrById($stu_id,'present');
		$data['present_address']=$this->user_address_model->getAddrById($stu_id,'correspondence');

		$this->drawHeader('Edit basic details');
		$this->load->view('student/edit/student_edit_basic_details',$data);
		$this->drawFooter();
	}
}

?>