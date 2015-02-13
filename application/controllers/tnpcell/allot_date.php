<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Allot_date extends MY_Controller {

	function __construct()
	{
		parent::__construct(array('tpo'));
		$this->load->model('course_structure/basic_model','',true);
		$this->load->model('tnpcell/tnp_basic_model','',true);
	}
	public function index()
	{
		echo date("d-M-y",strtotime(date("Y-m-d"))+19800);
		$this->addJS("tnpcell/allot_date.js");
		$data = array();
		$data['company_basic_info'] = $this->tnp_basic_model->get_company_basic_details("");
		$this->drawHeader("Manage Training and Placement Calender");
		$this->load->view('tnpcell/allot_date',$data);
		$this->drawFooter();
	}
	
	public function AllotDatesToCompany()
	{
		$date_from = $this->input->post("date_from");	
		$date_to = $this->input->post("date_to");	
		$company_id = $this->input->post("ddl_company");
			
		$tnp_calender['date_from'] = $date_from;
		$tnp_calender['date_to'] = $date_to;
		$tnp_calender['company_id'] = $company_id;
		$tnp_calender['status'] = "Proposed";
		if($this->tnp_basic_model->insert_tnp_calender($tnp_calender))
		{
			$this->session->set_flashdata("flashSuccess","Date Proposed Successfully.");
		}
		else
		{
			$this->session->set_flashdata("flashError","Error in Database operation.");
		}
		
		redirect("tnpcell/allot_date");
	}
	
	function json_get_company_inrange($from,$to)
	{
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($this->tnp_basic_model->get_company_in_date_range($from,$to)));	
	}
 
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>