<?php
	$room_alloted = "";
	foreach($room_booking_details as $room)
	{
		$room_alloted = $room_alloted." ".$room->building."-".$room->floor."-".$room->room_no;
	}
	foreach($app_details as $app_detail)
	{


	$ui = new UI();	
	$row = $ui->row()->open();
	
	$column1 = $ui->col()->width(2)->open();
	$column1->close();
	
	
	$column2 = $ui->col()->width(8)->open();
	$box = $ui->box()
			  ->solid()
			  ->title("Application No. : ".$app_detail['app_num'])
			  ->uiType('primary')
			  ->open();

		$table = $ui->table()->hover()
					->open();
?>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?>Registered On</th>
				<td><?= $app_detail['app_date'] ?></td>
			</tr>
			<tr>
				<th>Purpose of Visit</th>
				<td><?= $app_detail['purpose_of_visit']?></td>
			</tr>
			<tr>
				<th>Name</th>
				<td><?= $app_detail['name'] ?></td>
			</tr>
			<tr>
				<th>Designation</th>
				<td><?= $app_detail['designation'] ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Check In</th>
				<td><?= $app_detail['check_in'] ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Check Out</th>
				<td><?= $app_detail['check_out'] ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Number of Guests</th>
				<td><?= $app_detail['no_of_guests'] ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Number of Rooms Alloted</th>
				<td><?//= $app_details->no_of_rooms ?></td>
			</tr>
			<tr>
				<th><? $ui->icon("clock-o")->show() ?> Rooms Alloted</th>
				<td><?=$room_alloted?></td>
			</tr>
			
			<? if ($app_detail['school_guest'] == '1') { ?>
				<tr>
					<th><? $ui->icon("clock-o")->show() ?> Whether School Guest?</th>
					<td><?= $app_detail['school_guest'] ?></td>
				</tr>
				<tr>
					<th><? $ui->icon("clock-o")->show() ?> File Path</th>
					<td><a href="<?= site_url('../assets/files/edc_booking/'.$app_detail['file_path']) ?>"><?= $file_path?></a></td>
				</tr>
<?php
}

		$table->close();

	$box->close();	

	$column2->close();
	
	$row->close();
?>
</center>
<?php
}
?>