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
				<td><?php echo $row->file_id; ?></td>
				<td><?php echo $row->track_num; ?></td>
				<td><?php echo $row->file_subject; ?></td>
				<td><?php echo $row->emp_id; ?></td>
			</tr>
<?php
		}
?>
<h1>Sending Details : </h1>
<table nozebra>
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
	</tr>
</table>
