<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct();

		$this->addJS("course_structure/add.js");
		$this->addJS("course_structure/edit.js");
		$this->addCSS("course_structure/cs_layout.css");
		
		$this->load->model('elective_offered/basic_model','',TRUE);
		//$this->load->model('course_structure/basic_model','',TRUE);
		$this->load->library('session');

	}

	public function index($error='')
	{
		$data = array();
		$userid = $this->session->userdata("id");
		$data['userid'] = $userid;
		
		
		$dept = $this->basic_model->Select_Department_By_User_ID($userid);
		$dept_id = $dept[0]->dept_id;
		$result_courses = $this->basic_model->Select_courses_by_dept($dept_id);
		
		if(date('m') >= 7 && date('m') <=12)
			$curr_session = substr(date('Y'),2,3).(substr(date('Y'),2,3)+1);
		else
			$curr_session = (substr(date('Y'),2,3)-1).(substr(date('Y'),2,3));
			
		$data['curr_session'] = $curr_session;
		
		$i = 0;
		$j=0;
		foreach($result_courses as $row)
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
					$data['course']['duration'] = $result_course_details[0]->duration;
					$j++;
				}
				if(!in_array($aggr_id_array[1],$data['branch']['id']))
				{
					$data['branch']['id'][$i] = $aggr_id_array[1];
					$result_branch_details = $this->basic_model->get_branch_details_by_id($data['branch']['id'][$i]);
					$data['branch']['name'][$i] = $result_branch_details[0]->name;
					$i++;
				}
			}
		}
		
		for($i =0;$i< 4;$i++)
		{
			$data['batch'][$i] = "20".(substr($curr_session,2,3)+$i);	
			
		}
		for($i = 0;$i<8;$i++)
			$data['semester'][$i] = $i+1;
		
		$this->drawHeader();
		$this->load->view('elective_offered/home',$data);
		$this->drawFooter();
	}	
}
?>