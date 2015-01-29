<?php

class Guard_menu_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getMenu()
	{
		$menu=array();
		//auth ==> supervisor
		$menu['guard_sup']['Guard Management']=array();
		$menu['guard_sup']['Guard Management']['Home'] = site_url('guard/home');
		
		$menu['guard_sup']['Guard Management']['Duties'] = array();
		//$menu['guard_sup']['Guard Management']['Duties']['Auto Assignment'] = site_url('guard/duties/auto_assignment');
		$menu['guard_sup']['Guard Management']['Duties']['Manual Assignment'] = site_url('guard/duties/manual_assignment');
		$menu['guard_sup']['Guard Management']['Duties']['Assign Duty to a Guard'] = site_url('guard/duties/assign_to_a_guard');
		$menu['guard_sup']['Guard Management']['Duties']['Overtime Duties'] = array();
		$menu['guard_sup']['Guard Management']['Duties']['Overtime Duties']['Assign Duties'] = site_url('guard/overduties/assign_to_a_guard');
		$menu['guard_sup']['Guard Management']['Duties']['Overtime Duties']['View Duties'] = site_url('guard/overduties/view');
		
		$menu['guard_sup']['Guard Management']['Duties']['Today\'s Chart'] = site_url('guard/duties/today_chart');
		$menu['guard_sup']['Guard Management']['Duties']['Tomorrow\'s Chart'] = site_url('guard/duties/tomorrow_chart');
		$menu['guard_sup']['Guard Management']['Duties']['Complete Chart'] = site_url('guard/duties/complete_chart');	
		
		$menu['guard_sup']['Guard Management']['Manage Guard'] = array();
		$menu['guard_sup']['Guard Management']['Manage Guard']['Add Guard'] = site_url('guard/manage_guard/add');
		$menu['guard_sup']['Guard Management']['Manage Guard']['View Existing Guards'] = site_url('guard/manage_guard/view');
		
		$menu['guard_sup']['Guard Management']['Manage Post'] = array();
		$menu['guard_sup']['Guard Management']['Manage Post']['Add Post'] = site_url('guard/manage_post/add');	
		$menu['guard_sup']['Guard Management']['Manage Post']['View Existing Posts'] = site_url('guard/manage_post/view');	
		
		return $menu;
	}
}
/* End of file information_menu.php */
/* Location: mis/application/models/information/information_menu.php */