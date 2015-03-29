<?php
	$ui = new UI();	
	$room_string = "";
	$drop_down = array();
	$room_mapping = array();
	$app_num;
	$i=1;
	// making of droup down menu & room no string
	foreach($room_booking_details as $room)
	{
		$room_mapping[$room->id] = $room->building."-".$room->floor."-".$room->room_no;
		$room_string = $room_string.", ".$room_mapping[$room->id];
		$drop_down[$i++] = $ui->option()->value($room->id)->text($room->building."-".$room->floor."-".$room->room_no);
		//$room_select = $ui->option()->value($room->id)->text($room->building."-".$room->floor."-".$room->room_no)->selected())
	}
	foreach($app_details as $app_detail)
	{


	
	
	
	$column_blank = $ui->col()->width(2)->open();
	$column_blank->close();
	
	
	$column_main = $ui->col()->width(8)->open();
	$row_app_details = $ui->row()->open();
	$app_num = $app_detail['app_num'];
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
				<td><?=$room_string?></td>
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
		
		$row_app_details->close();

}

$row_guest_details = $ui->row()->open();
$box_guest_details = $ui->box()
			  			->title('Guest Details')
						  ->solid()	
						  ->uiType('primary')
						  ->open();
$table = $ui->table()->hover()->bordered()
						->sortable()->searchable()->paginated()
					    ->open();
?>
						<thead>
							<tr>							
								<th>S. No.</th>
								<th >Name</th>
								<th >Address</th>
								<th>Room Alloted</th>				
								<th>CheckIn</th>
								<th >CheckOut</th>								
							</tr>
						</thead>

<?php

					$i=1;
					foreach($guest_details as $guest) 
					{
?>
						<tr>
									
									<td><?=$i++?></td>
									<td><?=$guest->name?></td>
									<td ><?=$guest->address?></td>
									<td><?=$room_mapping[$guest->room_alloted]?></td>
									<td><?=date('d M Y g:i a',strtotime($guest->check_in))?></td>
									<td>
									<?php 
										if($guest->check_out!=null) 
											echo date('d M Y g:i a',strtotime($guest->check_out));
										else 
										{
											$ui->icon('remove')->show();
										?>
											<a href="../add_checkout/<?=$app_num?>/<?=$guest->room_alloted?>"><?=$ui->button()->icon($ui->icon("ok"))->uiType('primary')->value('CheckOut')->show();?></a>
										<?php
										}
									?>
									</td>
						</tr>
<?php
									
					}
					$table->close();
$box_guest_details->close();	
$row_guest_details->close();







$row_add_checkin = $ui->row()->open();

		$box = $ui->box()
			  ->title('Add Guest Checkin')
			  ->solid()	
			  ->uiType('primary')
			  ->open();
		$form = $ui->form()->action('edc_booking/guest_details/insert_guest/')->open();
		$inputRow1 = $ui->row()->open();
		
			$ui->input()
			   ->type('text')
			   ->label('Name<span style= "color:red;"> *</span>')
			   ->name('name')
			   ->required()
			   ->width(6)
			   ->show();			

		 $ui->input()
		    ->type('text')
		    ->label('Designation')
		    ->name('designation')
		    ->width(6)
		    ->show();

	$inputRow1->close();

	$inputRow2 = $ui->row()->open();
		 $ui->input()
		 	->type('text')
		    ->label('Address')
			->name('address')
			->width(6)
			->show();
		$ui->select()
		    ->label('Gender<span style= "color:red;"> *</span>')
			->name('gender')
			->options(array($ui->option()->value('m')->text('Male'),
							$ui->option()->value('f')->text('Female')))
			->width(6)
			->required()
			->show();
		$ui->select()
		    ->label('Room Alloted<span style= "color:red;"> *</span>')
			->name('room_alloted')
			->options($drop_down)
			->width(6)
			->required()
			->show();

	$inputRow2->close();
	$ui->input()
		 	->type('hidden')
			->name('app_num')
			->value($app_num)
			->show();

	
	 $ui->button()
		->value('Add Checkin')
	    ->uiType('primary')
	    ->submit()
	    ->name('mysubmit')
	    ->show();
	
	$form->close();
	$box->close();
	
	

$row_add_checkin->close();


$column_main->close();
?>