<?php $ui = new UI();

	$view_row = $ui->row()->open();
		$col = $ui->col()->open();
			$view_box = $ui->box()->uiType('primary')->title('Choose Employee to View')->open();
				$form = $ui->form()->action('employee/view/view_form')->open();

					$emp = $ui->select()->label('Employee Id')->name('emp_id')->id('emp_id');
					$options = array();
					if($employees)
						foreach($employees as $row)
							array_push($options,$ui->option()->value($row->id)->text($row->id));
					else
						array_push($options,$ui->option()->value("")->text("No Employees")->disabled());
					$emp->options($options)->show();
					echo '<a onClick="onclick_emp_id();" >Don\'t remember Employee Id</a><br><br>';

					echo '<div id="search_eid" style="display:none">';
					$dept = $ui->select()->label('Department')->id('emp_dept');
					$options = array($ui->option()->text('Select Employee Department')->disabled()->selected());
					if($departments)
						foreach($departments as $row)
							array_push($options,$ui->option()->value($row->id)->text($row->name));
					else
						array_push($options,$ui->option()->value("")->text("No Departments")->disabled());
					$dept->options($options)->show();
					echo '</div>';

					echo '<div id="employee" style="display:none">';
					$emp_name = $ui->select()->label('Employee Name')->id('employee_select');
					$options = array($ui->option()->value("")->text('No Employee found')->disabled());
					$emp_name->options($options)->show();
					echo '</div>';

					$dept = $ui->select()
								->label('Select Form')
								->name('form_name')
								->options(array($ui->option()->value('0')->text('Basic Details'),
												$ui->option()->value('1')->text('Previous Employment Details'),
												$ui->option()->value('2')->text('Dependent Family Member Details'),
												$ui->option()->value('3')->text('Educational Details'),
												$ui->option()->value('4')->text('Last 5 Year Stay Details'),
												$ui->option()->value('5')->text('All Employee Details')))
								->show();

					$ui->button()->value('Submit')
                            ->uiType('primary')
                            ->submit()
                            ->name('submit')
                            ->show();

				$form->close();
			$view_box->close();
		$col->close();
	$view_row->close();
?>
