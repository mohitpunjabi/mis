<?php
	$ui = new UI();
        $outer_row = $ui->row()->id('or')->open();
			$col = $ui->col()->width(12)->t_width(12)->m_width(12)->open();
			$tabbox = $ui->tabBox()
               			 ->tab("tabPanemakeschedule", "Make Schedule", true) // 'true' means active
               			 ->tab("tabPaneschedule", "Existing Schedule")
						 ->tab("tabPanesreschedule", "Reschedule Companies")
               			 ->open();
			
				$tab1 = $ui->tabPane()->id("tabPanemakeschedule")->active()->open();
					$box_makeschedule =  $ui->box()->id('box_makeschedule_top')->title("Create Schedule")->open();
						$form=$ui->form()->id("add_course_form")->action("tnpcell/allot_date/AllotDatesToCompany")->multipart()->open();
						$row_upper = $ui->row()->open();
							$ui->datePicker()
							   ->extras("required")
							   ->width(6)
							   ->dateformat("yyyy-mm-dd")
							   ->id("date_from")
							   ->name("date_from")
							   ->label("Allot Date From ")
							   ->placeholder("Select Date")
							   ->show();
							   
							$ui->datePicker()
							   ->width(6)
							   ->extras("required")
							   ->dateformat("yyyy-mm-dd")
							   ->id("date_to")
							   ->name("date_to")
							   ->label("Allot Date To ")
							   ->placeholder("Select Date")
							   ->show();
							$row_upper->close();
							$ui->button()
								->width(2)
								->value('Check Slot')
								->uiType('primary')
								->extras("valign='middle' style = 'vertical-align:middle;'")
								->id("btn_checkslot")
								->name('button')
								->show();
							echo "<br><br>";
							$row_lower = $ui->row()->open();
							$array_options = array();
							array_push($array_options,$ui->option()->extras("value=''")->text("Select Company")->disabled()->selected());
							foreach($company_basic_info as $row)
								array_push($array_options,$ui->option()->value($row->company_id)->text($row->company_name." (".$row->session.")"));
							   
							$ui->select()
							   ->label("Select Company")
							   ->id("ddl_company")
							   ->name("ddl_company")
							   ->width(12)
							   ->options($array_options)
							   ->required()
							   ->show();
							
							$row_lower->close();
							$ui->button()
								->value('Allot Date')
								->uiType('primary')
								->submit()
								->name('submit')
								->show();
						$form->close();
					$box_makeschedule->close();
					
					$box_alreadychedule =  $ui->box()->id('box_makeschedule_bottom')->title("Companies In the above slot")->open();
						$table = $ui->table()->id("table_makeschedule_bottom")->hover()->bordered()->searchable()->sortable()->paginated(true)->
						open();
						echo '
						<thead>
							<tr>
								<th>S.No</th>
								<th>Company Name</th>
								<th>Date</th>
								<th>Status</th>
							</tr>
						</thead>
						';
					$table->close();	
					$box_alreadychedule->close();	
				$tab1->close();
				
				$tab2 = $ui->tabPane()->id("tabPaneschedule")->open();
					$box_schedule =  $ui->box()->id('box_schedule')->title("Existing Schedule")->open();
                    $table = $ui->table()->hover()->bordered()->searchable()->sortable()->paginated(true)->open();
						echo '
						<thead>
							<tr>
								<th>S.No</th>
								<th>Company Name</th>
								<th>Date</th>
								<th>Status</th>
							</tr>
						</thead>
						';
						$i = 1;
						$array_options = array();
						foreach($alloted_company_basic_info as $row)
						{
							$date_from =  date("d-M-Y", strtotime($row->date_from));
							$date_to =  date("d-M-Y", strtotime($row->date_to));
						echo '
							<tr>
								<td>'.$i++.'</td>
								<td>'.$row->company_name.'</td>
								<td>'.$date_from." to ".$date_to.'</td>
								<td>'.$row->status.'</td>
							</tr>';	
						}								
					$table->close();
				$box_schedule->close();	
				$tab2->close();
				
				$tab3 = $ui->tabPane()->id("tabPanesreschedule")->open();
					$box1 =  $ui->box()->id('box_reschedule_top')->title("Reschedule Companies")->open();
					$form=$ui->form()->id("form_reschedule")->action("tnpcell/allot_date/RescheduleCompany")->multipart()->open();
						$table = $ui->table()->id("table_reschedule_top")->hover()->bordered()->searchable()->sortable()->paginated(true)->open
						();
							echo '
							<thead>
								<tr>
									<th>S.No</th>
									<th>Company Name</th>
									<th>Date</th>
									<th>Status</th>
									<th>Reschedule From</th>
									<th>Reschedule To</th>
									<th>Check Slot</th>
									<th>Reschedule</th>
								</tr>
							</thead>
							';
							$i = 1;
							$array_options = array();
							foreach($alloted_company_basic_info as $row)
							{
								$date_from =  date("d-M-Y", strtotime($row->date_from));
								$date_to =  date("d-M-Y", strtotime($row->date_to));
							echo '
								<tr>
									<td>'.$i++.'</td>
									<td>'.$row->company_name.'</td>
									<td>'.$date_from." to ".$date_to.'</td>
									<td>'.$row->status.'</td>
									<td>';
										$ui->datePicker()
										   ->required()
										   ->dateformat("yyyy-mm-dd")
										   ->id("date_reschedulefrom")
										   ->name("date_reschedulefrom")
										   ->placeholder("Select Date")
										   ->show();
							echo 
									'</td>
									 <td>';	  	
										$ui->datePicker()
										   ->required()
										   ->dateformat("yyyy-mm-dd")
										   ->id("date_rescheduleto")
										   ->name("date_rescheduleto")
										   ->placeholder("Select Date")
										   ->show();
							echo 
									'</td>
									<td>';
										$ui->button()
										->value('Check Slot')
										->uiType('primary')
										->id("btn_checkslot_reschedule")
										->name('button')
										->show();
										
										$ui->input()->type('hidden')->value($row->company_id)->name("hidden_company_id")->show();
									
							echo '
									</td>
									<td>';
										$ui->button()
											->value('Reschedule')
											->uiType('primary')
											->submit()
											->id("btn_reschedule")
											->name('submit')
											->show();
							echo '
									</td>
								</tr>';
							}								
						$table->close();
					$form->close();
				$box1->close();
					
				$box_alreadyrescheduled =  $ui->box()->id('box_reschedule_bottom')->title("Companies In the above slot")->open();
					$table = $ui->table()->id("table_reschedule_bottom")->hover()->bordered()->searchable()->sortable()->paginated(
					true)->open();
					echo '
					<thead>
						<tr>
							<th>S.No</th>
							<th>Company Name</th>
							<th>Date</th>
							<th>Status</th>
						</tr>
					</thead>
					';
				$table->close();	
				$box_alreadyrescheduled->close();	
				
				$tab3->close();
				
			$tabbox->close();
		$col->close();
	$outer_row->close();
?>