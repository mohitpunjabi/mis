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
		$form = $ui->form()->action('edc_booking/ctk/ctk_action/'.$app_num)->open();

		$table = $ui->table()->hover()
					->open();
?>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?>Registered On</th>
				<td><?= $app_date ?></td>
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
				<th><? $ui->icon("clock-o")->show() ?> Guest in Single AC Rooms (Prefered)</th>
				<td><?= $single_AC ?></td>
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
			<th colspan="2">
<center>
<?
		$ui->button()
			->value('Allot Room')
			->submit(true)
			->id('allot_room')
			->uiType('primary')
			->show();
?>
			</th>
			<tr>

<?
		$form->close();

		$table->close();

	$box->close();	

	$column2->close();
	
	$row->close();
?>
</center>