<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_minute extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index($error='')
	{
		$data['error']=$error;
		
		$this->load->model('information/view_minute_model','',TRUE);
		
		//title for the page
		//$header['title']='View Minutes';
		//$this->load->view('templates/header',$header);
		
		if ($this->input->post('go') == FALSE && $this->input->post('get_details') == TRUE)
		{
			//$header['title']='View Minute';
			$this->drawHeader("View Minute");
			$data['id'] = $this->view_minute_model->get_minute_ids();
			
			$data['selected']  = $this->input->post('minute_id');
			
			$this->load->view('information/view_minuteV',$data);
			
			$data['minute_row'] = $this->view_minute_model->get_minute_row($data['selected']);
			//var_dump($data);
			$data['prev_ver'] = $this->view_minute_model->get_prev_versions($data['selected']);
			$data['selected_ver'] = $this->input->post('pre_ver');
			
			$this->load->view('information/view_minuteR',$data);
			$this->load->view('information/click_for_prev_version_minute',$data);
			
			$data['minute_row'] = $this->view_minute_model->get_minute_row2($data['selected'],$data['selected_ver']);
			$this->load->view('information/view_minuteR',$data);
		}
		else if ($this->input->post('go') == FALSE)
		{
			//$header['title']='View minute';
			$this->drawHeader("View Minute");
			$data['id'] = $this->view_minute_model->get_minute_ids();
			
			if($data['id'] == NULL)
			{
				$this->session->set_flashdata('flashError','There is no any minute.');
				redirect('information/view');
			
			}
			$this->load->view('information/view_minuteV',$data);
		}
		else 
		{
			//$header['title'] = 'View minute';
			$this->drawHeader("View Minute");
			
			$data['id'] = $this->view_minute_model->get_minute_ids();
			$data['selected']  = $this->input->post('minute_id');
			
			$this->load->view('information/view_minuteV',$data);
			
			$data['minute_row'] = $this->view_minute_model->get_minute_row($data['selected']);
			//var_dump($data);
			$data['prev_ver'] = $this->view_minute_model->get_prev_versions($data['selected']);
			$this->load->view('information/view_minuteR',$data);
			$this->load->view('information/click_for_prev_version_minute',$data);
		}
		$this->drawFooter();
	}
	
}
/* End of file view_minute.php */
/* Location: mis/application/controllers/information/view_minute.php */
