<?php
	$ui = new UI();
//echo form_open('complaint/register_complaint/insert');   	
	$row = $ui->row()->open();
	
	$column1 = $ui->col()->width(2)->open();
	$column1->close();
	
	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
			  ->uiType('primary')
			  ->open();

	$form = $ui->form()->action('complaint/supervisor/update_complaint_details/'.$complaint_id)->open();

	$inputRow1 = $ui->row()->open();
		$ui->input()->type("text")->label("Complaint ID")->placeholder($complaint_id)->disabled()
		   ->width(6)
		   ->show();
		$ui->input()->type("text")->label("Complaint By")->value($complaint_by)->disabled()
		   ->width(6)
		   ->show();
	$inputRow1->close();

	$inputRow2 = $ui->row()->open();
		$ui->input()->type("text")->label("Mobile No.")->value($mobile)->disabled()
		   ->width(6)
		   ->show();
		$ui->input()->type("text")->label("Email ID")->value($email)->disabled()
		   ->width(6)
		   ->show();
	$inputRow2->close();

	$inputRow3 = $ui->row()->open();
		$ui->input()->type("text")->label("Location")->value($location)->disabled()
		   ->width(6)
		   ->show();
		$ui->input()->type("text")->label("Location Details")->value($location_details)->disabled()
		   ->width(6)
		   ->show();
	$inputRow3->close();

	$inputRow4 = $ui->row()->open();
		$ui->input()->type("text")->label("Registered On")->value($date_n_time)->disabled()
		   ->width(6)
		   ->show();
		$ui->input()->type("text")->label("Prefered Time")->value($pref_time)->disabled()
		   ->width(6)
		   ->show();
	$inputRow4->close();

	$inputRow5 = $ui->row()->open();
		$ui->input()->type("text")->label("Problem Details")->value($problem_details)->disabled()
		   ->width(6)
		   ->show();
		$ui->select()
		   ->label('Status')
		   ->name('status')
		   ->required()
		   ->options(array( $ui->option()->value("Under Processing")->text('Under Processing'),
							$ui->option()->value("Rejected")->text('Rejected'),
							$ui->option()->value("Closed")->text('Closed')
						  )
					)
		   ->width(6)
		   ->show();
	$inputRow5->close();

?>
<table align="center">
	<tr>
		<th>Action Taken</th>
		<td>
					<textarea name="action_taken" readonly><?php echo $remarks;?></textarea>
		</td>
	</tr>
	<tr>
		<th>Fresh Action</th>
		<td>
			<textarea placeholder="Fresh Action" name="fresh_action" required></textarea>
		</td>
	</tr>
</table>

<center><input type="submit" value="Submit" id="complaint" /></center>

<?php echo form_close(); ?>
