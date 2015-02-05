<div id="print">
<h2><center><?php echo $day.' Duty Chart'; ?></center></h2>
 <table align="center">
	<tr>
		<th>Duty Date</th>
		<th>Guard Name</th>
		<th class="print-no-display">Photo</th>
		<th>Post Name</th>
		<th>Shift</th>
		<th style="visibility:hidden";></th>
		<th>Duty Date</th>
		<th>Guard Name</th>
		<th class="print-no-display">Photo</th>
		<th>Post Name</th>
		<th>Shift</th>
	</tr>
	<?php
	$i=1;
	foreach($all_duties_chart as $key => $duty) { 
		if ($duty->shift == 'a') $shift = 'A';
		if ($duty->shift == 'b') $shift = 'B';
		if ($duty->shift == 'c') $shift = 'C';
		if($i%2 !=0) echo '<tr>';
		echo '
				<td align="center">'.date('d M Y',strtotime($duty->date)+19800).'</td>
				<td align="center">'.$duty->firstname.' '.$duty->lastname.'</td>
				<td style="height: 60px; 
									width: 40px;
									background-image: url('.base_url().'assets/images/guard/'.$duty->photo.');
									background-size: auto 100%;
									background-position: 50% 50%;
									background-repeat: no-repeat;
								   " class="print-no-display"></td>
				<td align="center">'.$duty->postname.'</td>
				<td align="center">'.$shift.'</td>
				';
		if($i%2 ==0) echo '</tr>'; else echo '<td style="visibility:hidden";></td>';
		$i=$i+1;
	}
	?>
	</table>
	
	</div>