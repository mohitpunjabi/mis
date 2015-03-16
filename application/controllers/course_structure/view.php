<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo','hod'));
		$this->addJS("course_structure/add.js");
		$this->load->model('course_structure/basic_model','',TRUE);
	}

	public function index($userid= '')
	{
		$data = array();	
		$data['result_dept'] = $this->basic_model->get_depts();
		$data["result_course"] = $this->basic_model->get_course();
		$data["result_branch"] = $this->basic_model->get_branches();
		$this->drawHeader("View Course Structure");
		$this->load->view('course_structure/View/view_home',$data);
		$this->drawFooter();
	}
	
	public function ViewCourseStructure()
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
		
		if($data["CS_session"]['dept_id'] == "comm")
		{
			$data['CS_session']['group'] = $this->input->post('group');	
		}
		
		$expected_aggr_id = $course_id.'_'.$branch_id.'_'.$session;
		
		if(!$this->basic_model->check_if_aggr_id_exist_in_CS($expected_aggr_id))
		{
			$result_aggr_id = $this->basic_model->get_latest_aggr_id($course_id,$branch_id,$expected_aggr_id);
			$aggr_id = $result_aggr_id[0]->aggr_id;	
		}	
		else
			$aggr_id = $expected_aggr_id;
		
		
		$expected_common_aggr_id = "comm".'_'."comm".'_'.$session;
		if(!$this->basic_model->check_if_aggr_id_exist_in_CS($expected_common_aggr_id))
		{
			$result_aggr_id_common = $this->basic_model->get_latest_aggr_id("comm","comm",$expected_common_aggr_id);
			$aggr_id_common = $result_aggr_id_common[0]->aggr_id;	
		}	
		else
			$aggr_id_common = $expected_common_aggr_id;
		
		
		$expected_honour_aggr_id = "honour".'_'."honour".'_'.$session;
		if(!$this->basic_model->check_if_aggr_id_exist_in_CS($expected_honour_aggr_id))
		{
			$result_aggr_id_honour = $this->basic_model->get_latest_aggr_id("honour","honour",$expected_honour_aggr_id);
			$aggr_id_honour = $result_aggr_id_honour[0]->aggr_id;	
		}	
		else
			$aggr_id_honour = $expected_honour_aggr_id;
		
		$expected_minor_aggr_id = "minor".'_'."minor".'_'.$session;
		if(!$this->basic_model->check_if_aggr_id_exist_in_CS($expected_minor_aggr_id))
		{
			$result_aggr_id_minor = $this->basic_model->get_latest_aggr_id("minor","minor",$expected_minor_aggr_id);
			$aggr_id_minor = $result_aggr_id_minor[0]->aggr_id;	
		}	
		else
			$aggr_id_minor = $expected_minor_aggr_id;
		
		
		$course_branch_id = $this->basic_model->select_course_branch($course_id,$branch_id);
		$course_branch_id = $course_branch_id[0]->course_branch_id;
		
		$this->load->model("course_structure/syllabus");
		if($this->syllabus->check_if_syllabus_exist($aggr_id,$course_branch_id))
		{
			$result_syllabus = $this->syllabus->check_if_syllabus_exist($aggr_id,$course_branch_id);
			$data['syllabus_path'] = $result_syllabus[0]->syllabus_path;
		}
		
		$data["CS_session"]['aggr_id'] = trim($aggr_id);
		
		$row_course = $this->basic_model->get_course_details_by_id($course_id);
		$row_branch = $this->basic_model->get_branch_details_by_id($branch_id);
		
		$data["CS_session"]['duration']=$row_course[0]->duration;
		$data["CS_session"]['course_name']=$row_course[0]->name;
		$data["CS_session"]['branch_name']=$row_branch[0]->name;
		
		
		//$semester == 0 when All(for all semester) has been selected in view CS. 
		if($course_id == "honour" || $course_id == "minor")
		{
			if($semester == 0)
			{
				$start_semester = 5;
				$end_semester = 8;
			}
			else
			{
				$start_semester = $semester;
				$end_semester = $semester;
			}	
		}
		else
		{
			if($semester == 0)
			{
				$start_semester = 1;
				$end_semester = 2*$row_course[0]->duration;
			}
			else
			{
				$start_semester = $semester;
				$end_semester = $semester;
			}	
		}
		
		$data['CS_session']['start_semester'] = $start_semester;
		$data['CS_session']['end_semester'] = $end_semester;
		$data['flag'] = 1;
		
		
		for($k=$start_semester;$k<=$end_semester;$k++)
		{
			//if it is a common course branch ie for 1st year.
			if($data["CS_session"]['dept_id'] == "comm")
			{
				$counter = $k."_".$this->input->post("group");	
				$result_ids = $this->basic_model->get_subjects_by_sem($counter,$aggr_id_common);	
		  		$i=1;
				foreach($result_ids as $row)
			    {
				   $data["subjects"]["subject_details"][$counter][$i] = $this->basic_model->get_subject_details($row->id);
				   $group_id = $data["subjects"]["subject_details"][$counter][$i]->elective;
				   
				   if($group_id != 0)
				   {
					   $data['subjects']['group_details']['group_id'][$counter][$i] = $group_id;
					   $data["subjects"]["elective_count"][$group_id] = $this->basic_model->get_elective_count($group_id);
					   $group_detials = $this->basic_model->select_elective_group_by_group_id($group_id);
					   
					   $data["subjects"]["group_details"][$group_id] = $group_detials[0];	
					}
					   
					$data["subjects"]["sequence_no"][$counter][$i] = $row->sequence; 
				   
				   $data["subjects"][$group_id] = 0;
				   $i++;
			    }
			    $data["subjects"]["count"][$counter]=$i-1;		  
			}
			else
			{
				//calculate subject details for semester 1 and 2 which are common to all.
				if(($k == 1 || $k == 2) && ($row_course[0]->duration == 1 || $row_course[0]->duration == 4 || $row_course[0]->duration == 5))
				{	
					for($comm_group = 1;$comm_group <=2;$comm_group++)
					{
						$counter = $k."_".$comm_group;
						$result_ids = $this->basic_model->get_subjects_by_sem($counter,$aggr_id_common);	
						$i=1;
						foreach($result_ids as $row)
						{
						   $data["subjects"]["subject_details"][$counter][$i] = $this->basic_model->get_subject_details($row->id);
						   $group_id = $data["subjects"]["subject_details"][$counter][$i]->elective;
						   
						   if($group_id != 0)
						   {
							   $data['subjects']['group_details']['group_id'][$counter][$i] = $group_id;
							   $data["subjects"]["elective_count"][$group_id] = $this->basic_model->get_elective_count($group_id);
							   $group_detials = $this->basic_model->select_elective_group_by_group_id($group_id);
							   
							   $data["subjects"]["group_details"][$group_id] = $group_detials[0];	
							}
							   
							$data["subjects"]["sequence_no"][$counter][$i] = $row->sequence; 
						   
						   $data["subjects"][$group_id] = 0;
						   $i++;
						}
						$data["subjects"]["count"][$counter]=$i-1;		  			
					}		
				}
				
				//calculate subject details for other semester which are not common to all.
				else
				{
					//show the honour subjects for B.Tech 5th to 8th semester..
					if(($k == 5 || $k == 6 || $k == 7 || $k == 8) &&  (($course_id == "honour") || ($course_id !="honour" &&  $row_course[0]
					->duration == 4)))
					{
						//echo "honour";
						//die();
						$counter = $k;
						$result_ids = $this->basic_model->get_subjects_by_sem($counter,$aggr_id_honour);	
						$i=1;
						foreach($result_ids as $row)
						{
						   $data["subjects"]['honour']["subject_details"][$counter][$i] = $this->basic_model->get_subject_details($row->id);
						   $data["subjects"]['honour']["sequence_no"][$counter][$i] = $row->sequence; 
						   $i++;
						}
						$data["subjects"]['honour']["count"][$counter]=$i-1;	
					}
					
					if(($k == 5 || $k == 6 || $k == 7 || $k == 8) && (($course_id == "minor") || ($course_id != "minor" && $row_course[0]->duration
					== 4)))
					{
						
						$counter = $k;
						$result_ids = $this->basic_model->get_subjects_by_sem($counter,$aggr_id_minor);	
						$i=1;
						foreach($result_ids as $row)
						{
						   $data["subjects"]['minor']["subject_details"][$counter][$i] = $this->basic_model->get_subject_details($row->id);
						   $data["subjects"]['minor']["sequence_no"][$counter][$i] = $row->sequence; 
						   $i++;
						}
						$data["subjects"]['minor']["count"][$counter]=$i-1;	
					}
					
					if($course_id != "honour" && $course_id != "minor")
					{
						
					//show the normal B.Tech subjects
						$counter = $k;
						$result_ids = $this->basic_model->get_subjects_by_sem($counter,$aggr_id);	
						$i=1;
						foreach($result_ids as $row)
						{
						   $data["subjects"]["subject_details"][$counter][$i] = $this->basic_model->get_subject_details($row->id);
						   $group_id = $data["subjects"]["subject_details"][$counter][$i]->elective;
						   
						   if($group_id != 0)
						   {
							   $data['subjects']['group_details']['group_id'][$counter][$i] = $group_id;
							   $data["subjects"]["elective_count"][$group_id] = $this->basic_model->get_elective_count($group_id);
							   $group_detials = $this->basic_model->select_elective_group_by_group_id($group_id);
							   
							   $data["subjects"]["group_details"][$group_id] = $group_detials[0];	
							}
							   
							$data["subjects"]["sequence_no"][$counter][$i] = $row->sequence; 
						   
						   $data["subjects"][$group_id] = 0;
						   $i++;
						}
						$data["subjects"]["count"][$counter]=$i-1;
					}
				}	
			}
		}
		$this->session->set_userdata($data);
		
		$this->drawHeader("Course structure Valid From ".$session);  
		$this->load->view('course_structure/print_cs',$data);
		$this->drawFooter();
	}
	
}