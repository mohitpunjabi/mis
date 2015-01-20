<h2><center>List of Current Notices posted by You</center></h2>
 <table align="center">
	<tr>
		<th>Notice ID</th>
		<th>Notice Number</th>
		<th width="150px">Notice Subject</th>
		<th>Viewed By</th>
		<th width="80px">Last Date</th>
		<th>Posted On/ Edited On</th>
		<th width="150px">Issued By</th>
		<th>Modification Status</th>
		<th width="150px">Links</th>
	</tr>
	
	<?php
	foreach($notices as $key => $notice) { 
		echo '<tr>
				<td align="center">'.$notice->notice_id.'</td>
				<td align="center">'.$notice->notice_no.'</td>
				<td>'.$notice->notice_sub.'</td>
				<td align="center">';
					if( $notice->notice_cat == 'emp') echo 'Employee';
					else if($notice->notice_cat == 'all') echo 'All';
					else echo 'Student';
		echo	'</td>
				<td align="center">'.$notice->last_date.'</td>
				<td align="center">'.$notice->posted_on.'</td>
				<td align="center">'.$notice->auth_name.'</br>'.$notice->salutation.' '.$notice->first_name.' '.$notice->middle_name.' '.$notice->last_name.'</td>
				<td align="center">';
					if ($notice->modification_value == 0 ) echo 'Unmodified'; else echo '<font color="red">Modified Version '.$notice->modification_value.'</font>';
		echo	'</td>
				<td align="center">'; ?>
				
				<a href="<?= base_url()."assets/files/information/notice/".$notice->notice_path ?>">Download File</a>
				<br>and</br>
				<a href="<?= base_url()."/index.php/information/edit_notice/index/".$auth_id.'/'.$notice->notice_id ?>">Edit</a>
				</td>
			</tr>';
	<?php
	}
	?>
	</table>