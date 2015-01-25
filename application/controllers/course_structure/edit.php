<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo'));
		$this->addJS("course_structure/add.js");
		$this->addJS("course_structure/edit.js");
		$this->addCSS("course_structure/cs_layout.css");
		$this->load->model('course_structure/basic_model','',TRUE);
		
	}

	public function index($error='')
	{
		//edited
		$data = array();
		
		$data["result_dept"] = $this->basic_model->get_depts();
		//$data["result_course"] = $this->basic_model->get_course();
		//$data["result_branch"] = $this->basic_model->get_branches();
		
		$this->drawHeader();
		$this->load->view('course_structure/Edit/edit_home',$data);
		$this->drawFooter();
	}
	
	public function EditCourseStructure()
	{
		$data = array();
		$data["CS_session"]['dept_id'] = $this->input->post("dept");
		$data["CS_session"]['course_id'] = $this->input->post("course");
		$data["CS_session"]['branch_id'] = $this->input->post("branch");
		$data["CS_session"]['semester'] = $this->input->post("sem");
		$data["CS_session"]['session'] = $this->input->post("session");
		
		$dept_id = $data["CS_session"]['dept_id'];
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
		
		if($semester == 0)
		{
			$start_semester = 1;
			$end_semester = 2*$row_course[0]->duration;
			//$result_ids = $this->basic_model->get_subjects_by_sem($counter,$aggr_id);	
		}
		else
		{
			$start_semester = $semester;
			$end_semester = $semester;
			//
		}
		$data['flag'] = 1;
		for($counter=$start_semester;$counter<=$end_semester;$counter++)
		{
			$result_ids = $this->basic_model->get_subjects_by_sem($counter,$aggr_id);	
		  	$i=1;
		  foreach($result_ids as $row)
		  {
		   	   $data["subjects"]["subject_details"][$counter][$i] = $this->basic_model->get_subject_details($row->id);
			   $group_id = $data["subjects"]["subject_details"][$counter][$i]->elective;
			   
			   $data["subjects"]["sequence_no"][$counter][$i] = $this->basic_model->get_course_structure_by_id($data["subjects"]["subject_details"][$counter][$i]->
			   id)->sequence;
			   
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
		$this->load->view('course_structure/Edit/edit',$data);
		$this->drawFooter();

	}
	
	public function UpdateCourseStructure($subjectdetails)
	{
		echo $subjectdetails;
		//$this->basic_model->update
		
		//echo $subjectdetails[id];
		//echo $subjectdetails;
		
	}
	
	public function DeleteCourseStructure($semester,$aggr_id)
	{
		$this->load->model("basic_model");
		$coursestructure_details['semester'] = $semester;
		$coursestructure_details['aggr_id'] = $aggr_id;

		if($this->basic_model->delete_course_structure($coursestructure_details))
			echo true;
		else 
			echo false;
	}
	
}