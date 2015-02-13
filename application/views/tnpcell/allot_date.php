<?php
	$ui = new UI();
        $outer_row = $ui->row()->id('or')->open();
			$col_makeschedule = $ui->col()->width(6)->t_width(12)->m_width(12)->open();
			
				$box_makeschedule =  $ui->box()->id('box_makeschedule')->title("Select Company to view JNF")->open();
                    $form=$ui->form()->id("add_course_form")->action("tnpcell/view_jnf/ViewJNF")->multipart()->open();
						
						$array_options = array();
						foreach($company_basic_info as $row)
							array_push($array_options,$ui->option()->value($row->company_id)->text($row->company_name." (".$row->session.")"));
							
						$ui->select()
						   ->id("ddl_company")
						   ->name("ddl_company")
						   ->options($array_options)
						   ->show();
						
						$ui->button()
							->value('View JNF')
							->uiType('primary')
							->submit()
							->name('submit')
							->show();
					$form->close();
				$box_makeschedule->close();
			$col_makeschedule->close();
			
			$col_schedule = $ui->col()->width(6)->t_width(12)->m_width(12)->open();
			
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
			$col_schedule->close();
		$outer_row->close();
?>