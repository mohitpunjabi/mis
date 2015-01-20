<br>
<!-- <h1>File Details</h1>
<table nozebra border="1">
	<tr>
		<th>File ID</th>
		<td><?php //echo $file_id;?></td>
	</tr>
	<tr>
		<th>File Subject</th>
		<td><?php //echo $file_subject;?></td>
	</tr>
	<tr>
		<th>Created By</th>
		<td><?php //echo $start_emp_id;?></td>
	</tr>
	<tr>
		<th>Current Status</th>
		<td><?php// if($close_emp_id) echo "Closed"; else echo "Active";?></td>
	</tr>
</table> -->
<br>
<h1>Movement Details (Current Status : <?php if($close_emp_id) echo "Closed"; else echo "Active";?>)</h1>
<table align="center">
	<tr>
		<th>S.No.</th>
		<th>Employee Name</th>
		<th>Received On</th>
		<th>Sent On</th>
		<th>Remarks</th>
	</tr>
<?php
//	$row = $result->row();
//	$temp = $result;
	$sno = 1;	
//	$total_rows = $result->num_rows();
?>
	<tr align="center">
		<td><?php echo $sno; ?></td>
		<td><?php echo $data_array[$sno][3];//$row->sent_by_emp_id;?></td>
		<td><?php echo "File Started"; ?></td>
		<td><?php echo $data_array[$sno][4];//echo $row->sent_timestamp;?></td>
		<td><?php echo $data_array[$sno][8];//echo $row->remarks;?></td>
	</tr>
<?php
//	$prev_row = $row;
//	$row = $result->next_row();
	$sno++;
	while ($sno <= $total_rows)
	{
?>
	<tr align="center">
		<td><?php echo $sno; ?></td>
		<td><?php echo $data_array[$sno][3];//echo $row->sent_by_emp_id;?></td>
		<td><?php echo $data_array[$sno-1][6];//$prev_row->rcvd_timestamp;?></td>
		<td><?php echo $data_array[$sno][4];//echo $row->sent_timestamp;?></td>
		<td><?php echo $data_array[$sno][8];// echo $row->remarks;?></td>
	</tr>
<?php
	$sno++;
	//	$prev_row = $row;
	//	$row = $result->next_row();
	}
	if ($data_array[$sno-1][6])

	//if ($data_array[$sno-1][6]/*prev_row->rcvd_timestamp*/)
	{
?>
	<tr align="center">
		<td><?php echo $sno; ?></td>
		<td><?php echo $data_array[$sno-1][5];//echo $prev_row->rcvd_by_emp_id;?></td>
		<td><?php echo $data_array[$sno-1][6];//echo $prev_row->rcvd_timestamp;?></td>
		<td><?php if($close_emp_id) echo "File Closed"; else echo "Not Forwarded";?></td>
		<td><?php echo "--";?></td>
	</tr>
<?php
	}
	else
	{
?>
	<tr align="center">
		<td><?php echo $sno; ?></td>
		<td><?php echo $data_array[$sno-1][5];//echo $prev_row->rcvd_by_emp_id;?></td>
		<td><?php echo "File not Received"; ?> </td>
		<td><?php echo "--";?></td>
		<td><?php echo "--";?></td>
	</tr>	
<?php
	}
?>
</table>