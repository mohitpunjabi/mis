 <?php 
	if($res->num_rows() == 0){
		echo "<h1>No Files Pending:)</h1>";
		return;
	}
?>
<table align="center">
	<tr>
		<th>File ID</th>
		<th>File Subject</th>
		<th>Sent By</th>
		<th>File Operations</th>
	</tr>
	<?php
			foreach($res->result() as $row) 
			{
	?>
				<tr>
					<td><?php echo $row->file_id; ?></td>
					<td><?php echo $row->file_subject; ?></td>
					<td><?php echo $row->salutation.' '.$row->first_name.' '.$row->middle_name.' '.$row->last_name; ?></td>
					<td>
						<a href="<?php echo site_url("file_tracking/send_running_file/index/".$row->file_id."/".$row->file_subject); ?>"><input type="button" value="Forward This File"></a>
						<a href="<?php echo site_url("file_tracking/close_file/index/".$row->file_id); ?>"><input type="button" value="Close File"></a>
					</td>
				</tr>
	<?php
			}
	?>
	<h1>Pending File Details : </h1>
</table>
