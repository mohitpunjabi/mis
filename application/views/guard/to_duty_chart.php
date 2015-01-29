<div id="print">
<?php   
foreach($all_duties_chart as $key => $duty) { 
	$date = date('d M Y',strtotime($duty->date)+19800);
	break;
}
?>
<h2><center><?php echo $day.' Duty Chart ( '.$date.' )'; ?></center></h2>
 <table align="center">
	<tr>
		<th>Guard Name</th>
		<th>Photo</th>
		<th>Post Name</th>
		<th>Shift</th>
		<th>Link</th>
		<th style="visibility:hidden"; width="30px"></th>
		<th>Guard Name</th>
		<th>Photo</th>
		<th>Post Name</th>
		<th>Shift</th>
		<th>Link</th>
	</tr>
	<?php
	$i=1;
	foreach($all_duties_chart as $key => $duty) { 
		if ($duty->shift == 'a') $shift = 'A';
		if ($duty->shift == 'b') $shift = 'B';
		if ($duty->shift == 'c') $shift = 'C';		
		if($i%2 !=0) echo '<tr>';
		echo '
				<td>'.$duty->firstname.' '.$duty->lastname.'</td>
				<td style="height: 60px; 
									width: 40px;
									background-image: url('.base_url().'assets/images/guard/'.$duty->photo.');
									background-size: auto 100%;
									background-position: 50% 50%;
									background-repeat: no-repeat;
								"></td>
				<td align="center">'.$duty->postname.'</td>
				<td align="center">'.$shift.'</td>
				<td align="center">';  ?>
				<a href="<?= base_url()."index.php/guard/duties/replace/".$duty->Regno."/".$duty->post_id."/".$duty->shift."/".$duty->date ?>" onclick="return confirm('Are you sure you want to replace?')">Replace</a></td>
				
	<?php  if($i%2 ==0) echo '</tr>'; else echo '<td style="visibility:hidden";></td>';
		$i++;
	}
	?>
	</table>
	
	</div>