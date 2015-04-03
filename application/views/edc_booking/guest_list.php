<?php

$ui = new UI();

$headingBox = $ui->box()
				 ->uiType('primary')
				 ->title('Guests Details for the Application No. ('.$app_num.')')
				 ->solid()
				 ->open();
		 
		$table = $ui->table()
					->id('currentTable')
					->hover()
					->bordered()
					->sortable()
					->searchable()
					->paginated()
					->open();
	?>
						<thead>
							<tr>
								<th>S.No.</th>
								<th>Guest Name</th>
								<th>Address</th>
								<th>Gender</th>
								<th>Room Preference</th>
								<? if ($room_allocated) { ?>
									<th>Room Allocated</th>
								<? } ?>
							</tr>
						</thead>
						<?php	
						$i=0;
						foreach($guests as $key => $guest) { 
							$i++;
?>								<tr>
									<td><?= $i ?></td>
									<td><?= $guest['name'] ?></td>
									<td><?= $guest['address'] ?></td>
									<td><?= $guest['gender'] ?></td>
									<td><?= $guest['room_prefered'] ?></td>
									<?if ($room_allocated)  {?>
										<td><?= $guest['room_alloted'] ?></td>
									<? } ?>
								</tr>
<?						}
					$table->close();
		
$headingBox->close();

?>