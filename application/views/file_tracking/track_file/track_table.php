<?php
	$ui = new UI();
	$outer_row2 = $ui->row()->open();

	$column1 = $ui->col()->width(1)->open();
	$column1->close();

	$column2 = $ui->col()->width(9)->open();
	$box2 = $ui->box()
				->title('Movement Details  (Track Number : ' .$track_num. ')')
				->solid()
				->uiType('primary')
				->open();

	$table2 = $ui->table()->responsive()->hover()->bordered()->open();
		echo '<tr>
						<th>S.No.</th>
						<th>Employee Name</th>
						<th>Received On</th>
						<th>Sent On</th>
						<th>Remarks</th>
					</tr>';
?>
<?php
	$sno = 1;
?>
	<tr>
		<td><?php echo $sno; ?></td>
		<td><?php echo $data_array[$sno][3];//$row->sent_by_emp_id;?></td>
		<td><?php echo "File Started"; ?></td>
		<td><?php echo $data_array[$sno][4];//echo $row->sent_timestamp;?></td>
		<td><?php echo $data_array[$sno][8];//echo $row->remarks;?></td>
	</tr>
<?php
	$sno++;
	while ($sno <= $total_rows)
	{
?>
	<tr>
		<td><?php echo $sno; ?></td>
		<td><?php echo $data_array[$sno][3];//echo $row->sent_by_emp_id;?></td>
		<td><?php echo $data_array[$sno-1][6];//$prev_row->rcvd_timestamp;?></td>
		<td><?php echo $data_array[$sno][4];//echo $row->sent_timestamp;?></td>
		<td><?php echo $data_array[$sno][8];// echo $row->remarks;?></td>
	</tr>
<?php
	$sno++;
	}
	if ($data_array[$sno-1][6])

	{
?>
	<tr>
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
	<tr>
		<td><?php echo $sno; ?></td>
		<td><?php echo $data_array[$sno-1][5];//echo $prev_row->rcvd_by_emp_id;?></td>
		<td><?php echo "File not Received"; ?> </td>
		<td><?php echo "--";?></td>
		<td><?php echo "--";?></td>
	</tr>
<?php
	}
	$table2->close();
	$box2->close();
	$column2->close();
	$outer_row2->close();
?>
