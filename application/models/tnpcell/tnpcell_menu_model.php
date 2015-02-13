<?php

class TnpCell_menu_model extends CI_Model
{
	function __construct()
	{
		// Calling the Model parent constructor
		parent::__construct();
	}
var $table_projects = 'tnp_cv_projects';
    var $table_achievements='tnp_cv_achievements';
	function getMenu()
	{
    /*checking if CV filled*/
    $flag=0;
    $user_id=$this->CI->session->userdata('id');
    $query=$this->db->get_where($this->table_projects, array('user_id'=>$user_id));
    if($query->result()) $flag=1;
    $query= $this->db->get_where($this->table_achievements, array('user_id'=>$user_id));
    if($query->result()) $flag=1;
    
    $menu=array();
    /*Student*/
		$menu['stu']=array();

     	$menu['stu']['T&P']=array();
    	$menu['stu']['T&P']["Fill CV"] = site_url('tnpcell/CV/');
		$menu['stu']['T&P']["View JNF"] = site_url('tnpcell/View_JNF/');
    	
		
		$menu['tpo']=array();
      	$menu['tpo']['T&P']=array();
      	$menu['tpo']['T&P']["View JNF"] = site_url('tnpcell/CV/');
		$menu['tpo']['T&P']["View Contact of Companies"] = site_url('tnpcell/CV/');
		$menu['tpo']['T&P']["View JNF"] = site_url('tnpcell/CV/');
		$menu['tpo']['T&P']["View JNF"] = site_url('tnpcell/CV/');
		
    	$menu['tpo']=array();
     	$menu['tpo']['T&P']=array();
      	$menu['tpo']['T&P']["Fill CV"] = site_url('tnpcell/CV/');
		return $menu;
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/course_structure/menu_model.php */