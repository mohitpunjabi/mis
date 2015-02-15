<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo'));
		$this->addJS("course_structure/add.js");
		$this->addJS("course_structure/edit.js");
		$this->load->model('course_structure/basic_model','',TRUE);
		
	}

	public function index($error='')
	{
		//edited
		$data = array();
		
		$data["result_dept"] = $this->basic_model->get_depts();
		//$data["result_course"] = $this->basic_model->get_course();
		//$data["result_branch"] = $this->basic_model->get_branches();
		
		$this->drawHeader("Edit Course Structure");
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
		
		for($k=$start_semester;$k<=$end_semester;$k++)
		{
			//if it is a common course branch ie for 1st year.
			if($data["CS_session"]['dept_id'] == "comm")
			{
				$counter = $k."_".$this->input->post("group");	
				$result_ids = $this->basic_model->get_subjects_by_sem($counter,$aggr_id);	
		  		$i=1;
				foreach($result_ids as $row)
				{
				   $data["subjects"]["subject_details"][$counter][$i] = $this->basic_model->get_subject_details($row->id);
				   $group_id = $data["subjects"]["subject_details"][$counter][$i]->elective;
				   if($group_id != 0 && !isset($data["subjects"]["elective_count"][$group_id]))
					 $data["subjects"]["elective_count"][$group_id] = 0;
				   
				   $data["subjects"]["sequence_no"][$counter][$i] = $this->basic_model->get_course_structure_by_id($data["subjects"][
				   "subject_details"][$counter][$i]->id)->sequence;
				   
				   $data["subjects"][$group_id] = 0;
				   //var_dump($data["subjects"]["subject_details"][$counter][$i]);
				   if($group_id != 0)
				   {
						//$data['flag']['group_id'][$i] = $group_id;
						$group_detials = $this->basic_model->select_elective_group_by_group_id($group_id);
						$data["subjects"]["group_details"][$counter][$i] = $group_detials[0];
						$data["subjects"]["elective_count"][$group_id]++;
				   }
				   $i++;
				}
				$data["subjects"]["count"][$counter]=$i-1;		  			
			}
			else
			{
				//calculate subject details for semester 1 and 2 which are common to all.
				if($k == 1 || $k == 2)
				{	
					for($comm_group = 1;$comm_group <=2;$comm_group++)
					{
						$counter = $k."_".$comm_group;
						$result_ids = $this->basic_model->get_subjects_by_sem($counter,"comm_comm_".$session);	
						//var_dump($result_ids);
						//die();
		  				$i=1;
						foreach($result_ids as $row)
						{
						   $data["subjects"]["subject_details"][$counter][$i] = $this->basic_model->get_subject_details($row->id);
						   $group_id = $data["subjects"]["subject_details"][$counter][$i]->elective;
						   if($group_id != 0 && !isset($data["subjects"]["elective_count"][$group_id]))
							 $data["subjects"]["elective_count"][$group_id] = 0;
						   
						   $data["subjects"]["sequence_no"][$counter][$i] = $this->basic_model->get_course_structure_by_id($data["subjects"][
						   "subject_details"][$counter][$i]->id)->sequence;
						   
						   $data["subjects"][$group_id] = 0;
						   //var_dump($data["subjects"]["subject_details"][$counter][$i]);
						   if($group_id != 0)
						   {
								//$data['flag']['group_id'][$i] = $group_id;
								$group_detials = $this->basic_model->select_elective_group_by_group_id($group_id);
								$data["subjects"]["group_details"][$counter][$i] = $group_detials[0];
								$data["subjects"]["elective_count"][$group_id]++;
						   }
						   $i++;
						}
						$data["subjects"]["count"][$counter]=$i-1;		  			
					}		
				}
				//calculate subject details for other semester which are not common to all.
				else
				{
					$counter = $k;
					$result_ids = $this->basic_model->get_subjects_by_sem($counter,$aggr_id);	
		  			$i=1;
					foreach($result_ids as $row)
					{
					   $data["subjects"]["subject_details"][$counter][$i] = $this->basic_model->get_subject_details($row->id);
					   $group_id = $data["subjects"]["subject_details"][$counter][$i]->elective;
					   if($group_id != 0 && !isset($data["subjects"]["elective_count"][$group_id]))
						 $data["subjects"]["elective_count"][$group_id] = 0;
					   
					   $data["subjects"]["sequence_no"][$counter][$i] = $this->basic_model->get_course_structure_by_id($data["subjects"][
					   "subject_details"][$counter][$i]->id)->sequence;
					   
					   $data["subjects"][$group_id] = 0;
					   //var_dump($data["subjects"]["subject_details"][$counter][$i]);
					   if($group_id != 0)
					   {
							//$data['flag']['group_id'][$i] = $group_id;
							$group_detials = $this->basic_model->select_elective_group_by_group_id($group_id);
							$data["subjects"]["group_details"][$counter][$i] = $group_detials[0];
							$data["subjects"]["elective_count"][$group_id]++;
					   }
					   $i++;
					}
					$data["subjects"]["count"][$counter]=$i-1;
				}	
			}
		}	
		$this->session->set_userdata($data);
		
		$this->drawHeader("Course structure");  
		$this->load->view('course_structure/Edit/edit',$data);
		$this->drawFooter();

	}
	
	public function Json_UpdateCourseStructure()
	{
		$this->load->model('course_structure/edit_model','',TRUE);
		$data = file_get_contents('php://input');
		$data = json_decode($data, true);
		//print_r($data);
		//$subjectid = $data['id'];
		$id = $data['id'];
		$subjectid = $data['subject_id'];
		$name = $data['name'];
		$lecture = $data['L'];
		$tutorial = $data['T'];
		$practical = $data['P'];
		$credit_hours = $data['L'];
		$contact_hours = $data['L'];
		
		$values = array("subject_id"=>$subjectid,"name"=>$name,"lecture"=>$lecture,"tutorial"=>$tutorial,"practical"=>$practical,"credit_hours"=>
		$credit_hours,"contact_hours"=>$contact_hours);
		$where = array("id"=>$id);
		
		//echo $subjectid;
		echo $this->edit_model->update_subjects($values,$where);
		//$this->output->set_output(json_encode(array("id"=>$data)));			
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