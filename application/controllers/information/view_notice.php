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
			$data['secondLink'] = '<a href="'.base_url().'index.php/information/view_notice/index/archieved">List of Archived Notices</a>';
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
			$data['firstLink']  = 'List of Archived Notices';
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
