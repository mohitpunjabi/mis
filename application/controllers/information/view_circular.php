<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_circular extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index($link='')
	{
		if($link=='' || $link== 'current')
		{
			$data['firstLink']  = 'List of Current Circular';
			$data['secondLink'] = '<a href="'.base_url().'index.php/information/view_circular/index/archieved">List of Archieved Circular</a>';
			$this->load->model('information/view_circular_model','',TRUE);
			$data['circulars'] = $this->view_circular_model->get_circulars();
			
			if(count($data['circulars']) == 0)
			{
				$this->session->set_flashdata('flashError','There is no any circular to view.');
				redirect('home');
			}
				
			$this->drawHeader('View Circular');
			$this->load->view('information/viewCircular',$data);
			$this->drawFooter();
		}
		else if ($link =='archieved')
		{
			$data['firstLink']  = 'List of Archieved Circular';
			$data['secondLink'] = '<a href="'.base_url().'index.php/information/view_circular/index/current">List of Current Circular</a>';
			$this->load->model('information/viewCircular_model','',TRUE);
			$data['circulars'] = $this->viewCircular_model->get_circulars();
			
			if(count($data['circulars']) == 0)
			{
				$this->session->set_flashdata('flashError','There is no any circular to view.');
				redirect('home');
			}
				
			$this->drawHeader('View Circular');
			$this->load->view('information/viewCircular',$data);
			$this->drawFooter();
		}
		
		/*
		$this->load->model('information/view_circular_model','',TRUE);
		
		//title for the page
		//$header['title']='Search Removed circular';
		//$this->load->view('templates/header',$header);
		
		if ($this->input->post('go') == FALSE && $this->input->post('get_details') == TRUE)
		{
			//$header['title']='View Circular';
			$this->drawHeader("View Circular");
			$data['id'] = $this->view_circular_model->get_circular_ids();
			
			$data['selected']  = $this->input->post('circular_id');
			
			$this->load->view('information/view_circularV',$data);
			
			$data['circular_row'] = $this->view_circular_model->get_circular_row($data['selected']);
			//var_dump($data);
			$data['prev_ver'] = $this->view_circular_model->get_prev_versions($data['selected']);
			$data['selected_ver'] = $this->input->post('pre_ver');
			
			$this->load->view('information/view_circularR',$data);
			$this->load->view('information/click_for_prev_version_circular',$data);
			
			$data['circular_row'] = $this->view_circular_model->get_circular_row2($data['selected'],$data['selected_ver']);
			$this->load->view('information/view_circularR',$data);
		}
		else if ($this->input->post('go') == FALSE)
		{
			//$header['title']='View circular';
			$this->drawHeader("View Circular");
			$data['id'] = $this->view_circular_model->get_circular_ids();
			
			if($data['id'] == NULL)
			{
				$this->session->set_flashdata('flashError','There is no any circular.');
				redirect('information/view');
			
			}
			$this->load->view('information/view_circularV',$data);
		}
		else 
		{
			//$header['title'] = 'View Circular';
			$this->drawHeader("View Circular");
			
			$data['id'] = $this->view_circular_model->get_circular_ids();
			$data['selected']  = $this->input->post('circular_id');
			
			$this->load->view('information/view_circularV',$data);
			
			$data['circular_row'] = $this->view_circular_model->get_circular_row($data['selected']);
			//var_dump($data);
			$data['prev_ver'] = $this->view_circular_model->get_prev_versions($data['selected']);
			$this->load->view('information/view_circularR',$data);
			$this->load->view('information/click_for_prev_version_circular',$data);
		}
		$this->drawFooter();
		*/
	}
	
	
	public function prev($circular_id='')
	{
		if($circular_id=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}		
		
		$this->load->model('information/viewPrevCircular_model','',TRUE);
		$data['circulars'] = $this->viewPrevCircular_model->get_circulars($circular_id);

		if(count($data['circulars']) == 0)
		{
			$this->session->set_flashdata('flashError','There is no any circular to view.');
			redirect('home');
		}
	
		$data['prevcircular'] = $circular_id;
		$this->drawHeader('View circular');
		$this->load->view('information/viewCircular',$data);
		$this->drawFooter();
	}
	
}
/* End of file view_circular.php */
/* Location: mis/application/controllers/information/view_circular.php */