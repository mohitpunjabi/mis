<?php
	if(!$res || $res->num_rows() == 0) $this->notification->drawNotification("No more notifications", "You do not have any unread notifications.");
	else {
		echo "<h2>Unread Notifications</h2>";
		foreach($res->result() as $row) {
			$this->notification->drawNotification($row->title, "<b>" . date("d M Y", strtotime($row->send_date)) . "</b>: " . $row->description ." <a href=\"".site_url($row->module_id."/".$row->path)."\">Know more &raquo;</a>");
		}
	}
?>