<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_notice extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index($link='')
	{	
		if($link=='' || $link== 'current')
		{
			$data['firstLink']  = 'List of Current Notices';
			$data['secondLink'] = '<a href="'.base_url().'index.php/information/view_notice/index/archieved">List of Archieved Notices</a>';
			$this->load->model('information/view_notice_model','',TRUE);
			$data['notices'] = $this->view_notice_model->get_notices();
			
			if(count($data['notices']) == 0)
			{
				$this->session->set_flashdata('flashError','There is no any notice to view.');
				redirect('home');
			}
				
			$this->drawHeader('View Notice');
			$this->load->view('information/viewNotice',$data);
			$this->drawFooter();
		}
		else if ($link =='archieved')
		{
			$data['firstLink']  = 'List of Archieved Notices';
			$data['secondLink'] = '<a href="'.base_url().'index.php/information/view_notice/index/current">List of Current Notices</a>';
			$this->load->model('information/viewNotice_model','',TRUE);
			$data['notices'] = $this->viewNotice_model->get_notices();
			
			if(count($data['notices']) == 0)
			{
				$this->session->set_flashdata('flashError','There is no any notice to view.');
				redirect('home');
			}
				
			$this->drawHeader('View Notice');
			$this->load->view('information/viewNotice',$data);
			$this->drawFooter();
		}

			/*
		//title for the page
		//$header['title']='Search Removed Notice';
		//$this->load->view('templates/header',$header);
		
		if ($this->input->post('go') == FALSE && $this->input->post('get_details') == TRUE)
		{
			//$header['title']='View Notice';
			$this->drawHeader("View Notice");
			$data['id'] = $this->view_notice_model->get_notice_ids();
			
			$data['selected']  = $this->input->post('notice_id');
			
			$this->load->view('information/view_noticeV',$data);
			
			$data['notice_row'] = $this->view_notice_model->get_notice_row($data['selected']);
			//var_dump($data);
			$data['prev_ver'] = $this->view_notice_model->get_prev_versions($data['selected']);
			$data['selected_ver'] = $this->input->post('pre_ver');
			
			$this->load->view('information/view_noticeR',$data);
			$this->load->view('information/click_for_prev_version_notice',$data);
			
			$data['notice_row'] = $this->view_notice_model->get_notice_row2($data['selected'],$data['selected_ver']);
			$this->load->view('information/view_noticeR',$data);
		}
		else if ($this->input->post('go') == FALSE)
		{
			//$header['title']='View Notice';
			$this->drawHeader("View Notice");
			$data['id'] = $this->view_notice_model->get_notice_ids();
			
			if($data['id'] == NULL)
			{
				$this->session->set_flashdata('flashError','There is no any notice.');
				redirect('information/view');
			
			}
			$this->load->view('information/view_noticeV',$data);
		}
		else 
		{
			//$header['title'] = 'View Notice';
			$this->drawHeader("View Notice");
			
			$data['id'] = $this->view_notice_model->get_notice_ids();
			$data['selected']  = $this->input->post('notice_id');
			
			$this->load->view('information/view_noticeV',$data);
			
			$data['notice_row'] = $this->view_notice_model->get_notice_row($data['selected']);
			//var_dump($data);
			$data['prev_ver'] = $this->view_notice_model->get_prev_versions($data['selected']);
			$this->load->view('information/view_noticeR',$data);
			$this->load->view('information/click_for_prev_version_notice',$data);
		}
		$this->drawFooter();
		*/
	}
	
	public function prev($notice_id='')
	{
		if($notice_id=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}		
		
		$this->load->model('information/viewPrevNotice_model','',TRUE);
		$data['notices'] = $this->viewPrevNotice_model->get_notices($notice_id);

		if(count($data['notices']) == 0)
		{
			$this->session->set_flashdata('flashError','There is no any notice to view.');
			redirect('home');
		}
	
		$data['prevnotice'] = $notice_id;
		$this->drawHeader('View Notice');
		$this->load->view('information/viewNotice',$data);
		$this->drawFooter();
	}
	
}
/* End of file view_notice.php */
/* Location: mis/application/controllers/information/view_notice.php */
