<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_notice extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','stu'));
	}

	public function index($error='')
	{
		$data['error']=$error;
		
		$this->load->model('information/view_notice_model','',TRUE);
		
		//title for the page
		//$header['title']='Search Removed Notice';
		//$this->load->view('templates/header',$header);
		
		if ($this->input->post('go') == FALSE && $this->input->post('get_details') == TRUE)
		{
			$header['title']='View Notice';
			$this->load->view('templates/header',$header);
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
			$header['title']='View Notice';
			$this->load->view('templates/header',$header);
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
			$header['title'] = 'View Notice';
			$this->load->view('templates/header',$header);
			
			$data['id'] = $this->view_notice_model->get_notice_ids();
			$data['selected']  = $this->input->post('notice_id');
			
			$this->load->view('information/view_noticeV',$data);
			
			$data['notice_row'] = $this->view_notice_model->get_notice_row($data['selected']);
			//var_dump($data);
			$data['prev_ver'] = $this->view_notice_model->get_prev_versions($data['selected']);
			$this->load->view('information/view_noticeR',$data);
			$this->load->view('information/click_for_prev_version_notice',$data);
		}
		$this->load->view('templates/footer');
	}
	
}
/* End of file view_notice.php */
/* Location: mis/application/controllers/information/view_notice.php */
