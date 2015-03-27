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
        $this->load->model('employee_model');
        $this->load->model('user_model', 'um');
        $this->load->model('departments_model');
        $this->load->model('leave/leave_users_details_model', 'ludm');
        $this->load->model('designations_model');
        $this->load->model('employee_model');
        $this->load->model('leave/leave_bal_model', 'lbm');
        $this->load->model('leave/leave_constants');
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
            $data['type'] = 'danger';
            $data['string'] = " You have previously applied station leave for same time and date . Please try again";
        } else if ($arrival_date < $leaving_date) {
            $data['notification'] = true;
            $data['type'] = 'danger';
            $data['string'] = " Arrival date should be greater than or equal to Leaving date";
        } else {

            $this->lsm->insert_station_leave_details($this->emp_id, $leaving_date, $leaving_time, $arrival_date, $arrival_time, $purpose, $address);
            $leave_id = $this->lsm->get_station_leave_id($this->emp_id, $current_time, $leaving_date, $leaving_time, $arrival_date, $arrival_time);
            $this->lsm->insert_station_leave_status($leave_id, $this->emp_id, $next_emp, Leave_constants::$PENDING);

            $data['notification'] = true;
            $data['type'] = 'success';
            $data['string'] = 'Your leave have been Applied successfully and sent to selected employee';
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


    function pendingStationLeaveStatus()
    {

        $data = $this->lsm->get_pending_station_leave($this->emp_id);
//        var_dump($data);
        $this->drawHeader('Pending Leave for Approval/Cancel/Forward');
        $this->load->view('leave/leave_station/pending_station_leave', $data);
        $this->drawFooter();
    }

    /**
     * @param $leave_id
     * @param $next_emp_id
     * @param $emp_id
     */
    function station_leave_approve($leave_id, $next_emp_id, $emp_id, $rqst_type)
    {
        $data = array();
        $details = $this->employee_model->getById($emp_id);
        $data['type'] = $rqst_type;
        $data['emp'] = $details;
        $data['img_path'] = $emp_id . "/";
        $data['img_path'] .= $this->um->getPhotoById($emp_id);
        $data['leave_id'] = $leave_id;
        $data['next_emp'] = $next_emp_id;
        $data['emp_id'] = $emp_id;
        $data['leave_details'] = $this->lsm->get_station_leave_by_id($leave_id);
        //$this->insert_station_leave_status($leave_id , $next_emp_id , $next_emp_id , Leave_constants::$APPROVED );
        $this->drawHeader('Leave Approved');
        $this->load->view('leave/leave_station/leave_station_approval_view', $data);
        $this->drawFooter();

    }

    function cancelStationLeave()
    {

        $data = array();
        $data = $this->lsm->getCancellableStationLeave($this->emp_id);

        $this->drawHeader('Leave Cancellation Page');
        $this->load->view('leave/leave_station/cancel_station_leave_view', $data);
        $this->drawFooter();
    }

    /**
     * @param $leave_id
     * @param $cur_emp
     * @param $next_emp
     * @param $status
     */
    function insert_station_leave_status($leave_id, $cur_emp, $next_emp, $status)
    {
        var_dump($leave_id);
        $this->lsm->insert_station_leave_status($leave_id, $cur_emp, $next_emp, $status);
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