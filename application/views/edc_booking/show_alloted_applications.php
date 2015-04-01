<?php
	$ui = new UI();

	$outer_row = $ui->row()->open();

	$column1 = $ui->col()->width(1)->open();
	$column1->close();

	$column2 = $ui->col()->width(10)->open();

	$table = $ui->table()->hover()->bordered()
						->sortable()->searchable()->paginated()
					    ->open();
?>
						<thead>
							<tr>							
								<th>Application Number</th>
								<th >Name</th>							
								<th>CheckIn</th>
								<th >CheckOut</th>
								<th>No of Guests</th>
								<th >No of Rooms</th>
							</tr>
						</thead>
<?php
					foreach($applications as $application) 
					{
?>
						<tr>
									
									<td><a href="<?=base_url()?>index.php/edc_booking/guest_details/edit/<?=$application->app_num?>"><?=$application->app_num?></a></td>
									<td><?=$application->name ?></td>
									<td><?=date('d M Y g:i a',strtotime($application->check_in)+19800)?></td>
									<td><?=$application->check_out?></td>
									<td><?=$application->no_of_guests?></td>
									<td><?//=$application->no_of_rooms?></td>
						</tr>
<?php
									
					}
					$table->close();
				


	$column2->close();

	$outer_row->close();
?>
