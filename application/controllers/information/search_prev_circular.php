<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_prev_circular extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod','est_ar','exam_dr','dt','dsw'));
	}

	public function index($error='')
	{
		$data['error']=$error;
		
		$this->load->model('information/search_prev_circular_model','',TRUE);
		
		//title for the page
		//$header['title']='Search Previous circular';
		//$this->load->view('templates/header',$header);
		
		if ($this->input->post('go1') == FALSE && $this->input->post('go2') == FALSE)
		{
			//$header['title']='Search Previous Versions of circular';
			$this->drawHeader("Search Previous Versions of Circular");
			$data['id'] = $this->search_prev_circular_model->get_circular_ids();
			
			if($data['id'] == NULL)
			{
				$this->session->set_flashdata('flashError','There is no any circular.');
				redirect('information/search_prev');
			
			}
			$this->load->view('information/search_prev_circular1',$data);
		}
		else if($this->input->post('go1') == TRUE && $this->input->post('go2') == FALSE)
		{
			//$header['title']='Search Previous Versions of circular';
			$this->drawHeader("Search Previous Versions of Circular");
			$data['id'] = $this->search_prev_circular_model->get_circular_ids();
			$data['selected_id']  = $this->input->post('circular_id');
			
			$this->load->view('information/search_prev_circular1',$data);
			
			$data['prev_versions'] = $this->search_prev_circular_model->get_prev_versions($data['selected_id']);
			if($data['prev_versions'] == NULL)
			{
				$this->session->set_flashdata('flashError','There is no any previous version for the selected circular.');
				redirect('information/search_prev');
			
			}
			$this->load->view('information/search_prev_circular2',$data);
		}
		else if($this->input->post('go2') == TRUE)
		{
			//$header['title'] = 'View circular';
			$this->drawHeader("View Circular");
			
			$data['id'] = $this->search_prev_circular_model->get_circular_ids();
			$data['selected_id']  = $this->input->post('circular_id');
			
			$this->load->view('information/search_prev_circular1',$data);
			
			$data['prev_versions'] = $this->search_prev_circular_model->get_prev_versions($data['selected_id']);
			$data['selected_ver']  = $this->input->post('pre_ver');
			
			$this->load->view('information/search_prev_circular2',$data);
			
			$data['circular_row'] = $this->search_prev_circular_model->get_circular_row($data['selected_id'],$data['selected_ver']);
			//var_dump($data);
			$this->load->view('information/view_circularR',$data);
		}
		$this->drawFooter();
	}
	
}
/* End of file search_prev_circular.php */
/* Location: mis/application/controllers/information/search_prev_circular.php */
