<?php
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width(2)->open();
	$column1->close();

	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
				->title('Close File')
				->solid()
				->uiType('primary')
				->open();
	$table = $ui->table()->responsive()->hover()->bordered()->open();
		echo '<tr>
						<th>File ID</th>
						<th>Track Number</th>
						<th>File Subject</th>
						<th>Created By</th>
						<th>Click to confirm</th>
					</tr>';
		foreach($res->result() as $row)
		{
?>
			<tr>
				<td><?php echo $row->file_id;?></td>
				<td><?php echo $row->track_num;?></td>
				<td><?php echo $row->file_subject;?></td>
				<td><?php echo $row->start_emp_id; ?></td>
				<td>
					<center>
					<?php
						$ui->button()
							->value('Confirm')
							->id('submit')
							->uiType('primary')
							->submit()
							->name('submit')
							->width(6)
							->show();
					?>
					</center>
				</td>
			</tr>
<?php
		}
	$table->close();
	$box->close();
	$column2->close();
	$outer_row->close();
?>

<div id="send_notification"></div>

<script charset="utf-8">
	$('#submit').click(function(){
		display_send_notification3(<?php echo $file_id; ?>);
	});
</script>
