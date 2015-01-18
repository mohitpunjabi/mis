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
	}
	else
	{
?>
<h1 align="center">OR</h1>
<table align="center">
	<tr>
		<th>File ID</th>
		<th>File Subject</th>
		<th>File Track Number</th>
		<th>Sent To</th>
		<th>Current Status</th>
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
					<td><?php echo $row->rcvd_by_emp_id; ?></td>
					<td><?php if ($row->close_emp_id) echo "Closed"; else echo "Active"; ?></td>
					<td>
						<input type="button" value="Track File" onClick="get_file_move_details2(<?php echo $row->track_num; ?>)">
					</td>
				</tr>
<?php
			}
?>
	<h1>Select File :</h1>
</table>
<?php
	}
?>

<div id="move_details">
</div>