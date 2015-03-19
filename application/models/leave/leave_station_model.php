<?php

/**
 * Author: Majeed Siddiqui (samsidx)
*/

require_once 'result.php';

class Leave_station_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
//
//	function isVacationLeave($leave_start_date, $leave_end_date) {
//		$result = new Result();
//
//        $this->load->model('leave/leave_constants');
//        $sql = "SELECT * FROM ".Leave_constants::$TABLE_VACATION_DATES.
//               " WHERE $leave_start_date >= start_date and $leave_end_date <= end_date";
//
//        $query = $this->db->query($sql);
//
//        if ($query->num_rows() <= 0) {
//            $result->setResult(FALSE);
//            $result->addError("Not in vacation leave period.");
//        }
//
//   	    return $result;
//	}

    function insert($emp_id , $start_date , $end_date , $leaving_time , $returning_time , $purpose , $addr , $leave_id){
        $sql = "INSERT into TABLE leave_station values("
                . "$emp_id , $start_date , $end_date , $leaving_time , $returning_time , $purpose , $addr , $leave_id)";
            
        $this->db->query($sql);
     }
}