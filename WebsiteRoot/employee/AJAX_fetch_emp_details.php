<?php
	require_once("../Includes/Auth.php");
	require_once("../Includes/FeedbackConfigSQL.php");
	auth('deo');
	
	if(isset($_GET['emp_id'])) {
		$emp_id = strclean($_GET['emp_id']);
		$res = $fb_mysqli->query("select salutation, first_name, middle_name, last_name, design, email, ph_no, research_int, sex, category, physically_challenged from feedback_faculty where emp_id = '$emp_id'");
		if($res && $res->num_rows == 1) {
			$row = $res->fetch_assoc();
			echo "({";
			foreach($row as $key => $val) {
				echo "'$key': '$val'";
				if($key != 'physically_challenged') echo ", ";
			}
			echo "})";
		}
	}