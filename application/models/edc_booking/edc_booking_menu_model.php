<?php

class Edc_booking_menu_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getMenu()
	{
		$menu=array();
		//auth ==> Employee
		$menu['emp']['EDC Booking']=array();
		$menu['emp']['EDC Booking']['Room Allotment Form'] = site_url('edc_booking/booking');
		$menu['emp']['EDC Booking']['Track Booking Status'] = site_url('edc_booking/track_status');
		$menu['emp']['EDC Booking']['Booked History'] = site_url('edc_booking/booking_history');
				
		//$auth=> Head of Department
//		$menu['hod']['EDC Booking']=array();
		$menu['hod']['EDC Booking'] = site_url('edc_booking/hod');
		
		//$auth=> Head of Department
//		$menu['hod']['EDC Booking']=array();
		$menu['pce']['EDC Booking'] = site_url('edc_booking/pce');

		return $menu;
	}
}
