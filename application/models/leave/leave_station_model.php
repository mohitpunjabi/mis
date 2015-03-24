<?php

/**
 * Author: Nishant Raj
*/

require_once 'result.php';
require_once 'leave_constants.php';
class Leave_station_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

    function insert_station_leave_details($emp_id, $leaving_date, $leaving_time, $arrival_date, $arrival_time, $purpose, $addr)
    {

        $leaving_date = strtotime($leaving_date);
        $leaving_date = date('Y-m-d', $leaving_date);


        $arrival_date = strtotime($arrival_date);
        $arrival_date = date('Y-m-d', $arrival_date);

        $current_date = date("Y-m-d");
        $sql = "INSERT INTO " . Leave_constants::$TABLE_STATION_LEAVE .
            " VALUES('','$emp_id','$current_date', '$leaving_date' , '$leaving_time' , '$arrival_date' , '$arrival_time' , '$purpose' , '$addr')";

        $this->db->query($sql);
    }

    function insert_station_leave_status($leave_id, $current_emp, $next_emp, $status)
    {

        $sql = "INSERT INTO " . Leave_constants::$TABLE_STATION_LEAVE_STATUS .
            " VALUES($leave_id , '$current_emp','$next_emp',$status ,'')";

        $this->db->query($sql);
    }

    function get_station_leave_id($emp_id, $applying_date, $leaving_date, $leaving_time, $arrival_date, $arrival_time)
    {

        $leaving_date = strtotime($leaving_date);
        $leaving_date = date('Y-m-d', $leaving_date);

        $arrival_date = strtotime($arrival_date);
        $arrival_date = date('Y-m-d', $arrival_date);

        $applying_date = strtotime($applying_date);
        $applying_date = date('Y-m-d', $applying_date);


        $sql = "SELECT id , emp_id , leaving_date , leaving_time , arrival_date , arrival_time " .
            "FROM " . Leave_constants::$TABLE_STATION_LEAVE .
            " WHERE emp_id = '$emp_id' and leaving_date = '$leaving_date' and leaving_time = '$leaving_time'
                 and arrival_date = '$arrival_date' and arrival_time = '$arrival_time' and applying_date = '$applying_date'";

        $result = $this->db->query($sql)->result_array();

        foreach ($result as $row) {

            return $row['id'];
        }
    }

    function get_station_leave_history($emp_id)
    {

        $sql = "SELECT * FROM " . Leave_constants::$TABLE_STATION_LEAVE .
            " WHERE emp_id = '$emp_id'";

        $result = $this->db->query($sql)->result_array();
        $i = 0;
        $data = array();
        $data['data'] = NULL;
        foreach ($result as $row) {
            $data['data'][$i] = array();
            $data['data'][$i]['id'] = $row['id'];
            $data['data'][$i]['applying_date'] = $row['applying_date'];
            $data['data'][$i]['leaving_date'] = $row['leaving_date'];
            $data['data'][$i]['leaving_time'] = $row['leaving_time'];
            $data['data'][$i]['arrival_time'] = $row['arrival_time'];
            $data['data'][$i]['arrival_date'] = $row['arrival_date'];
            $data['data'][$i]['purpose'] = $row['purpose'];
            $data['data'][$i]['addr'] = $row['addr'];
            $temp = $this->get_station_leave_status($row['id']);
            $data['data'][$i]['status'] = $temp['status'];
            $data['data'][$i]['fwd_by'] = $temp['fwd_by'];
            $data['data'][$i]['fwd_to'] = $this->get_user_name_by_id($temp['fwd_to']);
            $data['data'][$i]['fwd_at'] = $temp['fwd_at'];
            $lv_date = strtotime($row['leaving_date']);
            $rt_date = strtotime($row['arrival_date']);
            $period = (($rt_date - $lv_date) / (24 * 60 * 60)) + 1;
            $data['data'][$i]['period'] = $period;
            $i++;
        }
        return $data;
    }

    function get_station_leave_status($leave_id)
    {

        $sql = "SELECT * FROM " . Leave_constants::$TABLE_STATION_LEAVE_STATUS .
            " WHERE id = '$leave_id' ORDER BY time DESC";

        $result = $this->db->query($sql)->result_array();

        $data = array();
        foreach ($result as $row) {
            $data['status'] = $row['status'];
            $data['fwd_by'] = $row['current'];
            $data['fwd_to'] = $row['next'];
            $data['fwd_at'] = $row['time'];
            return $data;
        }
    }

    function get_user_name_by_id($emp_id)
    {

        $sql = "SELECT * FROM user_details WHERE id = '$emp_id'";

        $result = $this->db->query($sql)->result_array();

        foreach ($result as $row) {
            $salutation = $row['salutation'];
            $f_name = $row['first_name'];
            $m_name = $row['middle_name'];
            $l_name = $row['last_name'];

            $name = "$salutation " . "$f_name " . "$m_name " . "$l_name";
            return $name;
        }
    }
}