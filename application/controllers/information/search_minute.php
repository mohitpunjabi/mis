<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_minute extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod','est_ar','exam_dr','dt','dsw'));
	}

	public function index($error='')
	{
		$data['error']=$error;
		
		$this->load->model('information/search_minute_model','',TRUE);
		
		//title for the page
		//$header['title']='Search Removed Minutes';
		//$this->load->view('templates/header',$header);
		
		if ($this->input->post('go') == FALSE)
		{
			//$header['title']='Search Removed Minutes';
			$this->drawHeader("Search Removed Minutes");
			$data['id'] = $this->search_minute_model->get_minute_ids();
			//var_dump($data);
			
			if($data['id'] == NULL)
			{
				$this->session->set_flashdata('flashError','There is no any removed minutes.');
				redirect('information/search');
			
			}
			$this->load->view('information/search_minute',$data);
		}
		else
		{
			//$header['title'] = 'View Minutes';
			$this->drawHeader("View Minutes");
			
			$data['id'] = $this->search_minute_model->get_minute_ids();
			$data['selected']  = $this->input->post('minute_id');
			
			$this->load->view('information/search_minute',$data);
			
			$data['minute_row'] = $this->search_minute_model->get_minute_row($data['selected']);
			//var_dump($data);
			$this->load->view('information/view_minuteR',$data);
		}
		$this->drawFooter();
	}
	
}
/* End of file search_minute.php */
/* Location: mis/application/controllers/information/search_minute.php */
