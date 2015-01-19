<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_ajax extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
    }

	public function update_branch($dept = '')
	{
		//alert('horror');
		//var_dump($dept);
		$this->load->model('Branches_model','',TRUE);
		$data['branches']=$this->Branches_model->get_branches_by_department($dept);
		//echo ('hello');
		$this->load->view('student/ajax/student_update_branches',$data);
	}

	public function update_courses($branch = '')
	{
		if($branch)
		{
			$this->load->model('Courses_model','',TRUE);
			$data['courses']=$this->Courses_model->get_courses_by_branch($branch);
			$this->load->view('student/ajax/student_update_courses',$data);
		}
		else
		{
			$data['courses']='';
			$this->load->view('student/ajax/student_update_courses',$data);
		}
	}
}
?>