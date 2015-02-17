<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Regular_check_acdamic extends MY_Controller
{		
		function __construct()
			{
				parent::__construct(array('deo'));
			}
	
	function index(){
		
		$this->load->model('student_sem_form/sbasic_model','',TRUE);
		$results['data']=$this->sbasic_model->hod_vaise_student($this->session->userdata('dept_id'));
			
			//Importent for table search view JS//
		$this->drawHeader('Semester form from '.$this->session->userdata('dept_id').' Department');
		$this->load->view('student_sem_form/department/department.php',$results);
		$this->drawFooter();
		
	}
	function view($id){
			
			if(isset($id)){
				
				$this->load->model('student_sem_form/sbasic_model','',TRUE);
				$this->load->model('student_sem_form/get_subject','',TRUE);
				$data['student']=$this->sbasic_model->hod_view_student($id);
				$data['subjects']=$this->get_subject->getSubject($data['student'][0]->course_id,$data['student'][0]->branch_id,($data['student'][0]->semester+1));
				$data['confirm']=$this->get_subject->getConfirm($data['student'][0]->form_id);
				
				$this->load->view('student_sem_form/department/view.php',$data);
			}
	}
	
	function updatehod(){
			echo $this->input->post('hods'); die();
			if($this->input->post('hods')){
				$this->load->model('student_sem_form/sbasic_model','',TRUE);
				
				$data['acdamic_status'] = $this->input->post('hods');
				$data['acdamic_remark'] = $this->input->post('hodRemark');
				$data['acdamic_time'] = date('Y-m-d H:i:s');
			//	$this->sbasic_model->udate_hod($this->input->post('formId'),$this->input->post('stuId'),$data);				redirect('/student_sem_form/regular_check', 'refresh');
			}
			
		}
}