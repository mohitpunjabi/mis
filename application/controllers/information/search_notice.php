<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_notice extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod','est_ar','exam_dr','dt','dsw'));
	}

	public function index($error='')
	{
		$data['error']=$error;
		
		$this->load->model('information/search_notice_model','',TRUE);
		
		//title for the page
		//$header['title']='Search Removed Notice';
		//$this->load->view('templates/header',$header);
		
		if ($this->input->post('go') == FALSE)
		{
			//$header['title']='Search Removed Notice';
			$this->drawHeader("Search Removed Notice");
			$data['id'] = $this->search_notice_model->get_notice_ids();
			
			if($data['id'] == NULL)
			{
				$this->session->set_flashdata('flashError','There is no any removed notice.');
				redirect('information/search');
			
			}
			$this->load->view('information/search_notice',$data);
		}
		else
		{
			//$header['title'] = 'View Notice';
			$this->drawHeader("View Notice");
			
			$data['id'] = $this->search_notice_model->get_notice_ids();
			$data['selected']  = $this->input->post('notice_id');
			
			$this->load->view('information/search_notice',$data);
			
			$data['notice_row'] = $this->search_notice_model->get_notice_row($data['selected']);
			//var_dump($data);
			$this->load->view('information/view_noticeR',$data);
		}
		$this->drawFooter();
	}
	
}
/* End of file search_notice.php */
/* Location: mis/application/controllers/information/search_notice.php */
