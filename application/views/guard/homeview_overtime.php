<div id="print">
<?php
echo '<center>';
if(isset($details_of_guards_at_a_post))
{
	$postname='';
	foreach($details_of_guards_at_a_post as $row)
	{
		$postname = $row->postname;
	}
	echo '<center><h2>Details of Guards at '.$postname.' Post</h2></center>';
	echo '<br>';
	echo '<table>
			<tr>
				<th>Guard Name</th>
				<th class="print-no-display">Photo</th>
				<th>Time</th>
				<th>Duty Date</th>
				<th style="visibility:hidden";></th>
				<th>Guard Name</th>
				<th class="print-no-display">Photo</th>
				<th>Time</th>
				<th>Duty Date</th>
				<th style="visibility:hidden";></th>
				<th>Guard Name</th>
				<th class="print-no-display">Photo</th>
				<th>Time</th>
				<th>Duty Date</th>
			</tr>';
			$i=1;
			foreach($details_of_guards_at_a_post as $row)
			{
				if(ceil($row->from_time) == floor($row->from_time))
					$from_time = floor($row->from_time).':00';
				else
					$from_time = floor($row->from_time).':30';
				
				if(ceil($row->to_time) == floor($row->to_time))
					$to_time = floor($row->to_time).':00';
				else
					$to_time = floor($row->to_time).':30';

				
				if($i%3 ==1) echo '<tr>';
				echo '
						<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
						<td style="height: 60px; 
									width: 40px;
									background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
									background-size: auto 100%;
									background-position: 50% 50%;
									background-repeat: no-repeat;
								" class="print-no-display"></td>
						<td><center>'.$from_time.'-'.$to_time.'</center></td>
						<td><center>'.date('d M Y',strtotime($row->date)+19800).'</center></td>	
					';
				if($i%3 ==0) echo '</tr>'; else echo '<td style="visibility:hidden";></td>';
				$i=$i+1;
			}
	echo'</table>';
}

else if(isset($details_of_guards_at_a_date))
{
	echo '<center><h2>Details of Guards on '.date('d M Y',strtotime($selectdate)+19800).'</h2></center>';
	echo '<br>';
	echo '<table>
			<tr>
				<th>Post Name</th>
				<th>Guard</th>
				<th class="print-no-display">Photo</th>
				<th>Time</th>
				<th style="visibility:hidden";></th>
				<th>Post Name</th>
				<th>Guard</th>
				<th class="print-no-display">Photo</th>
				<th>Time</th>
				<th style="visibility:hidden";></th>
				<th>Post Name</th>
				<th>Guard</th>
				<th class="print-no-display">Photo</th>
				<th>Time</th>
			</tr>';
			$i=1;
			foreach($details_of_guards_at_a_date as $row)
			{
				if(ceil($row->from_time) == floor($row->from_time))
					$from_time = floor($row->from_time).':00';
				else
					$from_time = floor($row->from_time).':30';
				
				if(ceil($row->to_time) == floor($row->to_time))
					$to_time = floor($row->to_time).':00';
				else
					$to_time = floor($row->to_time).':30';

				if($i%3 ==1) echo '<tr>';
				echo '
						<td><center>'.$row->postname.'</center></td>
						<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
						<td style="height: 60px; 
									width: 40px;
									background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
									background-size: auto 100%;
									background-position: 50% 50%;
									background-repeat: no-repeat;
								" class="print-no-display"></td>
						<td><center>'.$from_time.'-'.$to_time.'</center></td>
					';
				if($i%3 ==0) echo '</tr>'; else echo '<td style="visibility:hidden";></td>';
				$i=$i+1;
			}
	echo'</table>';		
}
else if(isset($details_of_guard_in_a_range))
{
	echo '<center><h2>Duty of '.$details_of_a_guard['firstname'].' '.$details_of_a_guard['lastname'].' from '.date('d M Y',strtotime($fromdateg)+19800).' to '.date('d M Y',strtotime($todateg)+19800).'</h2></center>';
	echo '<br><center><img src="'.base_url().'assets/images/guard/'.$details_of_a_guard['photo'].'" width="80px" height="80px"/></center></br>';
	echo 'Total Number of working hours '.$working_hours;
	echo '<br>';
	if(count($details_of_guard_in_a_range) > 0 && count($details_of_guard_in_a_range) <3) 
	{
		echo '<table>
				<tr>
					<th>Duty Date</th>
					<th>Post Name</th>
					<th>Time</th>
				</tr>';
				foreach($details_of_guard_in_a_range as $row)
				{
					if(ceil($row->from_time) == floor($row->from_time))
						$from_time = floor($row->from_time).':00';
					else
						$from_time = floor($row->from_time).':30';
				
					if(ceil($row->to_time) == floor($row->to_time))
						$to_time = floor($row->to_time).':00';
					else
						$to_time = floor($row->to_time).':30';

					echo '<tr>
							<td><center>'.date('d M Y',strtotime($row->date)+19800).'</center></td>
							<td><center>'.$row->postname.'</center></td>
							<td><center>'.$from_time.'-'.$to_time.'</center></td>
						</tr>';
				}
		echo'</table>';
	}
	else if(count($details_of_guard_in_a_range) > 2)
	{
		echo '<table>
				<tr>
					<th>Duty Date</th>
					<th>Post Name</th>
					<th>Time</th>
					<th style="visibility:hidden";></th>
					<th>Duty Date</th>
					<th>Post Name</th>
					<th>Time</th>
					<th style="visibility:hidden";></th>
					<th>Duty Date</th>
					<th>Post Name</th>
					<th>Time</th>
				</tr>';
				$i=1;
				foreach($details_of_guard_in_a_range as $row)
				{
					if(ceil($row->from_time) == floor($row->from_time))
						$from_time = floor($row->from_time).':00';
					else
						$from_time = floor($row->from_time).':30';
				
					if(ceil($row->to_time) == floor($row->to_time))
						$to_time = floor($row->to_time).':00';
					else
						$to_time = floor($row->to_time).':30';

					if($i%3 ==1) echo '<tr>';
					echo '
							<td><center>'.date('d M Y',strtotime($row->date)+19800).'</center></td>
							<td><center>'.$row->postname.'</center></td>
							<td><center>'.$from_time.'-'.$to_time.'</center></td>
						';
					if($i%3 ==0) echo '</tr>'; else echo '<td style="visibility:hidden";></td>';
					$i=$i+1;	
				}
		echo'</table>';
	}
}

else if(isset($details_of_guards_in_a_range))
{
	echo '<center><h2>Details of Guards from '.date('d M Y',strtotime($fromdate)+19800).' to '.date('d M Y',strtotime($todate)+19800).'</h2></center>';
	echo '<br>';
	echo '<table>
			<tr>
				<th>Post Name</th>
				<th>Guard Name</th>
				<th class="print-no-display">Photo</th>
				<th>Time</th>
				<th>Duty Date</th>
				<th style="visibility:hidden";></th>
				<th>Post Name</th>
				<th>Guard Name</th>
				<th class="print-no-display">Photo</th>
				<th>Time</th>
				<th>Duty Date</th>
			</tr>';
			$i=1;
			foreach($details_of_guards_in_a_range as $row)
			{
				if(ceil($row->from_time) == floor($row->from_time))
					$from_time = floor($row->from_time).':00';
				else
					$from_time = floor($row->from_time).':30';
				
				if(ceil($row->to_time) == floor($row->to_time))
					$to_time = floor($row->to_time).':00';
				else
					$to_time = floor($row->to_time).':30';

				if($i%2 !=0) echo '<tr>';
				echo '
						<td><center>'.$row->postname.'</center></td>
						<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
						<td style="height: 60px; 
									width: 40px;
									background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
									background-size: auto 100%;
									background-position: 50% 50%;
									background-repeat: no-repeat;
								" class="print-no-display"></td>
						<td><center>'.$from_time.'-'.$to_time.'</center></td>
						<td><center>'.date('d M Y',strtotime($row->date) + 19800).'</center></td>
					';
				if($i%2 ==0) echo '</tr>'; else echo '<td style="visibility:hidden";></td>';
				$i=$i+1;
			}
	echo'</table>';
}
else if(isset($details_of_guards_at_a_post_in_a_range))
{
	$postname='';
	foreach($details_of_guards_at_a_post_in_a_range as $row)
	{
		$postname = $row->postname;
	}
	echo '<center><h2>Details of Guards from '.date('d M Y',strtotime($fromdatep)+19800).' to '.date('d M Y',strtotime($todatep)+19800).' at '.$postname.' Post</h2></center>';
	echo '<br>';
	if(count($details_of_guards_at_a_post_in_a_range) > 2)
	{
		echo '<table>
				<tr>
					<th>Guard</th>
					<th class="print-no-display">Photo</th>
					<th>Time</th>
					<th>Duty Date</th>
					<th style="visibility:hidden";></th>
					<th>Guard</th>
					<th class="print-no-display">Photo</th>
					<th>Time</th>
					<th>Duty Date</th>
					<th style="visibility:hidden";></th>
					<th>Guard</th>
					<th class="print-no-display">Photo</th>
					<th>Time</th>
					<th>Duty Date</th>
				</tr>';
				$i=1;
				foreach($details_of_guards_at_a_post_in_a_range as $row)
				{
					if(ceil($row->from_time) == floor($row->from_time))
						$from_time = floor($row->from_time).':00';
					else
						$from_time = floor($row->from_time).':30';
					
					if(ceil($row->to_time) == floor($row->to_time))
						$to_time = floor($row->to_time).':00';
					else
						$to_time = floor($row->to_time).':30';


					if($i%3 ==1) echo '<tr>';
					echo '
							<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
							<td style="height: 60px; 
										width: 40px;
										background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
										background-size: auto 100%;
										background-position: 50% 50%;
										background-repeat: no-repeat;
									" class="print-no-display"></td>
							<td><center>'.$from_time.'-'.$to_time.'</center></td>
							<td><center>'.date('d M Y',strtotime($row->date) + 19800).'</center></td>
						';
					if($i%3 ==0) echo '</tr>'; else echo '<td style="visibility:hidden";></td>';
					$i=$i+1;	
				}
		echo'</table>';
	}
	else if(count($details_of_guards_at_a_post_in_a_range) >0 && count($details_of_guards_at_a_post_in_a_range) <3 )
	{
		echo '<table>
				<tr>
					<th>Guard</th>
					<th class="print-no-display">Photo</th>
					<th>Time</th>
					<th>Duty Date</th>
				</tr>';
				foreach($details_of_guards_at_a_post_in_a_range as $row)
				{
					if(ceil($row->from_time) == floor($row->from_time))
						$from_time = floor($row->from_time).':00';
					else
						$from_time = floor($row->from_time).':30';
				
					if(ceil($row->to_time) == floor($row->to_time))
						$to_time = floor($row->to_time).':00';
					else
						$to_time = floor($row->to_time).':30';


					echo '<tr>
							<td><center>'.$row->firstname.' '.$row->lastname.'</center></td>
							<td style="height: 60px; 
										width: 40px;
										background-image: url('.base_url().'assets/images/guard/'.$row->photo.');
										background-size: auto 100%;
										background-position: 50% 50%;
										background-repeat: no-repeat;
									" class="print-no-display"></td>
							<td><center>'.$from_time.'-'.$to_time.'</center></td>
							<td><center>'.date('d M Y',strtotime($row->date) + 19800).'</center></td>
						</tr>';
				}
		echo'</table>';
	}
}

echo '</center>';
?>

</div>