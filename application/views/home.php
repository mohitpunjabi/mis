<?php

	$res = $this->db->query("SELECT * from user_notifications
						   WHERE user_to = '".$this->session->userdata('id')."' AND
						   ISNULL(rec_date)
						   ORDER BY send_date DESC");

	if(!$res || $res->num_rows() == 0) $this->notification->drawNotification("No more notifications", "You do not have any unread notifications.");
	else {
		echo "<h2>Unread Notifications</h2>";
		foreach($res->result() as $row) {

			$this->notification->drawNotification(ucwords($row->module_id) . ": " . $row->title, "<b>" . date("d M Y", strtotime($row->send_date)) . "</b>: " . $row->description . " <a href=\"".site_url($row->module_id."/".$row->path)."\">Know more &raquo;</a>", $row->type);
		}
	}
	echo '<h2>The session variables :</h2>';
	echo '<pre>';
	var_export($this->session->all_userdata());
	echo '</pre>';

?>