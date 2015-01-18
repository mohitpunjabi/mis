<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_circular extends MY_Controller
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

		$this->form_validation->set_rules('circular_sub', 'Circular Subject', 'required');
		$this->form_validation->set_rules('circular_no', 'Circular Number', 'required');
		
		$this->load->model('information/edit_circular_model','',TRUE);
		
		//title for the page
		$header['title']='Edit Circular';
		$this->load->view('templates/header',$header);
		
		if ($this->form_validation->run() == FALSE || $this->input->post('editsubmit') == TRUE)
		{
			//circular number can't be changed
			$data['circular_id'] = $this->input->post('circular_id');
			$data['circular_no'] = $this->input->post('circular_no');
			$data['circular_sub'] = $this->input->post('circular_sub');
			$data['circular_cat'] = $this->input->post('circular_cat');
			$data['circular_path'] = $this->input->post('circular_path');
			$data['valid_upto'] = $this->input->post('valid_upto');
			$data['modification_value']= $this->input->post('modification_value');
			$this->load->view('information/edit_circular',$data);
		}
		else
		{
			if($_FILES['circular_path']['name'] !='')
			{
				
				$upload=$this->upload_file('circular_path',$this->input->post('circular_id'));
				if($upload)
				{
					//current date
					$date = date("Y-m-d");
					
					$circular=$this->edit_circular_model->getCircularsByMinId($this->input->post('circular_id'));
					$old_file = $circular->circular_path;
					
					$data = array('circular_id'=>$this->input->post('circular_id'),
							  'circular_no'=>$this->input->post('circular_no'),
							  'circular_sub'=>$this->input->post('circular_sub'),
							  'circular_cat'=>$this->input->post('circular_cat'),
							  'circular_path'=>$upload['file_name'],
							  'posted_on'=>$date,
							  'valid_upto'=>$this->input->post('valid_upto'),
							  'modification_value'=>$this->input->post('modification_value') + 1
							  );
				
					$this->edit_circular_model->insertM($data['circular_id']);
					$this->edit_circular_model->update($data);
					//if($old_file)	unlink(APPPATH.'../assets/files/information/circular/'.$old_file);
					$this->session->set_flashdata('flashSuccess','Circular has been successfully updated.');
					redirect('information/menu');
				
					//$this->load->view('information/edit_circular_success');
				}
			}
			else
			{
				//current date
					$date = date("Y-m-d");
					
					
					$data = array('circular_id'=>$this->input->post('circular_id'),
							  'circular_no'=>$this->input->post('circular_no'),
							  'circular_sub'=>$this->input->post('circular_sub'),
							  'circular_cat'=>$this->input->post('circular_cat'),
							  'posted_on'=>$date,
							  'valid_upto'=>$this->input->post('valid_upto'),
							  'modification_value'=>$this->input->post('modification_value') + 1
							  );
				
				$this->edit_circular_model->insertM($data['circular_id']);
				$this->edit_circular_model->update($data);
				$this->session->set_flashdata('flashSuccess','Circular has been successfully updated.');
				redirect('information/menu');
			}
		}
		$this->load->view('templates/footer');
	}
	
	
	private function upload_file($name ='',$sno = 0)
	{
		$config['upload_path'] = 'assets/files/information/circular';
		$config['allowed_types'] = 'pdf|doc|docx';
		$config['max_size']  = '2000';

			if(isset($_FILES[$name]['name']))
        	{
                if($_FILES[$name]['name'] == "")
            		$filename = "";
                else
				{
                    $filename=$this->security->sanitize_filename(strtolower($_FILES[$name]['name']));
                    $ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
                    $filename='CIRCULAR_'.date('YmdHis').$sno.$ext;
                }
	        }
	        else
	        {
	        	$this->session->set_flashdata('flashError','ERROR: File Name not set.');
	        	redirect('information/edit_circular');
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
				redirect('information/edit_circular');
				return FALSE;
			}
			else
			{
				$upload_data = $this->upload->data();
				return $upload_data;
			}
	}
}
/* End of file edit_circular.php */
/* Location: mis/application/controllers/information/edit_circular.php */
