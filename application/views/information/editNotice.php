<h2><center>List of Current Notices posted by You</center></h2>
 <table align="center">
	<tr>
		<th>Notice ID</th>
		<th>Notice Number</th>
		<th width="250px">Notice Subject</th>
		<th>Viewed By</th>
		<th width="80px">Last Date</th>
		<th>Posted On/ Edited On</th>
	<!--	<th width="150px">Issued By</th>  -->
		<th>Revision Status</th>
		<th width="120px">Links</th>
	</tr>
	
	<?php
	//<td align="center">'.$notice->auth_name.'</br>'.$notice->salutation.' '.$notice->first_name.' '.$notice->middle_name.' '.$notice->last_name.'</td>
	
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
				<td align="center">'.date_format( date_create($notice->last_date),'d M Y').'</td>
				<td align="center">'.date('d M Y g:i a',strtotime($notice->posted_on)+19800).'</td>
				<td align="center">';
					if ($notice->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised '.$notice->modification_value.'</font>';
		echo	'</td>
				<td align="center">'; ?>
				
				<a href="<?= base_url()."assets/files/information/notice/".$notice->notice_path ?>">Download File</a>
				<br>and</br>
				<a href="<?= base_url()."index.php/information/edit_notice/index/".$auth_id.'/'.$notice->notice_id ?>">Edit</a>
				</td>
			</tr>
	<?php
	}
	?>
	</table>