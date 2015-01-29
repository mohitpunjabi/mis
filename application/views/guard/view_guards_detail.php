<div id="print">
<h2><center>Personal Details of Current Guards</br>Switch to: <a href="<?= base_url()."index.php/guard/manage_guard/view/archived"?>">Archived List</a></center></h2>
 <table align="center">
	<tr>
		<th>Guard</th>
		<th>Photo</th>
		<th>Mobile</th>
		<th>Links</th>
		<th style="visibility:hidden";></th>
		<th>Guard</th>
		<th>Photo</th>
		<th>Mobile</th>
		<th>Links</th>
		<th style="visibility:hidden";></th>
		<th>Guard</th>
		<th>Photo</th>
		<th>Mobile</th>
		<th>Links</th>
	</tr>
	<?php
	$i=1;
	foreach($personal_details_of_guards as $key => $guard) { 
		if($i%3 ==1) echo '<tr>';
		echo '
				<td><center>'.$guard->firstname.' '.$guard->lastname.'</center></td>
				<td style="height: 60px; 
									width: 40px;
									background-image: url('.base_url().'assets/images/guard/'.$guard->photo.');
									background-size: auto 100%;
									background-position: 50% 50%;
									background-repeat: no-repeat;
								"></td>
				<td align="center">'.$guard->mobilenumber.'</td>
				<td align="center">';
				?>
					  <a href="<?= base_url()."index.php/guard/manage_guard/edit/".$guard->Regno ?>" onclick="return confirm('Are you sure you want to edit?')">Edit</a>
					  <br>and</br>
					  <a href="<?= base_url()."index.php/guard/manage_guard/remove/".$guard->Regno ?>" onclick="return confirm('Are you sure you want to remove?')">Remove</a>
				</td>
	<?php
		if($i%3 ==0) echo '</tr>'; else echo '<td style="visibility:hidden";></td>';
		$i=$i+1;
	}
	?>
	</table>
	</div>