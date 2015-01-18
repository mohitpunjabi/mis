<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_edit_notice extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod','est_ar','exam_dr','dt','dsw'));
		
		//to remove the notices whose last date occurs
		$this->load->model('information/search_edit_notice_model','',TRUE);
		$this->search_edit_notice_model->remove();
		
	}

	public function index($error='')
	{
		$data['error']=$error;
		
		$this->load->model('information/search_edit_notice_model','',TRUE);
		
		//title for the page
		//$header['title']='Search Edit Notice';
		//$this->load->view('templates/header',$header);
		
		if ($this->input->post('go') == FALSE)
		{
			//$header['title']='Search Edit Notice';
			$this->drawHeader("Search(Edit) Notice");
			$data['id'] = $this->search_edit_notice_model->get_notice_ids();
			
			if($data['id'] == NULL)
			{
				$this->session->set_flashdata('flashError','There is no any notice to edit.');
				redirect('information/search_edit');
			
			}
			$this->load->view('information/search_edit_notice',$data);
		}
		else
		{
			//$header['title'] = 'View Notice';
			$this->drawHeader("View Notice");
			
			$data['id'] = $this->search_edit_notice_model->get_notice_ids();
			$data['selected']  = $this->input->post('notice_id');
			
			$this->load->view('information/search_edit_notice',$data);
			
			$data['notice_row'] = $this->search_edit_notice_model->get_notice_row($data['selected']);
			//var_dump($data);
			$this->load->view('information/view_notice',$data);
		}
		$this->drawFooter();
	}
	
}
/* End of file search_edit_notice.php */
/* Location: mis/application/controllers/information/search_edit_notice.php */
