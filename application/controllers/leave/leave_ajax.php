<?php 

class Leave_ajax extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// Will never be used
	}

	public function get_dept($type)
	{
            var_dump($type);
		$this->load->model('departments_model');
		$result = $this->departments_model->get_departments ($type);
		$data['result'] = $result;
		$this->load->view('leave/leave_administration/department_name_view',$data);
	}
	public function get_designation ($dept)
	{
                $this->load->model('leave/leave_users_details_model','ludm');
		$result = $this->ludm->get_designation_by_department_id ($dept);
		$data['result'] = $result;
		$this->load->view('leave/leave_administration/designation_view',$data);
	}
	public function get_emp_name ($designation, $dept_id)
	{
                $this->load->model('leave/leave_users_details_model','ludm');
		$result = $this->ludm->get_emp_name ($designation, $dept_id);

		$this->load->model('user_model');
		
		$emp_id = $this->session->userdata('id');

		$data_array = array();
		$sno = 1;
		if ($result)
		{
			foreach ($result as $row)
			{			
				if ($row->id != $emp_id)
				{
					$data_array[$sno][1] = $row->id;
					$data_array[$sno++][2] = $this->user_model->getNameById($row->id);
				}
			}
		}
		$total_rows = ($sno-1);		
		$data['data_array'] = $data_array;
		$data['total_rows'] = $total_rows;

		$this->load->view('leave/leave_administration/faculty_name_view',$data);		
	}
        
        public function get_leave_by_emp_id($emp_id , $start_date , $end_date){
            $data = array();
            $this->load->model('leave/leave_history_model' , 'lhm');
            $data['leave_history_casual'] = $this->lhm->get_casual_leave_history_details($emp_id , $start_date,$end_date );
            $data['leave_history_restricted'] = $this->lhm->get_restricted_leave_history_details($emp_id , $start_date,$end_date );
            
            $this->load->view('leave/leave_administration/leave_details_view',$data);
        }
}