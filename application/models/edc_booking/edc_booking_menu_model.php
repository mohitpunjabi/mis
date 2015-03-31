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
		$menu['ft']['EDC Booking']=array();
		$menu['ft']['EDC Booking']['Room Allotment Form'] = site_url('edc_booking/booking/form');
		$menu['ft']['EDC Booking']['Track Booking Status'] = site_url('edc_booking/booking/track_status');
		$menu['ft']['EDC Booking']['Booked History'] = site_url('edc_booking/booking/history');
				
		$menu['stu']['EDC Booking']=array();
		$menu['stu']['EDC Booking']['Room Allotment Form'] = site_url('edc_booking/booking');
		$menu['stu']['EDC Booking']['Track Booking Status'] = site_url('edc_booking/booking/track_status');
		$menu['stu']['EDC Booking']['Booked History'] = site_url('edc_booking/booking_history');

		//$auth=> Head of Department
//		$menu['hod']['EDC Booking']=array();
		$menu['hod']['EDC Booking'] = site_url('edc_booking/booking_request/hod');
		
		$menu['dsw']['EDC Booking'] = site_url('edc_booking/booking_request/dsw');

		$menu['pce']['EDC Booking'] = site_url('edc_booking/booking_request/pce');
 
		$menu['edc_ctk']['EDC Booking'] = array();
		$menu['edc_ctk']['EDC Booking']['Room Allotment'] = site_url('');
		$menu['edc_ctk']['EDC Booking']['Guest Details'] = site_url('edc_booking/guest_details');
		
		return $menu;
	}
}
