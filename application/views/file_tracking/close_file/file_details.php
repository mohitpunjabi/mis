<h1>Confirm File to be Closed : </h1>
<table align="center">
<tr>
	<th>File ID</th>
	<th>Track Number</th>
	<th>File Subject</th>
	<th>Created By</th>
</tr>
<?php
		foreach($res->result() as $row) 
		{
?>
			<tr>
				<td><?php echo $row->file_id;?></td>
				<td><?php echo $row->track_num;?></td>
				<td><?php echo $row->file_subject;?></td>
				<td><?php echo $row->start_emp_id; ?></td>
			</tr>
<?php
		}
?>

<table nozebra>
	<tr>
		<td> 
			<input type="button" value="Confirm" onClick=display_send_notification3('<?php echo $file_id;?>')>
		</td>
	</tr>
	<tr>
		<td>
			<div id="send_notification"></div>
		</td>
		<td></td>
	</tr>
</table>