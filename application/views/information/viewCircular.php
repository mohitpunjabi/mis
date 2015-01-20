<?php
if (isset($prevcircular))
	echo '<h2><center>List of Previous Versions of circular ID -> '.$prevcircular.'</center></h2>';
if(isset($firstLink))
	echo '<h2><center>'.$firstLink.'</br>Switch to: '.$secondLink.'</center></h2>';	
?>
 <table align="center">
	<tr>
		<th>Circular ID</th>
		<th>Circular Number</th>
		<th width="150px">Circular Subject</th>
		<th>Viewed By</th>
		<th width="80px">Valid Upto</th>
		<th>Posted On/ Edited On</th>
		<th width="150px">Issued By</th>
		<th>Modification Status</th>
		<th width="150px">Links</th>
	</tr>
	
	<?php
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
				<td align="center">'.$circular->valid_upto.'</td>
				<td align="center">'.$circular->posted_on.'</td>
				<td align="center">'.$circular->auth_name.'</br>'.$circular->salutation.' '.$circular->first_name.' '.$circular->middle_name.' '.$circular->last_name.'</td>
				<td align="center">';
					if ($circular->modification_value == 0 ) echo 'Unmodified'; else echo '<font color="red">Modified Version '.$circular->modification_value.'</font>';
		echo	'</td>
				<td align="center">'; ?>
				
				<a href="<?= base_url()."assets/files/information/circular/".$circular->circular_path ?>">Download File</a>
				<?php if ($circular->modification_value != 0 && isset($firstLink))
					  {
					  ?>
					  <br>and</br>
					  <a href="<?= base_url()."/index.php/information/view_circular/prev/".$circular->circular_id ?>">Get Prev Versions</a>
					  <?php
					  }
					  ?>
				</td>
			</tr>';
	<?php
	}
	?>
	</table>