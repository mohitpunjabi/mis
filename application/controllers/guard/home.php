<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('guard_sup'));
		$this->addJS('employee/print_script.js');
	}
	
	function index()
	{
		$this->load->model('guard/guard_model','',TRUE);
		
		$data['postnames'] = $this->guard_model->get_postnames();
		$data['guardnames'] = $this->guard_model->get_guardnames();
		
		if($this->input->post('postsubmit') != False)
		{
			$data['mode'] = 'postname';
			$data['postname'] = $this->input->post('postname');
			$data['details_of_guards_at_a_post'] = $this->guard_model->get_details_of_guard_at_a_post($data['postname']);
			$this->drawHeader('Guard Management Home');
			$this->load->view('guard/home',$data);
			$this->load->view('guard/homeview',$data);
			$this->load->view('guard/view_footer');
			$this->drawFooter();
			
		}
		else if($this->input->post('datesubmit') != False)
		{
			$data['mode'] = 'date';	
			$data['selectdate'] = $this->input->post('selectdate');
			$data['details_of_guards_at_a_date'] = $this->guard_model->get_details_of_guard_at_a_date($data['selectdate']);
			$this->drawHeader('Guard Management Home');
			$this->load->view('guard/home',$data);
			$this->load->view('guard/homeview',$data);
			$this->load->view('guard/view_footer');
			$this->drawFooter();
		}
		else if($this->input->post('rangesubmit') != False)
		{
			$data['mode'] = 'rangeofdates';
			$data['fromdate'] = $this->input->post('fromdate');
			$data['todate'] = $this->input->post('todate');
			$data['details_of_guards_in_a_range'] = $this->guard_model->get_details_of_guards_in_a_range($data['fromdate'], $data['todate']);
			$this->drawHeader('Guard Management Home');
			$this->load->view('guard/home',$data);
			$this->load->view('guard/homeview',$data);
			$this->load->view('guard/view_footer');
			$this->drawFooter();
		}
		else if($this->input->post('rangeguardsubmit') != False)
		{
			$data['mode'] = 'rangeofdates_guard';
			$data['guardname'] = $this->input->post('guardname');
			$data['fromdateg'] = $this->input->post('fromdateg');
			$data['todateg'] = $this->input->post('todateg');
			$data['details_of_guard_in_a_range'] = $this->guard_model->get_details_of_guard_in_a_range($data['fromdateg'], $data['todateg'], $data['guardname']);
			$data['details_of_a_guard'] = $this->guard_model->get_details_of_a_guard($data['guardname']);
			$this->drawHeader('Guard Management Home');
			$this->load->view('guard/home',$data);
			$this->load->view('guard/homeview',$data);
			$this->load->view('guard/view_footer');
			$this->drawFooter();
		}
		else if($this->input->post('rangepostsubmit') != False)
		{
			$data['mode'] = 'rangeofdates_postname';
			$data['postnamer'] = $this->input->post('postnamer');
			$data['fromdatep'] = $this->input->post('fromdatep');
			$data['todatep'] = $this->input->post('todatep');
			$data['details_of_guards_at_a_post_in_a_range'] = $this->guard_model->get_details_of_guard_at_a_post_in_a_range($data['fromdatep'], $data['todatep'], $data['postnamer']);
			$this->drawHeader('Guard Management Home');
			$this->load->view('guard/home',$data);
			$this->load->view('guard/homeview',$data);
			$this->load->view('guard/view_footer');
			$this->drawFooter();
		}
		else
		{
			$this->drawHeader('Guard Management Home');
			$this->load->view('guard/home',$data);
			$this->drawFooter();
		}
	}
}	
