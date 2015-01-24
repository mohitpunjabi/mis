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
			$data['secondLink'] = '<a href="'.base_url().'index.php/information/view_circular/index/archieved">List of Archived Circular</a>';
			$this->load->model('information/view_circular_model','',TRUE);
			$data['circulars'] = $this->view_circular_model->get_circulars();
			
			if(count($data['circulars']) == 0)
			{
				$this->session->set_flashdata('flashError','There is no current circular to view.');
				redirect('information/view_circular/index/archieved');
			}
				
			$this->drawHeader('View Circular');
			$this->load->view('information/viewCircular',$data);
			$this->drawFooter();
		}
		else if ($link =='archieved')
		{
			$data['firstLink']  = 'List of Archived Circular';
			$data['secondLink'] = '<a href="'.base_url().'index.php/information/view_circular/index/current">List of Current Circular</a>';
			$this->load->model('information/viewcircular_model','',TRUE);
			$data['circulars'] = $this->viewcircular_model->get_circulars();
			
			$this->load->model('information/view_circular_model','',TRUE);
			$data['circulars1'] = $this->view_circular_model->get_circulars();
			
			if(count($data['circulars']) == 0 && count($data['circulars1']) == 0)
			{
				$this->session->set_flashdata('flashError','There is no any circular to view.');
				redirect('home');
			}
			
			if(count($data['circulars']) == 0)
			{
				$this->session->set_flashdata('flashError','There is no archived circular to view.');
				redirect('information/view_circular');
			}
				
			$this->drawHeader('View Circular');
			$this->load->view('information/viewCircular',$data);
			$this->drawFooter();
		}
		
	}
	
	
	public function prev($circular_id='')
	{
		if($circular_id=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}		
		
		$this->load->model('information/viewprevcircular_model','',TRUE);
		$data['circulars'] = $this->viewprevcircular_model->get_circulars($circular_id);

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