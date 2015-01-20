<?php
if (isset($prevcircular))
	echo '<h2><center>List of Previous Versions of circular ID -> '.$prevcircular.'</center></h2>';
if(isset($firstLink))
	echo '<h2><center>'.$firstLink.'</br>Switch to: '.$secondLink.'</center></h2>';	
?>
 <table align="center">
	<tr>
	
		<th>Circular Number</th>
		<th width="300px">Circular Subject</th>
	
		
		<th>Posted On/ Edited On</th>
		<th width="150px">Issued By</th>
		<th width="100px">Revision Status</th>
		<th width="120px">Links</th>
	</tr>
	
	<?php
	foreach($circulars as $key => $circular) { 
		echo '<tr>
				
				<td align="center">'.$circular->circular_no.'</td>
				<td>'.$circular->circular_sub.'</td>
				
				<td align="center">'.date('d M Y g:i a',strtotime($circular->posted_on)+19800).'</td>
				<td align="center">'.$circular->salutation.' '.$circular->first_name.' '.$circular->middle_name.' '.$circular->last_name.'<br>('.$circular->auth_name.')</td>
				<td align="center">';
					if ($circular->modification_value == 0 ) echo 'Original'; else echo '<font color="red">Revised '.$circular->modification_value.'</font>';
		echo	'</td>
				<td align="center">'; ?>
				
				<a href="<?= base_url()."assets/files/information/circular/".$circular->circular_path ?>">Download File</a>
				<?php if ($circular->modification_value != 0 && isset($firstLink))
					  {
					  ?>
					  <br>and</br>
					  <a href="<?= base_url()."index.php/information/view_circular/prev/".$circular->circular_id ?>">Get Prev Versions</a>
					  <?php
					  }
					  ?>
				</td>
			</tr>
	<?php
	}
	?>
	</table>