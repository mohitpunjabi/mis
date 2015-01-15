<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo'));
		$this->load->library('session');
		$this->load->model('CourseStructure/basic_model','',TRUE);
	}

	public function index($error='')
	{
		//edited
		$data = array();
		$data["result_course"] = $this->basic_model->get_course();
		$data["result_branch"] = $this->basic_model->get_branches();
		$this->drawHeader();
		$this->load->view('CourseStructure/Edit/edit_home',$data);
		$this->drawFooter();
	}
	
	public function EditCourseStructure()
	{
		//$this->load->model('CourseStructure/view_model','',TRUE);
		
		$data = array();
		$data["CS_session"]['course_id'] = $this->input->post("course");
		$data["CS_session"]['branch_id'] = $this->input->post("branch");
		$data["CS_session"]['semester'] = $this->input->post("sem");
		$data["CS_session"]['session'] = $this->input->post("session");
		
		$course_id = $data["CS_session"]['course_id'];
		$branch_id = $data["CS_session"]['branch_id'];
		$semester = $data["CS_session"]['semester'];
		$session = $data["CS_session"]['session'];
		
		$aggr_id = $course_id.'_'.$branch_id.'_'.$session;
		$data["CS_session"]['aggr_id'] = trim($aggr_id);
		
		$row_course = $this->basic_model->get_course_details_by_id($course_id);
		$row_branch = $this->basic_model->get_branch_details_by_id($branch_id);
		
		$data["CS_session"]['duration']=$row_course[0]->duration;
		$data["CS_session"]['course_name']=$row_course[0]->name;
		$data["CS_session"]['branch_name']=$row_branch[0]->name;
		
		for($counter=1;$counter<=2*$row_course[0]->duration;$counter++)
		{
		  $result_ids = $this->basic_model->get_subjects_by_sem($counter,$aggr_id);
		  $i=1;
		  foreach($result_ids as $row)
		  {
		   	   $data["subjects"]["subject_details"][$counter][$i] = $this->basic_model->get_subject_details($row->id);
			   $data["subjects"]["sequence_no"][$counter][$i] = $this->basic_model->get_course_structure_by_id($data["subjects"]["subject_details"][$counter][$i]->
			   id)->sequence;
			   $group_id = $data["subjects"]["subject_details"][$counter][$i]->elective;
			   $data["subjects"][$group_id] = 0;
			   //
			   if($group_id != 0)
			   {
			   	$data["subjects"]["group_details"][$counter][$i] = $this->basic_model->select_elective_group_by_group_id($group_id);
			    $data["subjects"]["elective_count"][$group_id]++;
			   }
			   $i++;
		  }
		  $data["subjects"]["count"][$counter]=$i-1;
		}	
		$this->session->set_userdata($data);
		
		$this->drawHeader("Course structure");  
		$this->load->view('CourseStructure/print_cs',$data);
		$this->drawFooter();
	}
	
}