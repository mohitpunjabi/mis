<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_prev_notice extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod','est_ar','exam_dr','dt','dsw'));
	}

	public function index($error='')
	{
		$data['error']=$error;
		
		$this->load->model('information/search_prev_notice_model','',TRUE);
		
		//title for the page
		//$header['title']='Search Previous Notice';
		//$this->load->view('templates/header',$header);
		
		if ($this->input->post('go1') == FALSE && $this->input->post('go2') == FALSE)
		{
			//$header['title']='Search Previous Versions of Notice';
			$this->drawHeader("Search Previous Versions of Notice");
			$data['id'] = $this->search_prev_notice_model->get_notice_ids();
			
			if($data['id'] == NULL)
			{
				$this->session->set_flashdata('flashError','There is no any notice.');
				redirect('information/search_prev');
			
			}
			$this->load->view('information/search_prev_notice1',$data);
		}
		else if($this->input->post('go1') == TRUE && $this->input->post('go2') == FALSE)
		{
			//$header['title']='Search Previous Versions of Notice';
			$this->drawHeader("Search Previous Versions of Notice");
			$data['id'] = $this->search_prev_notice_model->get_notice_ids();
			$data['selected_id']  = $this->input->post('notice_id');
			
			$this->load->view('information/search_prev_notice1',$data);
			
			$data['prev_versions'] = $this->search_prev_notice_model->get_prev_versions($data['selected_id']);
			if($data['prev_versions'] == NULL)
			{
				$this->session->set_flashdata('flashError','There is no any previous version for the selected notice.');
				redirect('information/search_prev');
			
			}
			$this->load->view('information/search_prev_notice2',$data);
		}
		else if($this->input->post('go2') == TRUE)
		{
			//$header['title'] = 'View Notice';
			$this->drawHeader("View Notice");
			
			$data['id'] = $this->search_prev_notice_model->get_notice_ids();
			$data['selected_id']  = $this->input->post('notice_id');
			
			$this->load->view('information/search_prev_notice1',$data);
			
			$data['prev_versions'] = $this->search_prev_notice_model->get_prev_versions($data['selected_id']);
			$data['selected_ver']  = $this->input->post('pre_ver');
			
			$this->load->view('information/search_prev_notice2',$data);
			
			$data['notice_row'] = $this->search_prev_notice_model->get_notice_row($data['selected_id'],$data['selected_ver']);
			//var_dump($data);
			$this->load->view('information/view_noticeR',$data);
		}
		$this->drawFooter();
	}
	
}
/* End of file search_prev_notice.php */
/* Location: mis/application/controllers/information/search_prev_notice.php */
