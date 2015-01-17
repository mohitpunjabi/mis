<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elective_offered extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('hod'));
		
		$this->addJS("course_structure/add.js");
		$this->addJS("course_structure/edit.js");
		$this->addCSS("course_structure/cs_layout.css");
		$this->load->library('session');
		$this->load->model('elective_offered/basic_model','',TRUE);
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
		
		$elective_subjects  = $this->basic_model->select_elective_group_details_by_aggr_id($aggr_id);
		$i =0;
		foreach($elective_subjects as $row)
		{
			$data['group_id'][$i] = $row->group_id;
			$data['options_to_choose'][$i] = substr($group_id,0,0);
			$data['elective_name'][$i] = $row->elective_name;
			$elective_subjects = $this->basic_details->get_subject_details_by_group_id($group_id);
			$j =0;
			foreach($elective_subjects as $sub_details)
			{			
				$data['subject_id'][$i][$j] = $elective_subjects[0]->subject_id;
				$data['subject_name'][$i][$j] = $elective_subjects[0]->name;
				$data['lecture'][$i][$j] = $elective_subjects[0]->lecture;
				$data['tutorial'][$i][$j] = $elective_subjects[0]->tutorial;
				$data['practical'][$i][$j] = $elective_subjects[0]->practical;
				$data['credit_hours'][$i][$j] = $elective_subjects[0]->credit_hours;
				$data['contact_hours'][$i][$j] = $elective_subjects[0]->contact_hours;
				$j++;
			}
			$i++;
		}
		
		
		$this->drawHeader();
		$this->load->view('elective_offered/LoadOfferedElective',$data);
		$this->drawFooter();
	}
	}
?>