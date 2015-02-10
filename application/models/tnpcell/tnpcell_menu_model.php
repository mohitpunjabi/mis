<?php

class TnpCell_menu_model extends CI_Model
{
	function __construct()
	{
		// Calling the Model parent constructor
		parent::__construct();
	}

	function getMenu()
	{
		/*checking if CV filled*/
    $flag=0;
    $user_id=$this->CI->session->userdata('id');
    $query=$this->db->get_where('tnp_projects', array('user_id'=>$user_id));
    if($query->result()) $flag=1;
    $query= $this->db->get_where('tnp_cv_achievements', array('user_id'=>$user_id));
    if($query->result()) $flag=1;
    
    $menu=array();
    /*Student*/
		$menu['stu']=array();
      $menu['stu']['T&P']=array();      
      if($flag==0)	$menu['stu']['T&P']["Fill CV"] = site_url('tnpcell/CV/');
      else 
      {
        $menu['stu']['T&P']["View CV"] = site_url('tnpcell/CV/print_cv');
        $menu['stu']['T&P']["Edit CV"] = site_url('tnpcell/CV/edit_cv');
      }
    /*T&P Officer*/
    $menu['tpo']=array();
      if($flag==0)	$menu['tpo']['T&P']["Fill CV"] = site_url('tnpcell/CV/');
      else 
      {
        $menu['tpo']['T&P']["View CV"] = site_url('tnpcell/CV/print_cv');
        $menu['tpo']['T&P']["Edit CV"] = site_url('tnpcell/CV/edit_cv');
      }
		return $menu;
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/course_structure/menu_model.php */