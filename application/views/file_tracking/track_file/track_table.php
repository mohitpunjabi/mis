<br>
<h1>File Details</h1>
<table nozebra border="1">
	<tr>
		<th>File ID</th>
		<td><?php echo $file_id;?></td>
	</tr>
	<tr>
		<th>File Subject</th>
		<td><?php echo $file_subject;?></td>
	</tr>
	<tr>
		<th>Created By</th>
		<td><?php echo $emp_id;?></td>
	</tr>
	<tr>
		<th>Current Status</th>
		<td><?php if($file_status == 0) echo "Active"; else echo "Closed";?></td>
	</tr>
</table>
<br>
<h1>Movement Details</h1>
<table align = "center">
	<tr>
		<th>S.No.</th>
		<th>Employee Name</th>
		<th>Received On</th>
		<th>Sent On</th>
	</tr>
<?php
	$row = $result->row();
	$temp = $result;
	$sno = 1;	
	$total_rows = $result->num_rows();
//	foreach ($result->result() as $row)
//	{
?>
	<tr align="center">
		<td><?php echo $sno++; ?></td>
		<td><?php echo $row->sent_by_emp_id;?></td>
		<td><?php echo "File Started"; ?></td>
		<td><?php echo $row->sent_timestamp;?></td>
	</tr>
<?php
	$prev_row = $row;
	$row = $result->next_row();
	while ( $sno <= $total_rows )
	{
?>
	<tr align="center">
		<td><?php echo $sno++; ?></td>
		<td><?php echo $row->sent_by_emp_id;?></td>
		<td><?php echo $prev_row->rcvd_timestamp;?></td>
		<td><?php echo $row->sent_timestamp;?></td>
	</tr>
<?php
		$prev_row = $row;
		$row = $result->next_row();
	}
	if ($prev_row->rcvd_timestamp)
	{
?>
	<tr align="center">
		<td><?php echo $sno++; ?></td>
		<td><?php echo $prev_row->rcvd_by_emp_id;?></td>
		<td><?php echo $prev_row->rcvd_timestamp;?></td>
		<td><?php if($file_status == 1) echo "File Closed"; else echo "Not Forwarded";?></td>
	</tr>
<?php
	}
	else
	{
?>
	<tr align="center">
		<td><?php echo $sno++; ?></td>
		<td><?php echo $prev_row->rcvd_by_emp_id;?></td>
		<td><?php echo "File not Received"; ?> </td>
		<td><?php echo "--";?></td>
	</tr>	
<?php
	}
?>
</table>