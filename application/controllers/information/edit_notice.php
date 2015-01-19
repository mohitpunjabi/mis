<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_notice extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod','est_ar','exam_dr','dt','dsw'));
	}

	public function index($error='')
	{
		$data['error']=$error;
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('notice_sub', 'Notice Subject', 'required');
		$this->form_validation->set_rules('notice_no', 'Notice Number', 'required');
		
		$this->load->model('information/edit_notice_model','',TRUE);
		
		//title for the page
		//$header['title']='Edit notice';
		$this->drawHeader("Edit notice");
		
		if ($this->form_validation->run() == FALSE || $this->input->post('editsubmit') == TRUE)
		{
			//notice id can't be changed
			$data['notice_id'] = $this->input->post('notice_id');
			$data['notice_no'] = $this->input->post('notice_no');
			$data['notice_sub'] = $this->input->post('notice_sub');
			$data['notice_cat'] = $this->input->post('notice_cat');
			$data['notice_path'] = $this->input->post('notice_path');
			$data['last_date'] = $this->input->post('last_date');
			$data['modification_value']=$this->input->post('modification_value');
			$this->load->view('information/edit_notice',$data);
		}
		else
		{
			if($_FILES['notice_path']['name'] != '')
			{
				
				$upload=$this->upload_file('notice_path',$this->input->post('notice_id'),$this->input->post('modification_value'));
				if($upload)
				{
					//current date
					$date = date("Y-m-d");
					
					$notice=$this->edit_notice_model->getnoticesByMinId($this->input->post('notice_id'));
					$old_file = $notice->notice_path;
					
					$data = array('notice_id'=>$this->input->post('notice_id'),
							  'notice_no'=>$this->input->post('notice_no'),
							  'notice_sub'=>$this->input->post('notice_sub'),
							  'notice_cat'=>$this->input->post('notice_cat'),
							  'notice_path'=>$upload['file_name'],
							  'last_date'=>$this->input->post('last_date'),
							  'posted_on'=>$date,
							  'modification_value'=>$this->input->post('modification_value') + 1
							  );
				    
					$this->edit_notice_model->insertM($data['notice_id']);
					$this->edit_notice_model->update($data);
					//if($old_file)	unlink(APPPATH.'../assets/files/information/notice/'.$old_file);
					$this->session->set_flashdata('flashSuccess','Notice has been successfully updated.');
					redirect('information/menu');
				
					//$this->load->view('information/edit_notice_success');
				}
			}
			else
			{
				//current date
					$date = date("Y-m-d");
					
					
					$data = array('notice_id'=>$this->input->post('notice_id'),
							  'notice_no'=>$this->input->post('notice_no'),
							  'notice_sub'=>$this->input->post('notice_sub'),
							  'notice_cat'=>$this->input->post('notice_cat'),
							  'last_date'=>$this->input->post('last_date'),
							  'posted_on'=>$date,
							  'modification_value'=>$this->input->post('modification_value') + 1
							  );
				
				$this->edit_notice_model->insertM($data['notice_id']);
				$this->edit_notice_model->update($data);
				$this->session->set_flashdata('flashSuccess','Notice has been successfully updated.');
				redirect('information/menu');
			}
		}
		$this->drawFooter();
	}
	
	
	private function upload_file($name ='',$sno = 0)
	{
		$config['upload_path'] = 'assets/files/information/notice';
		$config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png';
		$config['max_size']  = '2000';
		
			if(isset($_FILES[$name]['name']))
        	{
                if($_FILES[$name]['name'] == "")
            		$filename = "";
                else
				{
                    $filename=$this->security->sanitize_filename(strtolower($_FILES[$name]['name']));
                    $ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
                    $filename='NOTICE_'.date('YmdHis').$sno.$ext;
                }
	        }
	        else
	        {
	        	$this->session->set_flashdata('flashError','ERROR: File Name not set.');
	        	redirect('information/edit_notice');
				return FALSE;
	        }
	   
			$config['file_name'] = $filename;
			//$this->load->view('welcome_message',array('d'=>array('photo_image'=>$_FILES,'config'=>$config)));
			//return FALSE;

			if(!is_dir($config['upload_path']))	//create the folder if it's not already exists
			{
				mkdir($config['upload_path'],0777,TRUE);
			}

			$this->load->library('upload', $config);
		
			if ( ! $this->upload->do_multi_upload($name))		//do_multi_upload is back compatible with do_upload
			{
				$this->session->set_flashdata('flashError',$this->upload->display_errors('',''));
				redirect('information/edit_notice');
				return FALSE;
			}
			else
			{
				$upload_data = $this->upload->data();
				return $upload_data;
			}
	}
}
/* End of file edit_notice.php */
/* Location: mis/application/controllers/information/edit_notice.php */
