<?php
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width(1)->open();
	$column1->close();

	$column2 = $ui->col()->width(9)->open();
	$box = $ui->box()
				->title('Close File')
				->solid()
				->uiType('primary')
				->open();

		$inputRow1 = $ui->row()->open();
			$ui->input()
				->placeholder('Enter track number')
				->type('text')
				->label('Track Number')
				->uiType('info')
				->id('track_num')
				->name('track_num')
				->width(12)
				->show();

?>
<center>
<?php

			$ui->button()
				->value('Track File')
				->id('submit')
				->uiType('primary')
				->submit()
				->name('submit')
				->width(4)
				->show();
		$inputRow1->close();

?>
</center>
<h2 align="center">OR</h2>
<?php
	if($total_rows != 0){
		$table = $ui->table()->responsive()->hover()->bordered()->open();
		echo '<tr>
						<th>File Subject</th>
						<th>File Track Number</th>
						<th>Sent To</th>
						<th>Current Status</th>
						<th>File Operations</th>
					</tr>';
?>
<?php
		$sno=1;
		while ($sno <= $total_rows)
		{
?>
			<tr>
				<td><?php echo $data_array[$sno][2];?></td>
				<td><?php echo $data_array[$sno][3];?></td>
				<td><?php echo $data_array[$sno][4];?></td>
				<td><?php if ($data_array[$sno][5]) echo "Closed"; else echo "Active"; ?></td>
				<td>
				<center>
				<?php	$ui->button()
							->value('Track File')
							->id('submit'.$sno)
							->uiType('primary')
							->submit()
							->name('submit_track')
							->width(6)
							->show(); ?>
				</center>
				</td>
			</tr>
<?php
			$sno++;
		}
?>
<?php
		$table->close();
	}
?>
<?php
	$box->close();
	$column2->close();
	$outer_row->close();

?>

<div id="move_details">
</div>

<div id="notification"></div>

<script charset="utf-8">
	$('#submit').click(function(){
		get_file_move_details();
	});
	<?php
		$sno=1;
		while ($sno <= $total_rows)
		{
	?>
			var submit_id = '#submit'+<?php echo $sno; ?>;
			$(submit_id).click(function(){
				get_file_move_details2(<?php echo $data_array[$sno][3]; ?>);
			});
	<?php
			$sno++;
		}
	?>
</script>
