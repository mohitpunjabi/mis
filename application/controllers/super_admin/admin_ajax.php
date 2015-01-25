<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_ajax extends MY_Controller
{
	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// Will never be used
	}

	public function getUsersByDeptAuth($dept = 'all',$auth = 'all')
	{
		$this->load->model('user_model','',TRUE);
		$data['users']=$this->user_model->getUsersByDeptAuth($dept,$auth);
		$this->load->view('super_admin/admin_ajax/user_dept_view',$data);
	}

	public function deleteAuth($id, $dept = 'all',$auth)
	{
		$this->load->model('user/user_auth_types_model','',TRUE);
		$this->user_auth_types_model->delete(array('id'=>$id, 'auth_id'=>$auth));
		$this->getUsersByDeptAuth($dept,$auth);
	}
}