<?php
	$ui = new UI();

	$box = $ui->box()->uiType('primary')->open();
	
	$table = $ui->table()->hover()->bordered()->open();
?>
	<tr>
		<th>Complaint ID</th>
		<th>Registered By</th>
		<th>Registered On</th>
		<th>Location</th>
		<th>Location Details</th>
		<th>Problem Details</th>
		<th>Remarks</th>
	</tr>
	<?php
			$sno=1;
			while ($sno <= $total_rows)
			{
	?>
				<tr>
					<td><?php echo $data_array[$sno][1];?></td>
					<td><?php echo $data_array[$sno][2];?></td>
					<td><?php echo $data_array[$sno][3];?></td>
					<td><?php echo $data_array[$sno][4];?></td>
					<td><?php echo $data_array[$sno][5];?></td>
					<td><?php echo $data_array[$sno][6];?></td>
					<td><?php echo $data_array[$sno][7];?></td>
				</tr>
<?php
				$sno++;
			}
?>
</table>
<?php
	$table->close();

	$box->close();
?>