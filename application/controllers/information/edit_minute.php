<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_minute extends MY_Controller
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

		$this->form_validation->set_rules('minutes_no', 'Minutes Number', 'required');
		$this->form_validation->set_rules('place_of_meeting', 'Meeting Place', 'required');
		
		$this->load->model('information/edit_minute_model','',TRUE);
		
		//title for the page
		//$header['title']='Edit Minutes';
		$this->drawHeader("Edit Minutes");
		
		if ($this->form_validation->run() == FALSE || $this->input->post('editsubmit') == TRUE)
		{
			//minute number can't be changed
			$data['minutes_id'] = $this->input->post('minutes_id');
			$data['minutes_no'] = $this->input->post('minutes_no');
			$data['meeting_type'] = $this->input->post('meeting_type');
			$data['meeting_cat'] = $this->input->post('meeting_cat');
			$data['minutes_path'] = $this->input->post('minutes_path');
			$data['date_of_meeting'] = $this->input->post('date_of_meeting');
			$data['place_of_meeting'] = $this->input->post('place_of_meeting');
			$data['valid_upto'] = $this->input->post('valid_upto');
			$data['modification_value'] = $this->input->post('modification_value');
			
			$this->load->view('information/edit_minute',$data);
		}
		else
		{
			if($_FILES['minutes_path']['name'] !='')
			{
				
				$upload=$this->upload_file('minutes_path',$this->input->post('minutes_id'));
				if($upload)
				{
					//current date
					$date = date("Y-m-d");
					$minutes=$this->edit_minute_model->getMinutesByMinId($this->input->post('minutes_id'));
					$old_file = $minutes->minutes_path;
					$others = $this->input->post('meeting_type');
					//checking for others meeting type
					if($others=='others')
						$others  = $this->input->post('meeting_others');
					
					$data = array('minutes_id'=>$this->input->post('minutes_id'),
						      'minutes_no'=>$this->input->post('minutes_no'),
							  'meeting_type'=>$others, 
							  'meeting_cat'=>$this->input->post('meeting_cat'),
							  'minutes_path'=>$upload['file_name'],
							  'date_of_meeting'=>$this->input->post('date_of_meeting'),
							  'place_of_meeting'=>$this->input->post('place_of_meeting'),
							  'issued_by'=>$this->session->userdata('id'),
							  'posted_on'=>$date,
							  'valid_upto'=>$this->input->post('valid_upto'),
							  'modification_value'=>$this->input->post('modification_value') + 1
							  );
				
					$this->edit_minute_model->insertM($data['minutes_id']);
					$this->edit_minute_model->update($data);
					//if($old_file)	unlink(APPPATH.'../assets/files/information/minute/'.$old_file);
					$this->session->set_flashdata('flashSuccess','Minutes has been successfully updated.');
					redirect('information/menu');
				
					//$this->load->view('information/edit_minute_success');
				}
			}
			else
			{
				//current date
					$date = date("Y-m-d");
					
					$others = $this->input->post('meeting_type');
					//checking for others meeting type
					if($others=='others')
						$others  = $this->input->post('meeting_others');
					
					$data = array('minutes_id'=>$this->input->post('minutes_id'),
						      'minutes_no'=>$this->input->post('minutes_no'),
							  'meeting_type'=>$others, 
							  'meeting_cat'=>$this->input->post('meeting_cat'),
							  'date_of_meeting'=>$this->input->post('date_of_meeting'),
							  'place_of_meeting'=>$this->input->post('place_of_meeting'),
							  'posted_on'=>$date,
							  'valid_upto'=>$this->input->post('valid_upto'),
							  'modification_value'=>$this->input->post('modification_value') +1
							  );
				
				$this->edit_minute_model->insertM($data['minutes_id']);
				$this->edit_minute_model->update($data);
				$this->session->set_flashdata('flashSuccess','Minutes has been successfully updated.');
				redirect('information/menu');
			}
		}
		$this->drawFooter();
	}
	
	
	private function upload_file($name ='',$sno = 0)
	{
		$config['upload_path'] = 'assets/files/information/minute';
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
                    $filename='MINUTE_'.date('YmdHis').$sno.$ext;
                }
	        }
	        else
	        {
	        	$this->session->set_flashdata('flashError','ERROR: File Name not set.');
	        	redirect('information/edit_minute');
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
				redirect('information/edit_minute');
				return FALSE;
			}
			else
			{
				$upload_data = $this->upload->data();
				return $upload_data;
			}
	}
}
/* End of file edit_minute.php */
/* Location: mis/application/controllers/information/edit_minute.php */
