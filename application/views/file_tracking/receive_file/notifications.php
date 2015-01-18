<?php
//	echo "<h2><a href = \"".site_url('employee/add')."\" >Add Employee</a></h2>";
//	if($entry)
//		echo "(Continue with Employee ".$entry->id.")";
?>
<!--<br>
<h2><a href = "<?php //echo site_url('file_tracking/send_running_file/validate_track_num/'.$file_id); ?>" >Send Running File</a></h2>
<br>
<h2><a href = "<?php //echo site_url('file_tracking/close_file'); ?>" >Close File</a></h2>
-->
<?php

	// $password = 'p';
	// $password = $this->authorization->strclean($password);
	// echo $password.'<br>';
	// echo $this->authorization->encode_password($password,'2014-12-22 14:30:18');
	// print_r($this->session->all_userdata());

?>
<?php
	if(!$res || $res->num_rows() == 0) $this->notification->drawNotification("No more notifications", "You do not have any unread notifications.");
	else {
		echo "<h2>Unread Notifications</h2>";
		foreach($res->result() as $row) {
			echo 'hi';
			echo $row->path;
			$this->notification->drawNotification($row->title, "<b>" . date("d M Y", strtotime($row->send_date)) . "</b>: " . $row->description ." <a href=\"".site_url($row->module_id."/".$row->path)."\">Know more &raquo;</a>");
		}
	}
?>