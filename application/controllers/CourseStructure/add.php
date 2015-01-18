<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('deo'));
		$this->load->library('session');
		$this->load->model('CourseStructure/basic_model','',TRUE);
	}

	public function index($error='')
	{
		$data = array();
		$data["result_course"] = $this->basic_model->get_course();
		$data["result_branch"] = $this->basic_model->get_branches();
		$this->load->view('templates/header');
		$this->load->view('CourseStructure/add',$data);
		$this->load->view('templates/footer');
	}
	
	public function EnterNumberOfSubjects()
	{
		$course= $this->input->post('course');
		$branch= $this->input->post('branch');
		$session= $this->input->post('session');
		$sem=$this->input->post('sem');
		$aggr_id= $course.'_'.$branch.'_'.$session;
		
		$row_course = $this->basic_model->get_course_details_by_id($course);
		$row_branch = $this->basic_model->get_branch_details_by_id($branch);
		
		$data["CS_session"]['duration']=$row_course[0]->duration;
		$data["CS_session"]['sem']=$sem;
		$data["CS_session"]['aggr_id'] = trim($aggr_id);
		
		$data["CS_session"]['course_name']=$row_course[0]->name;
		$data["CS_session"]['branch']=$row_branch[0]->name;
		$data["CS_session"]['session']=$session;
		$this->session->set_userdata($data);
		
		//insert course branch mapping here.Also check if that mapping exist or not.
		$course_branch_mapping['course_id'] = $course;
		$course_branch_mapping['branch_id'] = $branch;
		$course_branch_mapping['year'] = $session;
		$course_branch_mapping['aggr_id'] = trim($aggr_id);
		
		$this->basic_model->insert_course_branch($course_branch_mapping);
		
		$this->load->view('templates/header');
		$this->load->view('CourseStructure/count',$data);
		$this->load->view('templates/footer');
	}
    public function EnterSubjects()
  	{
		$session_variable = $this->session->userdata("CS_session");
		
		$data['CS_session']["duration"] = $session_variable["duration"];
		$data['CS_session']['sem']=$session_variable["sem"];
		$data['CS_session']['aggr_id']=$session_variable["aggr_id"];
		$data['CS_session']['course_name']=$session_variable["course_name"];
		$data['CS_session']['branch']=$session_variable["branch"];
		$data['CS_session']['session']=$session_variable["session"];
		
		$data['CS_session']['count_core'] = $this->input->post("count_core");
		$data['CS_session']['count_elective'] = $this->input->post("count_elective");
		
		$this->session->set_userdata($data);
		
		$this->load->view('templates/header');
		$this->load->view('CourseStructure/courses',$data);
		$this->load->view('templates/footer');	
  	}
 	 
 	 public function AddElectiveList()
  	{
		$this->load->model('CourseStructure/add_model','',TRUE);
		$session_values = $this->session->userdata("CS_session");
		$data['CS_session'] = $session_values;
		
		$sem = $session_values["sem"];
		$aggr_id = trim($session_values["aggr_id"]);
		
		$count_elective = $session_values["count_elective"];
		$count_core = $session_values["count_core"];
		$data['count_core'] = $count_core;
		$i=1;
		for($i = 1;$i <= $count_core;$i++)
		{
			$subject_details['id'] = uniqid();
			$subject_details['subject_id'] = $this->input->post("id".$i);
			$subject_details['name'] = $this->input->post("name".$i);
			$subject_details['lecture'] = $this->input->post("L".$i);
			$subject_details['tutorial'] = $this->input->post("T".$i);
			$subject_details['practical'] = $this->input->post("P".$i);
			
			$credit_hours= $subject_details['lecture']*2 + $subject_details['tutorial'] + $subject_details['practical'];
		  	$contact_hours= $subject_details['lecture'] + $subject_details['tutorial'] + $subject_details['practical'];
		  
			$subject_details['credit_hours'] = $credit_hours;
			$subject_details['contact_hours'] = $contact_hours;
			$subject_details['elective'] = "0";
			$subject_details['type'] = $this->input->post("type".$i);
			
			$data['error'] = $this->add_model->insert_subjects($subject_details);
			
			$coursestructure_details['id'] = $subject_details['id'];
			$coursestructure_details['semester'] = $sem;
			$coursestructure_details['sequence'] = $this->input->post("sequence".$i);
			$coursestructure_details['aggr_id'] = $aggr_id;
			
			
			$data['error'] = $this->add_model->insert_coursestructure($coursestructure_details);
		}
		/*
		
		for($counter = 1;$counter<=$count_elective;$counter++)
		{
		  $L=$this->input->post('L'.$counter);
		  $T=$this->input->post('T'.$counter);
		  $P=$this->input->post('P'.$counter);
		  $type=$this->input->post('type'.$counter);
		  $credit_hours= $L*2 + $T + $P;
		  $contact_hours= $L + $T + $P;
		  $list=$this->input->post('list'.$counter);
		  if($list==0)
		  {
			$e_name= $this->input->post('name'.$counter);
			$count = filter_var($e_name, FILTER_SANITIZE_NUMBER_INT);
			$elective=$count.$counter;
		  }
		  else $elective=0;
		  
		  $count_options=$this->input->post("count_options".$counter);
		  $seq=$this->input->post("sequence".$counter);
		  for($i=1;$i<=$count_options;$i++)
		  {
			$subject_id=$this->input->post('id'.$counter.'_'.$i);
			$subject_name=$this->input->post('name'.$counter.'_'.$i);
			if($subject_name=='') continue;
			$query_subject = "INSERT INTO subjects (id,subject_id,name,lecture,tutorial,practical,credit_hours,contact_hours,elective,type) VALUES ('".$uniqid()."','$subject_id','$subject_name','$L','$T','$P','$credit_hours','$contact_hours','$elective','$type')";
			if(($this->db->query($query_subject))===TRUE)
			{
			  $seq_ele=$seq.'.'.$i;
			  $query_cs= "INSERT INTO course_structure (id,semester,sequence,aggr_id) VALUES ('$subject_id','$sem','$seq_ele','$aggr_id')";
			  if($this->db->query($query_cs) === TRUE) {continue;}
			  else {printf("%s", $mysqli->error);break;}
			}           
		  }
		  //sequence should be defined in a better way...here $counter is not the sequence, the sequence of the elective has to be carried forward till here to do that. 
		 // maybe sequence should be like c1,c2,c3 or e1,e2,e3
		}
		$duration=$this->input->post("duration");
		$data['sem']=$sem+1;
		$data['aggr_id']=$aggr_id;
		$data['duration']=$duration;
		$data['course_name']=$this->input->post("course_name");
		$data['branch']=$this->input->post("branch");
		$data['session']=$this->input->post("session");
		
		*/
		
		$data['CS_session'] = $this->session->userdata("CS_session");
		$this->load->view('templates/header');
		$this->load->view('CourseStructure/add_elective',$data);
		$this->load->view('templates/footer');	
		
  }
}
?>