
<center><h2>Assign Duty to a Guard for tomorrow ( <?php echo date(('d M Y'),strtotime(date("Y-m-d")) + 86400);?> )</h2><br>
<?php echo form_open_multipart('guard/duties/assign_to_a_guard'); ?>
<table>
	<tr>
		<td>Select Guard Name</td>
		<td>
			<select name="regno" required="required">
			<option value="" selected="selected" disabled="disabled">Select Guard</option>
			<?php
			foreach($available_guards as $row)
			{
				echo '<option value="'.$row->Regno.'">'.$row->firstname.' '.$row->lastname.'</option>';
			}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Select Post Name</td>
		<td>
			<select name="post_id" required="required">
			<option value="" selected="selected" disabled="disabled">Select Post</option>
			<?php
			foreach($posts as $row)
			{
				echo '<option value="'.$row['post_id'].'">'.$row['postname'].'</option>';
			}
			?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Select Shift</td>
		<td>
			<select name="shift" required="required">
				<option value="" selected="selected" disabled="disabled">Select Shift</option>
				<option value="a">A</option>
				<option value="b">B</option>
				<option value="c">C</option>
			</select>
		</td>
	</tr>
</table>
<?php 
echo form_hidden('date',date(('Y-m-d'),strtotime(date("Y-m-d")) + 86400));
echo form_submit('assign','Assign');
echo form_close();

?>
</center>