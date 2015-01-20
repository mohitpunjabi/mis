<?php
if (isset($prevminute))
	echo '<h2><center>List of Previous Versions of minute ID -> '.$prevminute.'</center></h2>';
if(isset($firstLink))
	echo '<h2><center>'.$firstLink.'</br>Switch to: '.$secondLink.'</center></h2>';	
?>
 <table align="center">
	<tr>
		<th>Minute ID</th>
		<th>Minute Number</th>
		<th width="150px">Meeting Type</th>
		<th>Viewed By</th>
		<th width="100px">Date of Meeting</th>
		<th width="100px">Place of Meeting</th>
		<th width="200px">Issued By</th>
		<th>Posted On/ Edited On</th>
		<th width="80px">Valid Upto</th>
		<th>Modification Status</th>
		<th width="200px">Links</th>
	</tr>
	
	<?php
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
				<td align="center">'.$minute->date_of_meeting.'</td>
				<td align="center">'.$minute->place_of_meeting.'</td>
				<td align="center">'.$minute->auth_name.'</br>'.$minute->salutation.' '.$minute->first_name.' '.$minute->middle_name.' '.$minute->last_name.'</td>
				<td align="center">'.$minute->posted_on.'</td>
				<td align="center">'.$minute->valid_upto.'</td>
				<td align="center">';
					if ($minute->modification_value == 0 ) echo 'Unmodified'; else echo '<font color="red">Modified Version '.$minute->modification_value.'</font>';
		echo	'</td>
				<td align="center">'; ?>
				
				<a href="<?= base_url()."assets/files/information/minute/".$minute->minutes_path ?>">Download File</a>
				<?php if ($minute->modification_value != 0 && isset($firstLink))
					  {
					  ?>
					  <br>and</br>
					  <a href="<?= base_url()."/index.php/information/view_minute/prev/".$minute->minutes_id ?>">Get Prev Versions</a>
					  <?php
					  }
					  ?>
				</td>
			</tr>';
	<?php
	}
	?>
	</table>