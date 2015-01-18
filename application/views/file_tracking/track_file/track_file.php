 <h1>Enter Track Number :</h1>
<?php echo form_open (); ?> 
<table align="center" nozebra>
	<tr>
		<td>Track Number : </td>
		<td> 
			<input type="text" name="track_num" id="track_num"> 
			<input type="button" value="Track File" onClick="get_file_move_details()">
		</td>

	</tr>
</table>
<?php 
	if($res->num_rows() == 0){
		echo "<h1>No Files to be Tracked:)</h1>";
		return;
	}
?>
<h1 align="center">OR</h1>
<table align="center">
	<tr>
		<th>File ID</th>
		<th>File Subject</th>
		<th>File Track Number</th>
		<th>Sent To</th>
		<th>File Operations</th>
	</tr>
	<?php
			foreach($res->result() as $row) 
			{
	?>
				<tr>
					<td><?php echo $row->file_id; ?></td>
					<td><?php echo $row->file_subject; ?></td>
					<td><?php echo $row->track_num; ?></td>
					<td><?php echo $row->salutation.' '.$row->first_name.' '.$row->middle_name.' '.$row->last_name; ?></td>
					<td>
						<input type="button" value="Track File" onClick="get_file_move_details2(<?php echo $row->track_num; ?>)">
					</td>
				</tr>
	<?php
			}
	?>
	<h1>Files Tracking Details :</h1>
	<!--<table nozebra>
		<tr>
			<td>Employee ID : </td>
			<td> 
				<input type="text" name="emp_id" id="emp_id"> 
				<input type="button" value="Send" onClick="display_send_notification2()">
			</td>
		</tr>
		<tr>
			<td>
				<div id="send_notification"></div>
			</td>
			<td></td>
		</tr>-->
</table>

<div id="move_details">
</div>