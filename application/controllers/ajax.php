<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller
{
	public function index()
	{
		// Will never be used
	}

	public function grade_pay($pay_band = '')
	{
		// fetching grade pay for a particular pay band
		$this->load->model('Pay_scales_model','',TRUE);
		$data['grade_pays'] = $this->Pay_scales_model->get_grade_pay($pay_band);
		$this->load->view('ajax/grade_pay',$data);
	}

	public function designation($type = '')
	{
		// fetching designations of a particular type , if type is not given then all the designations are shown
		$this->load->model('Designations_model','',TRUE);

		if($type === '')
			$data['designations'] = $this->Designations_model->get_designations();
		else if($type === 'ft')
			$data['designations'] = $this->Designations_model->get_designations("type in ('ft','others')");
		else if($type === 'nfta' || $type === 'nftn')
			$data['designations'] = $this->Designations_model->get_designations("type in ('nft','others')");
		else
			$data['designations'] = FALSE;

		$this->load->view('ajax/designation',$data);
	}

	public function department($type = '')
	{
		// fetching departments of a particular type

		$this->load->model('Departments_model','',TRUE);

		if($type === 'ft')
			$data['departments'] = $this->Departments_model->get_departments('academic');
		else if($type === 'nftn')
			$data['departments'] = $this->Departments_model->get_departments('nonacademic');
		else if($type === '' || $type === 'nfta')
			$data['departments'] = $this->Departments_model->get_departments();
		else
			$data['departments'] = FALSE;

		$this->load->view('ajax/department',$data);
	}

}

/* End of file ajax.php */
/* Location: Codeigniter/application/controllers/ajax.php */