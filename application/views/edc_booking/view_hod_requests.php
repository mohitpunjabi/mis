<?php
	$ui = new UI();

	$tabBox1 = $ui->tabBox()
		   ->icon($ui->icon("list"))	
		   ->title("Booking Requests")
		   ->tab("pending_requests", "Pending Requests", true)
		   ->tab("rejected_requests", "Rejected Requests")
		   ->tab("approved_requests", "Approved Requests")
		   ->open();

		$tab1 = $ui->tabPane()->id("pending_requests")->active()->open();

			if ($total_rows_pending == 0) {
				$ui->callout()
				   ->uiType("info")
				   ->title("No Pending Requests.")
				   ->desc("")
				   ->show();
			}

			else {
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
					$sno=1;
					while ($sno <= $total_rows_pending)
					{
?>
						<tr>
							<td><a href="<?php echo site_url("edc_booking/booking_details/details/".$data_array_pending[$sno][1]);?>"><?php echo $data_array_pending[$sno][1];?></a></td>
							<td><?php echo $data_array_pending[$sno][2];?></td>
							<td><?php echo $data_array_pending[$sno][3];?></td>
							<td><?php echo $data_array_pending[$sno][4];?></td>
						</tr>
<?php
						$sno++;
					}
			$table->close();
		}	
		$tab1->close();

		$tab2 = $ui->tabPane()->id("rejected_requests")->open();

			if ($total_rows_rejected == 0) {
				$ui->callout()
				   ->uiType("info")
				   ->title("No Rejected Requests.")
				   ->desc("")
				   ->show();
			}

			else {
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
					$sno=1;
					while ($sno <= $total_rows_rejected)
					{
?>
						<tr>
							<td><a href="<?php echo site_url("edc_booking/booking_details/details/".$data_array_rejected[$sno][1]);?>"><?php echo $data_array_rejected[$sno][1];?></a></td>
							<td><?php echo $data_array_rejected[$sno][2];?></td>
							<td><?php echo $data_array_rejected[$sno][3];?></td>
							<td><?php echo $data_array_rejected[$sno][4];?></td>
						</tr>
<?php
						$sno++;
					}
			$table->close();
		}	
		$tab2->close();

		$tab3 = $ui->tabPane()->id("approved_requests")->open();

			if ($total_rows_approved == 0) {
				$ui->callout()
				   ->uiType("info")
				   ->title("No Approved Requests.")
				   ->desc("")
				   ->show();
			}

			else {
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
					$sno=1;
					while ($sno <= $total_rows_approved)
					{
?>
						<tr>
							<td><a href="<?php echo site_url("edc_booking/booking_details/details/".$data_array_approved[$sno][1]);?>"><?php echo $data_array_approved[$sno][1];?></a></td>
							<td><?php echo $data_array_approved[$sno][2];?></td>
							<td><?php echo $data_array_approved[$sno][3];?></td>
							<td><?php echo $data_array_approved[$sno][4];?></td>
						</tr>
<?php
						$sno++;
					}
			$table->close();
		}	
		$tab3->close();

	$tabBox1->close();
?>