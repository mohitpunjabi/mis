<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_edit_minute extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod','est_ar','exam_dr','dt','dsw'));
		
		//to remove the minutes whose last date occurs
		$this->load->model('information/search_edit_minute_model','',TRUE);
		$this->search_edit_minute_model->remove();
	}

	public function index($error='')
	{
		$data['error']=$error;
		
		$this->load->model('information/search_edit_minute_model','',TRUE);
		
		//title for the page
		//$header['title']='Search Edit Minutes';
		//$this->load->view('templates/header',$header);
		
		if ($this->input->post('go') == FALSE)
		{
			//$header['title']='Search Edit Minutes';
			$this->drawHeader("Search(Edit) Minutes");
			$data['id'] = $this->search_edit_minute_model->get_minute_ids();
			//var_dump($data);
			if($data['id'] == NULL)
			{
				$this->session->set_flashdata('flashError','There is no any minutes to edit.');
				redirect('information/search_edit');
			
			}
			$this->load->view('information/search_edit_minute',$data);
		}
		else
		{
			//$header['title'] = 'View Minutes';
			$this->drawHeader("View Minutes");
			
			$data['id'] = $this->search_edit_minute_model->get_minute_ids();
			$data['selected']  = $this->input->post('minute_id');
			
			$this->load->view('information/search_edit_minute',$data);
			
			$data['minute_row'] = $this->search_edit_minute_model->get_minute_row($data['selected']);
			//var_dump($data);
			$this->load->view('information/view_minute',$data);
		}
		$this->drawFooter();
	}
	
}
/* End of file search_edit_minute.php */
/* Location: mis/application/controllers/information/search_edit_minute.php */
