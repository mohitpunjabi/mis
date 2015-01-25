<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Queries extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('est_ar'));
	}

	public function queryByCategory()
	{
		$this->addJS('employee/queries_script.js');
		$data['query_by']="Category";
		$options = array("none" => "Select Category",
      					"General" => "GEN",
            			"OBC"=>"OBC",
            			"SC"=>"SC",
            			"ST"=>"ST",
            			"Others"=>"Others");
		$data['select']=form_dropdown('display_employee',$options,"none",'id="query" onChange="ajax(\'Category\');"');
		$this->drawHeader('Query By Category');
		$this->load->view('employee/queries/query',$data);
		$this->drawFooter();
	}

	public function queryByDepartment()
	{
		$this->addJS('employee/queries_script.js');
		$data['query_by']="Department";
		$this->load->model('departments_model','',TRUE);
		$depts=$this->departments_model->get_departments();
		$options = array("none" => "Select Department");
		foreach($depts as $dept)
			$options = array_merge($options,array($dept->id => $dept->name));
		$data['select']=form_dropdown('display_employee',$options,"none",'id="query" onChange="ajax(\'Department\');"');
		$this->drawHeader('Query By Department');
		$this->load->view('employee/queries/query',$data);
		$this->drawFooter();
	}

	public function queryByDesignation()
	{
		$this->addJS('employee/queries_script.js');
		$data['query_by']="Designation";
		$this->load->model('designations_model','',TRUE);
		$designations=$this->designations_model->get_designations();
		$options = array("none" => "Select Designation");
		foreach($designations as $des)
			$options = array_merge($options,array($des->id => $des->name));
		$data['select']=form_dropdown('display_employee',$options,"none",'id="query" onChange="ajax(\'Designation\');"');
		$this->drawHeader('Query By Designation');
		$this->load->view('employee/queries/query',$data);
		$this->drawFooter();
	}
}

/* End of file queries.php */
/* Location: mis/application/controllers/employee/queries.php */