<?php echo '<center><h2>Replace the Guard</h2>';

if($shift == 'a') $shift = 'A';
if($shift == 'b') $shift = 'B';
if($shift == 'c') $shift = 'C';

echo form_open_multipart('guard/duties/replace');
echo '<table>
	<tr>
		<td>Duty Date</td>
		<td><center>'.date('d M Y',strtotime($date)+19800).'</center></td>
	</tr>
	<tr>
		<td>Post Name</td>
		<td><center>'.$postname.'</center></td>
	</tr>
	<tr>
		<td>Shift</td>
		<td><center>'.$shift.'</center></td>
	</tr>
	<tr>
		<td>Replace By</td>
		<td>
			<select name="guard_id">';
					foreach($all_gaurds_at_same_shift as $row)
					{
						echo '<option value="'.$row->Regno.'">'.$row->firstname.' '.$row->lastname.'</option>';
					}
	  echo '</select>
		</td>
	</tr>
	<tr>
	<td>Remarks</td>
	<td><input type"text" placeholder="Remarks" name="remarks" id="remarks" required="required"/></td>
	</tr>
</table>';
echo form_hidden('regno',$regno);
echo form_hidden('date',$date);
echo form_hidden('post_id',$post_id);
echo form_hidden('shift',$shift);
echo form_submit('replace','Save');
echo form_close();

?>
</center>