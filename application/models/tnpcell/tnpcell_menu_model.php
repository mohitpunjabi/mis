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
		$menu=array();
		$menu['stu']=array();
      $menu['stu']['T&P']=array();
    	$menu['stu']['T&P']["Fill CV"] = site_url('tnpcell/CV/');
    $menu['deo']=array();
      $menu['deo']['T&P']=array();
      $menu['deo']['T&P']["Fill CV"] = site_url('tnpcell/CV/');
    $menu['tpo']=array();
      $menu['tpo']['T&P']=array();
      $menu['tpo']['T&P']["Fill CV"] = site_url('tnpcell/CV/');
		return $menu;
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/course_structure/menu_model.php */