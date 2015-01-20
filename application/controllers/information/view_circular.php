<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_circular extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index($error='')
	{
		$data['error']=$error;
		
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
	}
	
}
/* End of file view_circular.php */
/* Location: mis/application/controllers/information/view_circular.php */