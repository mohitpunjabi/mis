<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elective_offered extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('hod'));
		
		$this->addJS("course_structure/edit_view_cs.js");
		$this->addJS("course_structure/edit.js");
		$this->addCSS("course_structure/cs_layout.css");
		$this->load->library('session');
		$this->load->model('course_structure/basic_model','',TRUE);
	}

	public function index($error='')
	{
		$data = array();
		$course = $this->input->post('course');
		$branch = $this->input->post('branch');
		$batch = $this->input->post('batch');
		$semester = $this->input->post('semester');
		
		$result_course_details = $this->basic_model->get_course_details_by_id($course);
		$duration = $result_course_details[0]->duration;
		
		$aggr_id = $course."_".$branch."_".substr(($batch-$duration),2,3).(substr(($batch-$duration),2,3)+1);
		$data['course'] = $course;
		$data['branch'] = $branch;
		$data['batch'] = $batch;
		$data['semester'] = $semester;
		$data['aggr_id'] = $aggr_id;
		
		
		$subject_details = $this->basic_model->select_all_subject_by_aggr_id_and_semester($aggr_id,$semester);
		
		$i =0;
		$j = 0;
		
		$data['group_id'] = array();
		$data['elective_count'] = 0;
		foreach($subject_details as $row)
		{
			if($row->elective != 0)
			{
				$group_id = $row->elective;
				if(!in_array($group_id,$data['group_id']))
				{
					$data['group_id'][$j] = $group_id;
					$data['subjects'][$group_id]['number_of_options'] = substr($group_id,0,1);
					$group_details  = $this->basic_model->select_elective_group_by_group_id($group_id);
					$data['elective_name'][$j] = $group_details[0]->elective_name;					
					$data['elective_count']++;
					$data['subject'][$group_id]['count'] = 0;
					$i = 0;
					$j++;	
				}
				
				$data['subject'][$group_id]['id'][$i] = $row->id;
				$data['subject'][$group_id]['subject_id'][$i] = $row->subject_id;
				$data['subject'][$group_id]['subject_name'][$i] = $row->name;
				$data['subject'][$group_id]['lecture'][$i] = $row->lecture;
				$data['subject'][$group_id]['tutorial'][$i]= $row->tutorial;
				$data['subject'][$group_id]['practical'][$i]= $row->practical;
				$data['subject'][$group_id]['credit_hours'][$i]= $row->credit_hours;
				$data['subject'][$group_id]['contact_hours'][$i]= $row->contact_hours;
				$data['subject'][$group_id]['count']++;
				$i++;
			}			
		}
		
		$this->session->set_userdata($data);
		$this->drawHeader();
		$this->load->view('course_structure/LoadOfferedElective',$data);
		$this->drawFooter();
	}
	
	public function CreateMapping()
	{
		$formValues = $this->input->post('checkbox');
		$aggr_id = $this->session->userdata('aggr_id');
		foreach($formValues as $key=>$val)
		{
			$data['aggr_id'] = $aggr_id;
			$data['id'] = $val;
			$this->basic_model->insert_elective_offered($data);		
		}
		$this->session->set_flashdata("flashSuccess","Elective Added Successfully");
   		redirect("elective_offered/home");
	}
}
?>