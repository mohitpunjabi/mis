<?php
	$ui = new UI();
        $outer_row = $ui->row()->id('or')->open();
			$col = $ui->col()->width(12)->t_width(12)->m_width(12)->open();
			$tabbox = $ui->tabBox()
               			 ->tab("tabPanemakeschedule", "Make Schedule", true) // 'true' means active
               			 ->tab("tabPaneschedule", "Existing Schedule")
               			 ->open();
			
				$tab1 = $ui->tabPane()->id("tabPanemakeschedule")->active()->open();
					$box_makeschedule =  $ui->box()->id('box_makeschedule')->title("Create Schedule")->open();
						$form=$ui->form()->id("add_course_form")->action("tnpcell/allot_date/AllotDatesToCompany")->multipart()->open();
							$ui->datePicker()
							   ->width(6)
							   ->dateformat("yyyy-mm-dd")
							   ->id("date_from")
							   ->name("date_from")
							   ->label("Allot Date From ")
							   ->placeholder("Select Date")
							   ->show();
							   
							$ui->datePicker()
							   ->width(6)
							   ->dateformat("yyyy-mm-dd")
							   ->id("date_to")
							   ->name("date_to")
							   ->label("Allot Date To ")
							   ->placeholder("Select Date")
							   ->show();
							
							$array_options = array();
							foreach($company_basic_info as $row)
								array_push($array_options,$ui->option()->value($row->company_id)->text($row->company_name." (".$row->session.")"));
							   
							$ui->select()
							   ->label("Select Company")
							   ->id("ddl_company")
							   ->name("ddl_company")
							   ->options($array_options)
							   ->show();
							
							$ui->button()
								->value('Check Slot')
								->uiType('primary')
								->id("btn_checkslot")
								->name('button')
								->show();
								
							$ui->button()
								->value('Allot Date')
								->uiType('primary')
								->submit()
								->name('submit')
								->show();
						$form->close();
					$box_makeschedule->close();
					
					$box_alreadychedule =  $ui->box()->id('box_alreadyscheduled')->title("Companies In the above slot")->open();
						$table = $ui->table()->responsive()->hover()->bordered()->searchable()->sortable()->paginated(true)->open();
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
					$box_makeschedule->close();	
				$tab1->close();
				$tab2 = $ui->tabPane()->id("tabPaneschedule")->open();
					$box_schedule =  $ui->box()->id('box_schedule')->title("Existing Schedule")->open();
                    $table = $ui->table()->responsive()->hover()->bordered()->searchable()->sortable()->paginated(true)->open();
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
				$box_schedule->close();	
				$tab2->close();
			$tabbox->close();
		$col->close();
	$outer_row->close();
?>