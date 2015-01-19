<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo', 'hod'));
		
		$this->addJS("course_structure/add.js");
		$this->addJS("course_structure/edit.js");
		$this->addCSS("course_structure/cs_layout.css");
		$this->load->model('course_structure/basic_model', 'basic_model', TRUE);
		$this->load->model('course_structure/basic_model','',TRUE);
	}

	public function index($error='')
	{
		$data = array();
		$data["result_course"] = $this->basic_model->get_course();
		$data["result_branch"] = $this->basic_model->get_branches();

		$this->drawHeader();
		$this->load->view('course_structure/add',$data);
		$this->drawFooter();
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
		
		if(!$this->basic_model->select_course_branch(trim($aggr_id)))
			$this->basic_model->insert_course_branch($course_branch_mapping);
		
		$this->drawHeader();
		$this->load->view('course_structure/count',$data);
		$this->drawFooter();
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
		if($data['CS_session']['count_core'] + $data['CS_session']['count_elective'] == 0)
			redirect("course_structure/add/EnterNumberOfSubjects");
		else
		{
			$this->drawHeader();
			$this->load->view('course_structure/courses',$data);
			$this->drawFooter();
		}
  	}
 	 
 	 public function AddCoreSubjects()
  	{
		$this->load->model('course_structure/add_model','',TRUE);
		$session_values = $this->session->userdata("CS_session");
		$data['CS_session'] = $session_values;
		
		$sem = $session_values["sem"];
		$aggr_id = trim($session_values["aggr_id"]);
		
		$count_elective = $session_values["count_elective"];
		$count_core = $session_values["count_core"];
		$data['count_core'] = $count_core;
		$i=1;
		
		//for loop for inserting core subjects...
		for($i = 1;$i <= $count_core;$i++)
		{
			$subject_details['id'] = uniqid();
			$subject_details['subject_id'] = $this->input->post("id".$i);
			$subject_details['name'] = $this->input->post("name".$i);
			$subject_details['lecture'] = $this->input->post("L".$i);
			$subject_details['tutorial'] = $this->input->post("T".$i);
			$subject_details['practical'] = $this->input->post("P".$i);
			
			$credit_hours= $this->input->post('credit_hours'.$i);//$subject_details['lecture']*2 + $subject_details['tutorial'] + $subject_details['practical'];
		  	$contact_hours= $subject_details['lecture'] + $subject_details['tutorial'] + $subject_details['practical'];

			$subject_details['credit_hours'] = $credit_hours;
			$subject_details['contact_hours'] = $contact_hours;
			$subject_details['elective'] = "0";
			$subject_details['type'] = $this->input->post("type".$i);			
			
			$coursestructure_details['id'] = $subject_details['id'];
			$coursestructure_details['semester'] = $sem;
			$coursestructure_details['sequence'] = $this->input->post("sequence".$i);
			$coursestructure_details['aggr_id'] = $aggr_id;
			
			//first insert into course structure table and then to subjects table to maintain foreign key contraints.
			$data['error'] = $this->add_model->insert_coursestructure($coursestructure_details);
			$data['error'] = $this->add_model->insert_subjects($subject_details);
		}
		
		$list_type= $this->input->post("list_type");
		$data['CS_session']['list_type'] = $list_type;
		
		//if same list is selected
		if($list_type == 1)
		{
			$data["options"][1] = $this->input->post("options1");	
			$data["CS_session"]["options"][1] = $data["options"][1];
			for($i = 1;$i<=$count_elective;$i++)
			{
				$data["seq_e"][$i] = $this->input->post("seq_e".$i);	
				$data["CS_session"]["seq_elective"][$i] = $data["seq_e"][$i];	
			}
		}
		else
		{
			for($i = 1;$i<=$count_elective;$i++)
			{
				$data["options"][$i] = $this->input->post("options".$i);	
				$data["seq_e"][$i] = $this->input->post("seq_e".$i);
				
				$data["CS_session"]["options"][$i] = $data["options"][$i];
				$data["CS_session"]["seq_elective"][$i] = $data["seq_e"][$i];	
			}
		}
    if($count_elective>=1)
    {
		$this->session->set_userdata($data);
		$this->drawHeader();
		$this->load->view('course_structure/add_elective',$data);
		$this->drawFooter();
    }
    else
    {
      $this->session->set_userdata($data);
      $this->session->set_flashdata("flashSuccess","Course structure for ".$data['CS_session']['course_name']." in ".$data['CS_session']['branch']." for semester ".$sem." inserted successfully");
      redirect("course_structure/add");
    }
  }
  
  public function AddElectiveSubjects()
  {

	  //this function inserts elective subject in database.
	$this->load->model('course_structure/add_model','',TRUE);  
    $session_data = $this->session->userdata("CS_session");
	$sem = $session_data['sem'];
    $aggr_id = $session_data["aggr_id"];
    $count_elective = $session_data["count_elective"];
	
	if($session_data['list_type'] == 1)
	{
		$count_elective = 1;
	}
		
    for($counter = 1;$counter<=$count_elective;$counter++)
    {
		$elective_details['elective_name'] = $this->input->post("name".$counter);
		$elective_details['lecture'] = $this->input->post("L".$counter);
		$elective_details['tutorial'] = $this->input->post("T".$counter);
		$elective_details['practical'] = $this->input->post("P".$counter);
		$elective_details['type'] = $this->input->post("type".$counter);
		
		//$credit_hours= $elective_details['lecture']*2 + $elective_details['tutorial'] + $elective_details['practical'];
		$credit_hours= $this->input->post("credit_hours".$counter);
		$contact_hours= $elective_details['lecture'] + $elective_details['tutorial'] + $elective_details['practical'];
	 
		$options = $session_data['options'][$counter];
		$sequence_elective = $session_data['elective'][$counter];
		if($session_data['list_type'] == 1)
			$group_id = $session_data["count_elective"].'_'.uniqid();
		else
			$group_id = '1_'.uniqid();
			
		for($i = 1;$i <= $options;$i++)
		{
			$subject_details['id'] = uniqid();			
			$subject_details['subject_id'] = $this->input->post("id".$counter."_".$i);
			$subject_details['name'] = $this->input->post("name".$counter."_".$i);
			$subject_details['lecture'] = $elective_details['lecture'];
			$subject_details['tutorial'] = $elective_details['tutorial'];
			$subject_details['practical'] = $elective_details['practical'];
			$subject_details['credit_hours'] = $credit_hours;
			$subject_details['contact_hours'] = $contact_hours;
			//add group id to elective feild in database.
			$subject_details['elective'] = $group_id;
			$subject_details['type'] = $elective_details['type'];
			
			$coursestructure_details['id'] = $subject_details['id'];
			$coursestructure_details['semester'] = $sem;
			$sequence = $this->input->post("sequence".$counter."_".$i);
			
			$sequence = $session_data['seq_elective'][$counter].".".$sequence;
			//$sequence = ;
			$coursestructure_details['sequence'] = $sequence; 
			$coursestructure_details['aggr_id'] = $aggr_id;			
			
			//first insert into course structure table and then to subjects table to maintain foreign key contraints.
			
			$this->db->trans_start();
			$data['error'] = $this->add_model->insert_coursestructure($coursestructure_details);
			$data['error'] = $this->add_model->insert_subjects($subject_details);
			$this->db->trans_complete();
		} 
		
		//insert into elective_group table.
		$elective_group['elective_name'] = $elective_details['elective_name'];
		$elective_group['group_id'] = $subject_details['elective'];
		$elective_group['aggr_id'] = $aggr_id;
		$data['error'] = $this->add_model->insert_elective_group($elective_group);	
		
    }
	
//	$this->session->set_flashdata("flashSuccess","Course structure for ".$session_data['course_name']." in ".$session_data['branch']." for semester ".$sem." inserted successfully");

	$this->session->set_flashdata("flashSuccess","Course structure added");
    redirect("course_structure/add");
	//$this->load->view('print_cs',$data);
  }
	public function json_get_branch()
	{
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($this->basic_model->get_branches()));
	}
}
?>