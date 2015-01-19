<?php

class Information_menu_model extends CI_Model
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
		$menu['emp']['Information Management']=array();
		$menu['emp']["Information Management"]["View Notice, Circular or Minute"] = array();
		$menu['emp']["Information Management"]["View Notice, Circular or Minute"]['Notice'] = site_url('information/view_notice');
		$menu['emp']["Information Management"]["View Notice, Circular or Minute"]['Circular'] = site_url('information/view_circular');
		$menu['emp']["Information Management"]["View Notice, Circular or Minute"]['Minute'] = site_url('information/view_minute');
		
		//auth ==> stu
		$menu['stu']=array();
		$menu['stu']['Information Management']=array();
		$menu['stu']["Information Management"]["View Notice, Circular or Minute"] = array();
		$menu['stu']["Information Management"]["View Notice, Circular or Minute"]['Notice'] = site_url('information/view_notice');
		$menu['stu']["Information Management"]["View Notice, Circular or Minute"]['Circular'] = site_url('information/view_circular');
		$menu['stu']["Information Management"]["View Notice, Circular or Minute"]['Minute'] = site_url('information/view_minute');
		
		
		//auth ==> est_ar
		$menu['est_ar']=array();
		$menu['est_ar']['Information Management']=array();
		$menu['est_ar']["Information Management"]["Post Notice, Circular or Minute"]=array();
		$menu['est_ar']["Information Management"]["Post Notice, Circular or Minute"]['Notice'] = site_url('information/post_notice');
		$menu['est_ar']["Information Management"]["Post Notice, Circular or Minute"]['Circular'] = site_url('information/post_circular');
		$menu['est_ar']["Information Management"]["Post Notice, Circular or Minute"]['Minute'] = site_url('information/post_minute');
		
		$menu['est_ar']["Information Management"]["Search(Edit) Notice, Circular or Minute"]=array();
		$menu['est_ar']["Information Management"]["Search(Edit) Notice, Circular or Minute"]['Notice'] = site_url('information/search_edit_notice');
		$menu['est_ar']["Information Management"]["Search(Edit) Notice, Circular or Minute"]['Circular'] = site_url('information/search_edit_circular');
		$menu['est_ar']["Information Management"]["Search(Edit) Notice, Circular or Minute"]['Minute'] = site_url('information/search_edit_minute');

		$menu['est_ar']["Information Management"]["Search Removed Notice, Circular or Minute"]=array();
		$menu['est_ar']["Information Management"]["Search Removed Notice, Circular or Minute"]['Notice'] = site_url('information/search_notice');
		$menu['est_ar']["Information Management"]["Search Removed Notice, Circular or Minute"]['Circular'] = site_url('information/search_circular');
		$menu['est_ar']["Information Management"]["Search Removed Notice, Circular or Minute"]['Minute'] = site_url('information/search_minute');
		
		$menu['est_ar']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]=array();
		$menu['est_ar']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]['Notice'] = site_url('information/search_prev_notice');
		$menu['est_ar']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]['Circular'] = site_url('information/search_prev_circular');
		$menu['est_ar']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]['Minute'] = site_url('information/search_prev_minute');
		
		$menu['est_ar']["Information Management"]["View Notice, Circular or Minute"] = array();
		$menu['est_ar']["Information Management"]["View Notice, Circular or Minute"]['Notice'] = site_url('information/view_notice');
		$menu['est_ar']["Information Management"]["View Notice, Circular or Minute"]['Circular'] = site_url('information/view_circular');
		$menu['est_ar']["Information Management"]["View Notice, Circular or Minute"]['Minute'] = site_url('information/view_minute');
		
		
		//auth ==> hod
		$menu['hod']=array();
		$menu['hod']['Information Management']=array();
		$menu['hod']["Information Management"]["Post Notice, Circular or Minute"]=array();
		$menu['hod']["Information Management"]["Post Notice, Circular or Minute"]['Notice'] = site_url('information/post_notice');
		$menu['hod']["Information Management"]["Post Notice, Circular or Minute"]['Circular'] = site_url('information/post_circular');
		$menu['hod']["Information Management"]["Post Notice, Circular or Minute"]['Minute'] = site_url('information/post_minute');
		
		$menu['hod']["Information Management"]["Search(Edit) Notice, Circular or Minute"]=array();
		$menu['hod']["Information Management"]["Search(Edit) Notice, Circular or Minute"]['Notice'] = site_url('information/search_edit_notice');
		$menu['hod']["Information Management"]["Search(Edit) Notice, Circular or Minute"]['Circular'] = site_url('information/search_edit_circular');
		$menu['hod']["Information Management"]["Search(Edit) Notice, Circular or Minute"]['Minute'] = site_url('information/search_edit_minute');

		$menu['hod']["Information Management"]["Search Removed Notice, Circular or Minute"]=array();
		$menu['hod']["Information Management"]["Search Removed Notice, Circular or Minute"]['Notice'] = site_url('information/search_notice');
		$menu['hod']["Information Management"]["Search Removed Notice, Circular or Minute"]['Circular'] = site_url('information/search_circular');
		$menu['hod']["Information Management"]["Search Removed Notice, Circular or Minute"]['Minute'] = site_url('information/search_minute');
		
		$menu['hod']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]=array();
		$menu['hod']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]['Notice'] = site_url('information/search_prev_notice');
		$menu['hod']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]['Circular'] = site_url('information/search_prev_circular');
		$menu['hod']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]['Minute'] = site_url('information/search_prev_minute');
		
		$menu['hod']["Information Management"]["View Notice, Circular or Minute"] = array();
		$menu['hod']["Information Management"]["View Notice, Circular or Minute"]['Notice'] = site_url('information/view_notice');
		$menu['hod']["Information Management"]["View Notice, Circular or Minute"]['Circular'] = site_url('information/view_circular');
		$menu['hod']["Information Management"]["View Notice, Circular or Minute"]['Minute'] = site_url('information/view_minute');
		
		
		//auth ==> exam_dr
		$menu['exam_dr']=array();
		$menu['exam_dr']['Information Management']=array();
		$menu['exam_dr']["Information Management"]["Post Notice, Circular or Minute"]=array();
		$menu['exam_dr']["Information Management"]["Post Notice, Circular or Minute"]['Notice'] = site_url('information/post_notice');
		$menu['exam_dr']["Information Management"]["Post Notice, Circular or Minute"]['Circular'] = site_url('information/post_circular');
		$menu['exam_dr']["Information Management"]["Post Notice, Circular or Minute"]['Minute'] = site_url('information/post_minute');
		
		$menu['exam_dr']["Information Management"]["Search(Edit) Notice, Circular or Minute"]=array();
		$menu['exam_dr']["Information Management"]["Search(Edit) Notice, Circular or Minute"]['Notice'] = site_url('information/search_edit_notice');
		$menu['exam_dr']["Information Management"]["Search(Edit) Notice, Circular or Minute"]['Circular'] = site_url('information/search_edit_circular');
		$menu['exam_dr']["Information Management"]["Search(Edit) Notice, Circular or Minute"]['Minute'] = site_url('information/search_edit_minute');

		$menu['exam_dr']["Information Management"]["Search Removed Notice, Circular or Minute"]=array();
		$menu['exam_dr']["Information Management"]["Search Removed Notice, Circular or Minute"]['Notice'] = site_url('information/search_notice');
		$menu['exam_dr']["Information Management"]["Search Removed Notice, Circular or Minute"]['Circular'] = site_url('information/search_circular');
		$menu['exam_dr']["Information Management"]["Search Removed Notice, Circular or Minute"]['Minute'] = site_url('information/search_minute');
		
		$menu['exam_dr']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]=array();
		$menu['exam_dr']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]['Notice'] = site_url('information/search_prev_notice');
		$menu['exam_dr']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]['Circular'] = site_url('information/search_prev_circular');
		$menu['exam_dr']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]['Minute'] = site_url('information/search_prev_minute');
		
		$menu['exam_dr']["Information Management"]["View Notice, Circular or Minute"] = array();
		$menu['exam_dr']["Information Management"]["View Notice, Circular or Minute"]['Notice'] = site_url('information/view_notice');
		$menu['exam_dr']["Information Management"]["View Notice, Circular or Minute"]['Circular'] = site_url('information/view_circular');
		$menu['exam_dr']["Information Management"]["View Notice, Circular or Minute"]['Minute'] = site_url('information/view_minute');

		
		//auth ==> dt
		$menu['dt']=array();
		$menu['dt']['Information Management']=array();
		$menu['dt']["Information Management"]["Post Notice, Circular or Minute"]=array();
		$menu['dt']["Information Management"]["Post Notice, Circular or Minute"]['Notice'] = site_url('information/post_notice');
		$menu['dt']["Information Management"]["Post Notice, Circular or Minute"]['Circular'] = site_url('information/post_circular');
		$menu['dt']["Information Management"]["Post Notice, Circular or Minute"]['Minute'] = site_url('information/post_minute');
		
		$menu['dt']["Information Management"]["Search(Edit) Notice, Circular or Minute"]=array();
		$menu['dt']["Information Management"]["Search(Edit) Notice, Circular or Minute"]['Notice'] = site_url('information/search_edit_notice');
		$menu['dt']["Information Management"]["Search(Edit) Notice, Circular or Minute"]['Circular'] = site_url('information/search_edit_circular');
		$menu['dt']["Information Management"]["Search(Edit) Notice, Circular or Minute"]['Minute'] = site_url('information/search_edit_minute');

		$menu['dt']["Information Management"]["Search Removed Notice, Circular or Minute"]=array();
		$menu['dt']["Information Management"]["Search Removed Notice, Circular or Minute"]['Notice'] = site_url('information/search_notice');
		$menu['dt']["Information Management"]["Search Removed Notice, Circular or Minute"]['Circular'] = site_url('information/search_circular');
		$menu['dt']["Information Management"]["Search Removed Notice, Circular or Minute"]['Minute'] = site_url('information/search_minute');
		
		$menu['dt']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]=array();
		$menu['dt']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]['Notice'] = site_url('information/search_prev_notice');
		$menu['dt']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]['Circular'] = site_url('information/search_prev_circular');
		$menu['dt']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]['Minute'] = site_url('information/search_prev_minute');
		
		$menu['dt']["Information Management"]["View Notice, Circular or Minute"] = array();
		$menu['dt']["Information Management"]["View Notice, Circular or Minute"]['Notice'] = site_url('information/view_notice');
		$menu['dt']["Information Management"]["View Notice, Circular or Minute"]['Circular'] = site_url('information/view_circular');
		$menu['dt']["Information Management"]["View Notice, Circular or Minute"]['Minute'] = site_url('information/view_minute');
		
		
		//auth ==> dsw
		$menu['dsw']=array();
		$menu['dsw']['Information Management']=array();
		$menu['dsw']["Information Management"]["Post Notice, Circular or Minute"]=array();
		$menu['dsw']["Information Management"]["Post Notice, Circular or Minute"]['Notice'] = site_url('information/post_notice');
		$menu['dsw']["Information Management"]["Post Notice, Circular or Minute"]['Circular'] = site_url('information/post_circular');
		$menu['dsw']["Information Management"]["Post Notice, Circular or Minute"]['Minute'] = site_url('information/post_minute');
		
		$menu['dsw']["Information Management"]["Search(Edit) Notice, Circular or Minute"]=array();
		$menu['dsw']["Information Management"]["Search(Edit) Notice, Circular or Minute"]['Notice'] = site_url('information/search_edit_notice');
		$menu['dsw']["Information Management"]["Search(Edit) Notice, Circular or Minute"]['Circular'] = site_url('information/search_edit_circular');
		$menu['dsw']["Information Management"]["Search(Edit) Notice, Circular or Minute"]['Minute'] = site_url('information/search_edit_minute');

		$menu['dsw']["Information Management"]["Search Removed Notice, Circular or Minute"]=array();
		$menu['dsw']["Information Management"]["Search Removed Notice, Circular or Minute"]['Notice'] = site_url('information/search_notice');
		$menu['dsw']["Information Management"]["Search Removed Notice, Circular or Minute"]['Circular'] = site_url('information/search_circular');
		$menu['dsw']["Information Management"]["Search Removed Notice, Circular or Minute"]['Minute'] = site_url('information/search_minute');
		
		$menu['dsw']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]=array();
		$menu['dsw']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]['Notice'] = site_url('information/search_prev_notice');
		$menu['dsw']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]['Circular'] = site_url('information/search_prev_circular');
		$menu['dsw']["Information Management"]["Search Previous Versions of Notice, Circular or Minute"]['Minute'] = site_url('information/search_prev_minute');
		
		$menu['dsw']["Information Management"]["View Notice, Circular or Minute"] = array();
		$menu['dsw']["Information Management"]["View Notice, Circular or Minute"]['Notice'] = site_url('information/view_notice');
		$menu['dsw']["Information Management"]["View Notice, Circular or Minute"]['Circular'] = site_url('information/view_circular');
		$menu['dsw']["Information Management"]["View Notice, Circular or Minute"]['Minute'] = site_url('information/view_minute');
		
		
		//auth ==> deo
		$menu['deo']=array();
		$menu['deo']["Information Management"]["View Notice, Circular or Minute"] = array();
		$menu['deo']["Information Management"]["View Notice, Circular or Minute"]['Notice'] = site_url('information/view_notice');
		$menu['deo']["Information Management"]["View Notice, Circular or Minute"]['Circular'] = site_url('information/view_circular');
		$menu['deo']["Information Management"]["View Notice, Circular or Minute"]['Minute'] = site_url('information/view_minute');

		return $menu;
	}
}
/* End of file information_menu.php */
/* Location: mis/application/models/information/information_menu.php */