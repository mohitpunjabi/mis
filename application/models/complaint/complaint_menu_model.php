<?php if(!defined("BASEPATH")){ exit("No direct script access allowed"); }

class Complaint_menu_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getMenu()
	{
		$menu=array();
		//auth ==> emp
		$menu['emp']=array();
		$menu['emp']['Online Complaint'] = array();
		$menu['emp']['Online Complaint']['Register your Complaint'] = site_url('complaint/register_complaint');
		$menu['emp']['Online Complaint']['View all your Complaint'] = site_url('complaint/view_complaint');
		
		//auth ==> stu
		$menu['stu']=array();
		$menu['stu']['Online Complaint'] = array();
		$menu['stu']['Online Complaint']['Register your Complaint'] = site_url('complaint/register_complaint');
		$menu['stu']['Online Complaint']['View all your Complaint'] = site_url('complaint/view_complaint');

		$menu['spvr_cc']=array();
		$menu['spvr_cc']['Online Complaint'] = array();
		$menu['spvr_cc']['Online Complaint']['Registered Complaint List (Open)'] = site_url('complaint/supervisor/open_complaint_list/Internet');
		$menu['spvr_cc']['Online Complaint']['View Complaint List (Closed)'] = site_url('complaint/supervisor/view_closed_complaint/Internet');
		$menu['spvr_cc']['Online Complaint']['View Complaint List (Rejected)'] = site_url('complaint/supervisor/view_rejected_complaint/Internet');
		$menu['spvr_cc']['Online Complaint']['View Complaint List (All)'] = site_url('complaint/supervisor/view_all_complaint/Internet');
		
		$menu['spvr_civil']=array();
		$menu['spvr_civil']['Online Complaint'] = array();
		$menu['spvr_civil']['Online Complaint']['Registered Complaint List (Open)'] = site_url('complaint/supervisor/open_complaint_list/Civil');
		$menu['spvr_civil']['Online Complaint']['View Complaint List (Closed)'] = site_url('complaint/supervisor/view_closed_complaint/Civil');
		$menu['spvr_civil']['Online Complaint']['View Complaint List (Rejected)'] = site_url('complaint/supervisor/view_rejected_complaint/Civil');
		$menu['spvr_civil']['Online Complaint']['View Complaint List (All)'] = site_url('complaint/supervisor/view_all_complaint/Civil');

		$menu['spvr_ee']=array();
		$menu['spvr_ee']['Online Complaint'] = array();
		$menu['spvr_ee']['Online Complaint']['Registered Complaint List (Open)'] = site_url('complaint/supervisor/open_complaint_list/Electrical');
		$menu['spvr_ee']['Online Complaint']['View Complaint List (Closed)'] = site_url('complaint/supervisor/view_closed_complaint/Electrical');
		$menu['spvr_ee']['Online Complaint']['View Complaint List (Rejected)'] = site_url('complaint/supervisor/view_rejected_complaint/Electrical');
		$menu['spvr_ee']['Online Complaint']['View Complaint List (All)'] = site_url('complaint/supervisor/view_all_complaint/Electrical');

		$menu['spvr_mess']=array();
		$menu['spvr_mess']['Online Complaint'] = array();
		$menu['spvr_mess']['Online Complaint']['Registered Complaint List (Open)'] = site_url('complaint/supervisor/open_complaint_list/Mess');
		$menu['spvr_mess']['Online Complaint']['View Complaint List (Closed)'] = site_url('complaint/supervisor/view_closed_complaint/Mess');
		$menu['spvr_mess']['Online Complaint']['View Complaint List (Rejected)'] = site_url('complaint/supervisor/view_rejected_complaint/Mess');
		$menu['spvr_mess']['Online Complaint']['View Complaint List (All)'] = site_url('complaint/supervisor/view_all_complaint/Mess');

		$menu['spvr_snt']=array();
		$menu['spvr_snt']['Online Complaint'] = array();
		$menu['spvr_snt']['Online Complaint']['Registered Complaint List (Open)'] = site_url('complaint/supervisor/open_complaint_list/Sanitary');
		$menu['spvr_snt']['Online Complaint']['View Complaint List (Closed)'] = site_url('complaint/supervisor/view_closed_complaint/Sanitary');
		$menu['spvr_snt']['Online Complaint']['View Complaint List (Rejected)'] = site_url('complaint/supervisor/view_rejected_complaint/Sanitary');
		$menu['spvr_snt']['Online Complaint']['View Complaint List (All)'] = site_url('complaint/supervisor/view_all_complaint/Sanitary');

		return $menu;
	}
}
/* End of file employee_menu.php */
/* Location: mis/application/models/employee/employee_menu.php */