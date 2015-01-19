<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search_edit_circular extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod','est_ar','exam_dr','dt','dsw'));
		
		//to remove the circulars whose last date occurs
		$this->load->model('information/search_edit_circular_model','',TRUE);
		$this->search_edit_circular_model->remove();
	}

	public function index($error='')
	{
		$data['error']=$error;
		
		$this->load->model('information/search_edit_circular_model','',TRUE);
		
		//title for the page
		//$header['title']='Search Edit Minutes';
		//$this->load->view('templates/header',$header);
		
		if ($this->input->post('go') == FALSE)
		{
			//$header['title']='Search Edit Circular';
			$this->drawHeader("Search(Edit) Circular");
			$data['id'] = $this->search_edit_circular_model->get_circular_ids();
			//var_dump($data);
			if($data['id'] == NULL)
			{
				$this->session->set_flashdata('flashError','There is no any circular to edit.');
				redirect('information/search_edit');
			
			}
			$this->load->view('information/search_edit_circular',$data);
		}
		else
		{
			//$header['title'] = 'View Circular';
			$this->drawHeader("View Circular");
			
			$data['id'] = $this->search_edit_circular_model->get_circular_ids();
			$data['selected']  = $this->input->post('circular_id');
			
			$this->load->view('information/search_edit_circular',$data);
			
			$data['circular_row'] = $this->search_edit_circular_model->get_circular_row($data['selected']);
			//var_dump($data);
			$this->load->view('information/view_circular',$data);
		}
		$this->draewFooter();
	}
	
}
/* End of file search_edit_circular.php */
/* Location: mis/application/controllers/information/search_edit_circular.php */
