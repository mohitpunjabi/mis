<?php
	$ui = new UI();
//echo form_open('complaint/register_complaint/insert');
	$row = $ui->row()->open();

	$column1 = $ui->col()->width(2)->open();
	$column1->close();

	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
			  ->solid()
			  ->title("Application No. : ".$app_num)
			  ->uiType('primary')
			  ->open();

		$table = $ui->table()->hover()
					->open();
?>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?>Registered On</th>
				<td><?= $app_date ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?>Registered By</th>
				<td><?= $user ?></td>
			</tr>
			<tr>
				<th>Purpose</th>
				<td><?= $purpose ?></td>
			</tr>
			<tr>
				<th>Purpose of Visit</th>
				<td><?= $purpose_of_visit ?></td>
			</tr>
			<tr>
				<th>Name</th>
				<td><?= $name ?></td>
			</tr>
			<tr>
				<th>Designation</th>
				<td><?= $designation ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Check In</th>
				<td><?= $check_in ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Check Out</th>
				<td><?= $check_out ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Number of Guests</th>
				<td><?= $no_of_guests ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Guest in Double AC Rooms (Prefered)</th>
				<td><?= $double_AC ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Guest in Suite AC Rooms (Prefered)</th>
				<td><?= $suite_AC ?></td>
			</tr>
      <tr>
        <th>
          Rooms Allocated
        </th>
        <?php
          //print_r($room_array);
          echo '<td>';
          foreach($room_array as $room)
          {
            echo $room['room_no'].'-'.$room['room_type'];
          }
          echo '</th>';
        ?>
      </tr>
			<? if ($school_guest == '1') { ?>
				<tr>
					<th><? $ui->icon("clock-o")->show() ?> Whether School Guest?</th>
					<td><?= $school_guest ?></td>
				</tr>
				<tr>
					<th><? $ui->icon("clock-o")->show() ?> File Path</th>
					<td><a href="<?= site_url('../assets/files/edc_booking/'.$file_path) ?>"><?= $file_path?></a></td>
				</tr>
<?
			}
?>
<?
		//if ($auth == 'hod')
		//	$form = $ui->form()->action('edc_booking/booking_request/hod_action/'.$app_num)->open();
		if ($auth == 'pce')
			$form = $ui->form()->action('edc_booking/booking_request/pce_final_action/'.$app_num)->open();

?>
			<tr>
			<th colspan='2'>
<?
			$inputRow4 = $ui->row()->open();

				$c1 = $ui->col()->width(1)->open();
				$c1->close();

				$c2 = $ui->col()->width(4)->open();
						$ui->select()
						   ->label('Approve OR Reject')
						   ->name('status')
						   ->required()
						   ->options(array( $ui->option()->value("Approved")->text('Approve'),
											$ui->option()->value("Rejected")->text('Reject'),
										  )
									)
						   ->show();
				$c2->close();

				$c3 = $ui->col()->width(1)->open();
				$c3->close();

				$c4 = $ui->col()->width(6)->open();
						$ui->textarea()->label('Reason for Rejection')->name("reason")->placeholder('Reason for Rejection')->show();
				$c4->close();

			$inputRow4->close();
?>
			</th>
			</tr>
			<tr>
			<th colspan="2">
<center>
<?
		$ui->button()
			->value('Submit')
			->submit(true)
			->id('complaint')
			->uiType('primary')
			->show();
?>
			</th>
			</tr>
<?

		$form->close();

		$table->close();

	$box->close();

	$column2->close();

	$row->close();
?>
</center>
<?php
/*	$ui = new UI();
//echo form_open('complaint/register_complaint/insert');
	$row = $ui->row()->open();

	$column1 = $ui->col()->width(2)->open();
	$column1->close();

	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
			  ->solid()
			  ->title("Application No. : ".$app_num)
			  ->uiType('primary')
			  ->open();

		$inputRow1 = $ui->row()->open();
			$c1 = $ui->col()->width(4)->open();
				?><p><strong><? $ui->icon("clock-o")->show() ?> Registered On</strong><br/>
				  <sapn><?= $app_date ?></span></p><?
			$c1->close();
			$c2 = $ui->col()->width(4)->open();
				?><p><strong><? $ui->icon("user")->show() ?> Registerd By</strong><br/>
				  <span><?= $user ?></span></p><?
			$c2->close();
			$c3 = $ui->col()->width(4)->open();
				?><p><strong><? $ui->icon("mail-forward")->show() ?> Email ID</strong><br/>
				  <span><?= $email ?></span></p><?
			$c3->close();
		$inputRow1->close();


		$inputRow2 = $ui->row()->open();
			$c1 = $ui->col()->width(4)->open();
				?><p><strong><? $ui->icon("clock-o")->show() ?> Check In</strong><br/>
				  <sapn><?= $check_in ?></span></p><?
			$c1->close();
			$c2 = $ui->col()->width(4)->open();
				?><p><strong><? $ui->icon("clock-o")->show() ?> Check Out</strong><br/>
				  <span><?= $check_out ?></span></p><?
			$c2->close();
			$c3 = $ui->col()->width(4)->open();
				?><p><strong> Purpose </strong></br><?
				?><span><?= $purpose ?></span></p><?
			$c3->close();
		$inputRow2->close();


		$inputRow3 = $ui->row()->open();
			$c1 = $ui->col()->width(4)->open();
				?><p><strong><? $ui->icon("clock-o")->show() ?> Amount Deposited</strong><br/>
				  <sapn><?= $amount_deposited ?></span></p><?
			$c1->close();
			$c2 = $ui->col()->width(4)->open();
				?><p><strong> Payment made by Name </strong><br/>
				  <span><?= $amount_name ?></span></p><?
			$c2->close();
			$c3 = $ui->col()->width(4)->open();
				?><p><strong> <a href="<?php echo site_url("edc_booking/guest_details/get_guests/".$app_num);?>">Guest Details</a>  </strong><br/>
				 </p><?
			$c3->close();
		$inputRow3->close();


		if ($auth == 'hod')
			$form = $ui->form()->action('edc_booking/hod/hod_action/'.$app_num)->open();
		else if ($auth == 'pce')
			$form = $ui->form()->action('edc_booking/pce/pce_action/'.$app_num)->open();

		$inputRow4 = $ui->row()->open();

			$c1 = $ui->col()->width(1)->open();
			$c1->close();

			$c2 = $ui->col()->width(4)->open();
					$ui->select()
					   ->label('Approve OR Reject')
					   ->name('status')
					   ->required()
					   ->options(array( $ui->option()->value("Approved")->text('Approve'),
										$ui->option()->value("Rejected")->text('Reject'),
									  )
								)
					   ->show();
			$c2->close();

			$c3 = $ui->col()->width(1)->open();
			$c3->close();

			$c4 = $ui->col()->width(6)->open();
					$ui->textarea()->label('Reason for Rejection')->name("reason")->placeholder('Reason for Rejection')->show();
			$c4->close();
		$inputRow4->close();
?>
<center>
<?
		$ui->button()
			->value('Submit')
			->submit(true)
			->id('complaint')
			->uiType('primary')
			->show();

		$form->close();

	$box->close();

	$column2->close();

	$row->close();*/
?>
