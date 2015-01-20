<?php
if (isset($prevnotice))
	echo '<h2><center>List of Previous Versions of Notice ID -> '.$prevnotice.'</center></h2>';
if(isset($firstLink))
	echo '<h2><center>'.$firstLink.'</br>Switch to: '.$secondLink.'</center></h2>';	
?>
 <table align="center">
	<tr>
		
		<th>Notice Number</th>
		<th width="300px">Notice Subject</th>
		
		
		<th>Posted On/ Edited On</th>
		<th width="150px">Issued By</th>
		<th width="100px">Revision Status</th>
		<th width="150px">Links</th>
	</tr>
	
	<?php
	foreach($notices as $key => $notice) { 
		echo '<tr>
				
				<td align="center">'.$notice->notice_no.'</td>
				<td>'.$notice->notice_sub.'</td>
				<td align="center">'.date_format( date_create($notice->posted_on),'d M Y g:i a').'</td>
				<td align="center">'.$notice->salutation.' '.$notice->first_name.' '.$notice->middle_name.' '.$notice->last_name.'<br>('.$notice->auth_name.')</td>
				<td align="center">';
					if ($notice->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised '.$notice->modification_value.'</font>';
		echo	'</td>
				<td align="center">'; ?>
				
				<a href="<?= base_url()."assets/files/information/notice/".$notice->notice_path ?>">Download File</a>
				<?php if ($notice->modification_value != 0 && isset($firstLink))
					  {
					  ?>
					  <br>and</br>
					  <a href="<?= base_url()."index.php/information/view_notice/prev/".$notice->notice_id ?>">Get Prev Versions</a>
					  <?php
					  }
					  ?>
				</td>
			</tr>
	<?php
	}
	?>
	</table>