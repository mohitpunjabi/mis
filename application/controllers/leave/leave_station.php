<?php

/**
 * Author: Nishant Raj
*/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Leave_station extends MY_Controller {


	// names in form field
	const START_DATE = 'leave_st_date';
	const END_DATE = 'return_st_date';
    const START_TIME = 'st_leaving_time';
    const END_TIME = 'st_arrival_time';
	const PURPOSE = 'purpose';
	const ADDR = 'address';
    const NEXT_EMP = 'emp_name';

    var $emp_id;

    function __construct() {
        parent::__construct(array('emp'));
        $this->emp_id = $this->session->userdata('id');
        $this->addJS("leave/deo_query.js");
        $this->load->model("leave/leave_station_model", 'lsm');
    }

    function index() {
        $data['notification'] = false;
        $this->drawHeader('Leave Station Form');
        $this->load->view('leave/leave_station/leave_station_view', $data);
        $this->drawFooter();
    }

    function applyStationLeave()
    {
        $data = array();
        $data['notification'] = false;
        $leaving_date = $this->input->post(Leave_station::START_DATE);
        $leaving_time = $this->input->post(Leave_station::START_TIME);
        $arrival_date = $this->input->post(Leave_station::END_DATE);
        $arrival_time = $this->input->post(Leave_station::END_TIME);
        $purpose = $this->input->post(Leave_station::PURPOSE);
        $address = $this->input->post(Leave_station::ADDR);
        $next_emp = $this->input->post(Leave_station::NEXT_EMP);

        $current_time = date('Y-m-d');

        $leave_id = $this->lsm->get_station_leave_id($this->emp_id, $current_time, $leaving_date, $leaving_time, $arrival_date, $arrival_time);

        $leave_status = $this->lsm->get_station_leave_status($leave_id);
        if ($leave_id != NULL && $leave_status != Leave_constants::$CANCELED) {
            $data['notification'] = true;
            $data['string'] = " You have previously applied station leave for same time and date . Please try again";
        } else {
            $this->lsm->insert_station_leave_details($this->emp_id, $leaving_date, $leaving_time, $arrival_date, $arrival_time, $purpose, $address);
            $leave_id = $this->lsm->get_station_leave_id($this->emp_id, $current_time, $leaving_date, $leaving_time, $arrival_date, $arrival_time);
            $this->lsm->insert_station_leave_status($leave_id, $this->emp_id, $next_emp, Leave_constants::$PENDING);
        }

        $this->drawHeader('Leave Station Form');
        $this->load->view('leave/leave_station/leave_station_view', $data);
        $this->drawFooter();
    }

    function stationLeaveHistory()
    {

        $data = array();

        $data = $this->lsm->get_station_leave_history($this->emp_id);

        //var_dump($data);
        $this->drawHeader('Station Leave History');
        $this->load->view('leave/leave_station/station_leave_history_view', $data);
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