<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Duties extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('guard_sup'));
		$this->addJS('employee/print_script.js');
	}
	
	function index()
	{
		$this->session->set_flashdata('flashError','Access Denied!');
		redirect('home');
	}
	
	function loadcompDutyChart() {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/DutyChart_list", array("DutyChart" => $this->guard_model->get_all_duties_chart()));
	}
	
	function loaddateDutyChart() {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/DutyChart_list", array("DutyChart" => $this->guard_model->get_details_of_guard_at_a_date(date("Y-m-d"))));
	}
	
	function loadtomorrowDutyChart() {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/DutyChart_list", array("DutyChart" => $this->guard_model->get_details_of_guard_at_a_date(date("Y-m-d",strtotime(date("Y-m-d"))+86400))));
	}
	
	function complete_chart()
	{
		$this->load->model('guard/guard_model');
		$this->addJS('guard/compDutyChart-loader.js');
		$data['all_duties_chart'] = $this->guard_model->get_all_duties_chart();
		
		if(count($data['all_duties_chart']) == 0)
		{
			$this->session->set_flashdata('flashError','Duty Chart is empty.');
			redirect('guard/home');
		}
		
		$data['day'] = 'Complete';
		$this->drawHeader('Complete Duty Chart');
		$this->load->view('guard/duty_chart');//,array("DutyChart" => $this->guard_model->get_all_duties_chart()));
		$this->load->view('guard/view_footer');
		$this->drawFooter();
	}
	
	function tomorrow_chart()
	{
		$this->load->model('guard/guard_model');
		$this->addJS('guard/tomorrowDutyChart-loader.js');
		
		$data['details_of_guards_at_a_date'] = $this->guard_model->get_details_of_guard_at_a_date(date("Y-m-d",strtotime(date("Y-m-d"))+86400));
		// $data['details_of_guards_at_a_date_A'] = $this->guard_model->get_details_of_guard_at_a_date_A(date("Y-m-d",strtotime(date("Y-m-d"))+86400));
		// $data['details_of_guards_at_a_date_B'] = $this->guard_model->get_details_of_guard_at_a_date_B(date("Y-m-d",strtotime(date("Y-m-d"))+86400));
		// $data['details_of_guards_at_a_date_C'] = $this->guard_model->get_details_of_guard_at_a_date_C(date("Y-m-d",strtotime(date("Y-m-d"))+86400));
		
		if(count($data['details_of_guards_at_a_date']) == 0)
		{
			$this->session->set_flashdata('flashError','Duty Chart is empty for tomorrow.');
			redirect('guard/home');
		}
		$data['day'] = 'Tomorrow';
		$this->drawHeader('Tomorrow\'s Duty Chart');
		$this->load->view('guard/to_duty_chart',$data);
		$this->load->view('guard/view_footer');
		$this->drawFooter();
	
	}
	
	function today_chart()
	{
		$this->load->model('guard/guard_model');
		$this->addJS('guard/dateDutyChart-loader.js');
		
		$data['details_of_guards_at_a_date'] = $this->guard_model->get_details_of_guard_at_a_date(date("Y-m-d"));
		// $data['details_of_guards_at_a_date_A'] = $this->guard_model->get_details_of_guard_at_a_date_A(date("Y-m-d"));
		// $data['details_of_guards_at_a_date_B'] = $this->guard_model->get_details_of_guard_at_a_date_B(date("Y-m-d"));
		// $data['details_of_guards_at_a_date_C'] = $this->guard_model->get_details_of_guard_at_a_date_C(date("Y-m-d"));
		
		if(count($data['details_of_guards_at_a_date']) == 0)
		{
			$this->session->set_flashdata('flashError','Duty Chart is empty for today.');
			redirect('guard/home');
		}
		
		$data['day'] = 'Today';
		$this->drawHeader('Today\'s Duty Chart');
		$this->load->view('guard/to_duty_chart',$data);
		$this->load->view('guard/view_footer');
		$this->drawFooter();
	
	}
	
	function assign_to_a_guard()
	{
		$this->load->model('guard/guard_model');
		
		if($this->input->post('assign') == TRUE)
		{
			$data = array('date'=>$this->input->post('date'),
						  'post_id'=>$this->input->post('post_id'),
						  'Regno'=>$this->input->post('regno'),
						  'shift'=>$this->input->post('shift')
						  );
			$this->guard_model->insert_into_duty($data);	
			$this->session->set_flashdata('flashSuccess','Duty has been assigned successfully.');
			redirect('guard/duties/tomorrow_chart');
		}
		
		$data['available_guards'] = $this->guard_model->get_available_guards();
		
		if(count($data['available_guards']) == 0)
		{
			$this->session->set_flashdata('flashError','All Guards are already assigned their duties.');
			redirect('guard/home');
		}
		
		$data['posts'] = $this->guard_model->get_posts();
		
		$this->drawHeader('Assign Duty to a Guard');
		$this->load->view('guard/assign_to_a_guard',$data);
		$this->drawFooter();
		
	}
	
	function manual_assignment()
	{
		
		$this->load->model('guard/guard_model');
		$data['guards'] = $this->guard_model->get_guards_with_duties();
		$data['posts'] = $this->guard_model->get_posts();
		
		$tomorrow_duties = $this->guard_model->get_all_tomorrow_duties();
		
		if(count($tomorrow_duties) != 0)
		{
			$this->session->set_flashdata('flashError','You have already assigned duties for tomorrow.');
			redirect('guard/home');
		}
		
		if($this->input->post('assignment') == TRUE)
		{
			foreach($data['guards'] as $row)
			{
				$shift = 'shift_'.$row['Regno'];
				$postname = 'postname_'.$row['Regno'];
				if($this->input->post($postname) == TRUE)
				{
					$date = date('Y-m-d',strtotime(date("Y-m-d"))+86400);
					$data = array('date'=>$date,
								  'shift'=>$this->input->post($shift),
								  'Regno'=>$row['Regno'],
								  'post_id'=>$this->input->post($postname)
								  );
					$this->guard_model->insert_into_duty($data);	
				}
			}
			$this->session->set_flashdata('flashSuccess','Duties have been assigned successfully for tomorrow.');
			redirect('guard/duties/tomorrow_chart');	
		}
		
		if(count($data['guards']) == 0 || count($data['posts']) == 0) 
		{
			$this->session->set_flashdata('flashError','There is no guard to assign duty.');
			redirect('guard/home');
		}
		
		$this->drawHeader('Manual Assignment');
		$this->load->view('guard/manual_assignment',$data);
		$this->drawFooter();
	}
	
	function auto_assignment()
	{
		$this->load->model('guard/guard_model');
		$tomorrow_duties = $this->guard_model->get_all_tomorrow_duties();
		$today_duties = $this->guard_model->get_all_today_duties();
		
		if(count($tomorrow_duties) != 0)
		{
			$this->session->set_flashdata('flashError','You have already assigned duties for tomorrow.');
			redirect('guard/home');
		}
		
		if(count($today_duties) == 0)
		{
			$this->session->set_flashdata('flashError','There is no any duty for today.');
			redirect('guard/home');
		}
		
		foreach($today_duties as $row)
		{
			
			//rotating shifts for each guard
			if($row['shift'] == 'a') $row['shift'] = 'c';
			else if($row['shift'] == 'b') $row['shift'] = 'a';
			else if($row['shift'] == 'c') $row['shift'] = 'b';
			
			$row['date'] = date('Y-m-d',strtotime(date("Y-m-d"))+86400);
			$this->guard_model->insert_into_duty($row);			
		}
		$this->session->set_flashdata('flashSuccess','Duties have been assigned automatically for tomorrow.');
		redirect('guard/home');
	}
	
	function replace($regno='',$post_id='',$shift='',$date='')
	{
		$this->load->model('guard/guard_model');
		
		if($this->input->post('replace') != FALSE)
		{
			$date = $this->input->post('date');
			$shift = $this->input->post('shift');
			$guard_id = $this->input->post('guard_id');
			$regno = $this->input->post('regno');
			$post_id = $this->input->post('post_id');
			$remarks = $this->input->post('remarks');
			
			$data = array('date'=>$date,
							  'shift'=>$shift,
							  'Regno'=>$guard_id,
							  'post_id'=>$post_id,
							  'remarks'=>$remarks
							  );
			$this->guard_model->update_duty($data, $regno);
		
			$this->session->set_flashdata('flashSuccess','Duty has been replaced successfully.');
			if($date == date("Y-m-d"))
				redirect('guard/duties/today_chart');
			else
				redirect('guard/duties/tomorrow_chart');		
		}
		
		if($regno=='' || $post_id=='' || $shift=='' || $date=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}		
		
		$data['all_gaurds_at_same_shift'] = $this->guard_model->get_all_guards_at_same_shift_post($shift,$date);
		
		$data['regno'] = $regno;
		$data['post_id'] = $post_id;
		$data['date']  = $date;
		$data['shift'] = $shift;
		$data['postname'] = $this->guard_model->get_postname_of_a_post_id($post_id)->postname;
		$data['guarddetails'] = $this->guard_model->get_guard_details($regno);
		
		$this->drawHeader('Replace Guard');
		$this->load->view('guard/replace',$data);
		$this->drawFooter();

	}
	
	function remove($regno='',$post_id='',$shift='',$date='')
	{
		$this->load->model('guard/guard_model');
		
		if($regno=='' || $post_id=='' || $shift=='' || $date=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}
			
		if($this->guard_model->remove_from_duty($regno,$post_id,$shift,$date)) 
			$this->session->set_flashdata('flashSuccess','Duty has been removed successfully.');
		else
			$this->session->set_flashdata('flashError','Try Again!, There is some error in removing the guard.');
		if($date == date("Y-m-d"))
			redirect('guard/duties/today_chart');
		else
			redirect('guard/duties/tomorrow_chart');		
	}
}

?>