<?php
	$ui = new UI();

	$Box1 = $ui->box()
		   ->solid()	
		   ->uiType('primary')
		   ->icon($ui->icon("list"))	
		   ->title("Pending Requests")
		   ->open();


		$table = $ui->table()->hover()->bordered()
					->sortable()->searchable()->paginated()
					->open();
?>
					<thead>		
						<tr>
							<th>Application No.</th>
							<th>Registered On</th>
							<th>Registered By</th>
							<th>No. of Guests</th>
						</tr>
					</thead>
<?php
					foreach($requests as $key => $requests) 
					{
?>
						<tr>
							<td><a href=""><?php echo $requests['app_num'];?></a></td>
							<td><?php echo $requests['app_date'];?></td>
							<td><?php echo $requests['user_id'];?></td>
							<td><?php echo $requests['no_of_guests'];?></td>
						</tr>
<?php
					}
		$table->close();

	$Box1->close();
?>