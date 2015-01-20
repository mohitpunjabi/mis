<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_circular extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod','est_ar','exam_dr','dt','dsw'));
	}

	public function index($error='')
	{
		$data['error']=$error;
		
		$this->load->model('information/search_circular_model','',TRUE);
		
		//title for the page
		//$header['title']='Search Removed Minutes';
		//$this->load->view('templates/header',$header);
		
		if ($this->input->post('go') == FALSE)
		{
			//$header['title']='Search Removed Circular';
			$this->drawHeader("Search Removed Circular");
			$data['id'] = $this->search_circular_model->get_circular_ids();
			//var_dump($data);
			if($data['id'] == NULL)
			{
				$this->session->set_flashdata('flashError','There is no any removed circular.');
				redirect('information/search');
			
			}
			$this->load->view('information/search_circular',$data);
		}
		else
		{
			//$header['title'] = 'View Circular';
			$this->drawHeader("View Circular");
			
			$data['id'] = $this->search_circular_model->get_circular_ids();
			$data['selected']  = $this->input->post('circular_id');
			
			$this->load->view('information/search_circular',$data);
			
			$data['circular_row'] = $this->search_circular_model->get_circular_row($data['selected']);
			//var_dump($data);
			$this->load->view('information/view_circularR',$data);
		}
		$this->drawFooter();
	}
	
}
/* End of file search_circular.php */
/* Location: mis/application/controllers/information/search_circular.php */
