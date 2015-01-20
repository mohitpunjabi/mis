<?php
	foreach($faculty as $faculty_array)
	{
		echo '<option type="text" value="'.$faculty_array['id'].'" >'.$faculty_array['salutation'].' '.$faculty_array['first_name'].' '.$faculty_array['middle_name'].' '.$faculty_array['last_name'].'</option>';
	}
	//echo '<option>right there</option>';
?>
