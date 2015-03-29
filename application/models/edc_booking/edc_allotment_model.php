<?php
class Edc_allotment_model extends CI_Model
{
  function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
  function get_app_details($app_num)
  {
    $this->db->where('app_num',$app_num);
    $query = $this->db->get('edc_registration_details');
		return $query->result_array();
  }
  function get_allocated_rooms($app_num)
  {
    $this->db->where('app_num',$app_num);
    $query = $this->db->get('edc_booking_details');
		return $query->num_rows();
  }
  function get_floors($building)
  {
    $this->db->where('building',$building);
    $this->db->group_by('floor');
		$query = $this->db->order_by('floor','asc')->get('edc_room_details');
		return $query->result_array();
  }
  function get_rooms($building,$floor)
  {
    $this->db->where('building',$building);
    $this->db->where('floor',$floor);
		$query = $this->db->order_by('room_no','asc')->get('edc_room_details');
		return $query->result_array();
  }
  function check_unavail($check_in,$check_out)
  {
    $query = $this->db->query("SELECT edc_booking_details.room_id as room_id
          FROM edc_registration_details
          INNER JOIN edc_booking_details
          ON edc_registration_details.app_num = edc_booking_details.app_num
          WHERE ( edc_registration_details.check_out >=  '{$check_in}'
          AND edc_registration_details.check_in <=  '{$check_in}')
          OR edc_registration_details.check_in
          BETWEEN  '{$check_in}'
          AND  '{$check_out}'");
    return $query->result_array();
  }
  /*function booking_history()
  {
    foreach($result_avail_rooms as $row)
      $this->db->where('app_num',$row['app_num']);
    $query = $this->db->get('edc_booking_details');
    return $query->result_array();
  }*/
  function insert_booking_details($data)
  {
    $this->db->insert('edc_booking_details',$data);
  }
}
?>
