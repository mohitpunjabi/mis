<?php
if (isset($prevminute))
	echo '<h2><center>List of Previous Versions of Minutes ID -> '.$prevminute.'</center></h2>';
if(isset($firstLink))
	echo '<h2><center>'.$firstLink.'</br>Switch to: '.$secondLink.'</center></h2>';	
?>
 <table align="center">
	<tr>
		
		<th>Minutes Number</th>
		<th width="100px">Meeting Type</th>
		
		<th width="90px">Meeting Date</th>
		<th width="100px">Meeting Place</th>
		<th width="130px">Issued By</th>
		<th>Posted On/ Edited On</th>
		
		<th width="100px">Revision Status</th>
		<th width="120px">Links</th>
	</tr>
	
	<?php
	foreach($minutes as $key => $minute) { 
		echo '<tr>
				
				<td align="center">'.$minute->minutes_no.'</td>
				<td align="center">'.$minute->meeting_type.'</td>
				<td align="center">'.date_format( date_create($minute->date_of_meeting),'d M Y').'</td>
				<td align="center">'.$minute->place_of_meeting.'</td>
				<td align="center">'.$minute->salutation.' '.$minute->first_name.' '.$minute->middle_name.' '.$minute->last_name.'</br>('.$minute->auth_name.')</td>
				<td align="center">'.date('d M Y g:i a',strtotime($minute->posted_on)+19800).'</td>
			
				<td align="center">';
					if ($minute->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised '.$minute->modification_value.'</font>';
		echo	'</td>
				<td align="center">'; ?>
				
				<a href="<?= base_url()."assets/files/information/minute/".$minute->minutes_path ?>">Download File</a>
				<?php if ($minute->modification_value != 0 && isset($firstLink))
					  {
					  ?>
					  <br>and</br>
					  <a href="<?= base_url()."index.php/information/view_minute/prev/".$minute->minutes_id ?>">Get Prev Versions</a>
					  <?php
					  }
					  ?>
				</td>
			</tr>
	<?php
	}
	?>
	</table>