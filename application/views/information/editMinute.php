<h2><center>List of Current Meeting Minutes posted by You</center></h2>
 <table align="center">
	<tr>
		<th>Minute ID</th>
		<th width="95px">Minute Number</th>
		<th width="85px">Meeting Type</th>
		<th>Viewed By</th>
		<th width="80px">Meeting Date</th>
		<th width="90px">Meeting Place</th>
	<!--	<th width="200px">Issued By</th> -->
		<th>Posted/ Edited On</th>
		<th width="70px">Valid Upto</th>
		<th>Revision Status</th>
		<th width="90px">Links</th>
	</tr>
	
	<?php
	//<td align="center">'.$minute->auth_name.'</br>'.$minute->salutation.' '.$minute->first_name.' '.$minute->middle_name.' '.$minute->last_name.'</td>
	
	foreach($minutes as $key => $minute) { 
		echo '<tr>
				<td align="center">'.$minute->minutes_id.'</td>
				<td align="center">'.$minute->minutes_no.'</td>
				<td align="center">'.$minute->meeting_type.'</td>
				<td align="center">';
					if( $minute->meeting_cat == 'emp') echo 'Employee';
					else if($minute->meeting_cat == 'all') echo 'All';
					else echo 'Student';
		echo	'</td>
				<td align="center">'.date_format( date_create($minute->date_of_meeting),'d M Y').'</td>
				<td align="center">'.$minute->place_of_meeting.'</td>
				<td align="center">'.date('d M Y g:i a',strtotime($minute->posted_on)+19800).'</td>
				<td align="center">'.date_format( date_create($minute->valid_upto),'d M Y').'</td>
				<td align="center">';
					if ($minute->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised '.$minute->modification_value.'</font>';
		echo	'</td>
				<td align="center">'; ?>
				
				<a href="<?= base_url()."assets/files/information/minute/".$minute->minutes_path ?>">Download File</a>
				<br>and</br>
				<a href="<?= base_url()."index.php/information/edit_minute/index/".$auth_id.'/'.$minute->minutes_id  ?>">Edit</a>
				</td>
			</tr>
	<?php
	}
	?>
	</table>