<h2><center>List of Current Circulars posted by You</center></h2>
 <table align="center">
	<tr>
		<th>Circular ID</th>
		<th>Circular Number</th>
		<th width="220px">Circular Subject</th>
		<th>Viewed By</th>
		<th width="80px">Valid Upto</th>
		<th>Posted On/ Edited On</th>
	<!--	<th width="150px">Issued By</th> -->
		<th>Revision Status</th>
		<th width="120px">Links</th>
	</tr>
	
	<?php
	//<td align="center">'.$circular->auth_name.'</br>'.$circular->salutation.' '.$circular->first_name.' '.$circular->middle_name.' '.$circular->last_name.'</td>
	
	foreach($circulars as $key => $circular) { 
		echo '<tr>
				<td align="center">'.$circular->circular_id.'</td>
				<td align="center">'.$circular->circular_no.'</td>
				<td>'.$circular->circular_sub.'</td>
				<td align="center">';
					if( $circular->circular_cat == 'emp') echo 'Employee';
					else if($circular->circular_cat == 'all') echo 'All';
					else echo 'Student';
		echo	'</td>
				<td align="center">'.date_format( date_create($circular->valid_upto),'d M Y').'</td>
				<td align="center">'.date('d M Y g:i a',strtotime($circular->posted_on)+19800).'</td>
				<td align="center">';
					if ($circular->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised '.$circular->modification_value.'</font>';
		echo	'</td>
				<td align="center">'; ?>
				
				<a href="<?= base_url()."assets/files/information/circular/".$circular->circular_path ?>">Download File</a>
				<br>and</br>
				<a href="<?= base_url()."index.php/information/edit_circular/index/".$auth_id.'/'.$circular->circular_id ?>">Edit</a>
				</td>
			</tr>
	<?php
	}
	?>
	</table>