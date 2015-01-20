<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elective_offered_home extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('hod'));
		
		$this->addJS("course_structure/edit_view_cs.js");
		$this->addCSS("course_structure/cs_layout.css");
		
		//$this->load->model('elective_offered/basic_model','',TRUE);
		$this->load->model('course_structure/basic_model','',TRUE);
	}

	public function index($error='')
	{
		$this->addJS("course_structure/elective_offered.js");
		$data = array();
		$userid = $this->session->userdata("id");
		$data['userid'] = $userid;
		
		$dept = $this->basic_model->Select_Department_By_User_ID($userid);
		$dept_id = $dept[0]->dept_id;
		$data['dept_id'] = $dept_id;
		$data['result_course'] = $this->basic_model->get_course_offered_by_dept($dept_id);
		$result_course = $data['result_course'];
		
		if(date('m') >= 7 && date('m') <=12)
			$curr_session = substr(date('Y'),2,3).(substr(date('Y'),2,3)+1);
		else
			$curr_session = (substr(date('Y'),2,3)-1).(substr(date('Y'),2,3));
			
		$data['curr_session'] = $curr_session;
		
		$i = 0;
		$j=0;
		$k = 0;
		//$data['aggr_id'] = array();
		$data['course'] = array();
		$data['course']['name'] = array();
		$data['course']['duration'] = array();
		$data['course']['id'] = array();
		
		foreach($result_course as $row)
		{
			$aggr_id_array = explode('_',$row->aggr_id);
			$session = $aggr_id_array[2];
			
			if($curr_session == $session)
			{
				$data['curr_session'] = $curr_session;
				if(!in_array($aggr_id_array[0],$data['course']['id']))
				{
					$data['course']['id'][$j] = $aggr_id_array[0];
					$result_course_details = $this->basic_model->get_course_details_by_id($data['course']['id'][$j]);
					
					$data['course']['name'][$j] = $result_course_details[0]->name;
					$data['course']['duration'][$j] = $result_course_details[0]->duration;
					$j++;
				}
			}
		}
		
		$this->drawHeader();
		$this->load->view('course_structure/elective_offered_home',$data);
		$this->drawFooter();
	}	

	public function json_get_branch($course =''){
		//The brlow gets the course that the user selected
		if($course!=''){
			//$course = $this->input->post("course");//json_decode(html_entity_decode($this->input->post("course")));
			$data = array();
			$userid = $this->session->userdata("id");		
			
			$dept = $this->basic_model->Select_Department_By_User_ID($userid);
			$dept_id = $dept[0]->dept_id;
			$this->output->set_content_type('application/json');
			if(date('m') >= 7 && date('m') <=12)
				$curr_session = substr(date('Y'),2,3).(substr(date('Y'),2,3)+1);
			else
				$curr_session = (substr(date('Y'),2,3)-1).(substr(date('Y'),2,3));
			//Get the branches
			$branches = $this->basic_model->get_branch_by_dept_course_session($dept_id,$course,$curr_session); 				
			//$this->output->set_output(json_encode($branches));

			$data['branches']=array();
			foreach($branches as $branch){
				$branch_id = substr($branch->aggr_id,strlen($course)+1,strlen($branch->aggr_id)-6-strlen($course));
				$result_branch_details = $this->basic_model->get_branch_details_by_id($branch_id);
				//$this->output->set_output(json_encode($result_branch_details));
				$data['branches'][$branch_id] = $result_branch_details[0]->name;
			}

			
			$this->output->set_output(json_encode($data));
		}
	}
}
?>