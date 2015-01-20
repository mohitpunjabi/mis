<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_minute extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index($link='')
	{
	
		if($link=='' || $link== 'current')
		{
			$data['firstLink']  = 'List of Current Meeting Minutes';
			$data['secondLink'] = '<a href="'.base_url().'index.php/information/view_minute/index/archieved">List of Archived Meeting Minutes</a>';
			$this->load->model('information/view_minute_model','',TRUE);
			$data['minutes'] = $this->view_minute_model->get_minutes();
			
			if(count($data['minutes']) == 0)
			{
				$this->session->set_flashdata('flashError','There is no any meeting minutes to view.');
				redirect('home');
			}
				
			$this->drawHeader('View Meeting Minutes');
			$this->load->view('information/viewMinute',$data);
			$this->drawFooter();
		}
		else if ($link =='archieved')
		{
			$data['firstLink']  = 'List of Archived Meeting Minutes';
			$data['secondLink'] = '<a href="'.base_url().'index.php/information/view_minute/index/current">List of Current Meeting Minutes</a>';
			$this->load->model('information/viewMinute_model','',TRUE);
			$data['minutes'] = $this->viewMinute_model->get_minutes();
			
			if(count($data['minutes']) == 0)
			{
				$this->session->set_flashdata('flashError','There is no any meeting minutes to view.');
				redirect('home');
			}
				
			$this->drawHeader('View Meeting Minutes');
			$this->load->view('information/viewMinute',$data);
			$this->drawFooter();
		}
	}
	
	public function prev($minute_id='')
	{
		if($minute_id=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}		
		
		$this->load->model('information/viewPrevMinute_model','',TRUE);
		$data['minutes'] = $this->viewPrevMinute_model->get_minutes($minute_id);

		if(count($data['minutes']) == 0)
		{
			$this->session->set_flashdata('flashError','There is no any meeting minutes to view.');
			redirect('home');
		}
	
		$data['prevminute'] = $minute_id;
		$this->drawHeader('View Meeting Minutes');
		$this->load->view('information/viewMinute',$data);
		$this->drawFooter();
	}
	
}
/* End of file view_minute.php */
/* Location: mis/application/controllers/information/view_minute.php */
