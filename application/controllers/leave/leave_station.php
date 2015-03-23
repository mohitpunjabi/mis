<?php

/**
 * Author: Majeed Siddiqui (samsidx)
*/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Leave_station extends MY_Controller {


	// names in form field
	const START_DATE = 'leave_st_date';
	const END_DATE = 'return_st_date';
	const START_TIME = 'leave_st_time';
	const END_TIME = 'return_st_time';
	const PURPOSE = 'purpose';
	const ADDR = 'address';

        var $emp_id;
    function __construct() {
        parent::__construct(array('emp'));
        $this->emp_id = $this->session->userdata('id');
    }

    function index() {

    	$data = array(
    		'is_notification_on' => FALSE
    		);
        
    	if (isset($_POST['submit'])) {

    	}

        $this->drawHeader('Leave Station Form');
    	$this->load->view('leave/leave_station_view', $data);
        $this->drawFooter();
    }

    function isWeekend($date) {
    	$week_day = date('w', strtotime($date));

    	if ($week_day != 0 && $week_day != 6) {
    		return FALSE;
    	}

    	return TRUE;
    }

    function getLeaveLength($leave_start_date, $leave_end_date) {
    	$start_time = strtotime($leave_start_date);
    	$end_time = strtotime($leave_end_date);
    	$two_days = ($end_time - $start_time) / (24 * 60 * 60) + 1;

    	if ($two_days > 2 || $two_days <= 0) {
    		return FALSE;
    	}

    	return TRUE;
    }

    function insertIntoStationTable() {
    	$this->load->model('leave/leave_station', 'ls');
    	$this->ls->insert(
            $this->emp_id,
    		$_POST[Leave_station::START_DATE],
    		$_POST[Leave_station::END_DATE],
    		$_POST[Leave_station::START_TIME],
    		$_POST[Leave_station::END_TIME],
    		$_POST[Leave_station::PURPOSE],
    		$_POST[Leave_station::ADDR],
            NULL
    	);
    }  
}