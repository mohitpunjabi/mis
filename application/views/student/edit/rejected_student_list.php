<?php
	
	$ui = new UI();

	$form=$ui->form()
			 ->action('student/student_rejected/fetch_stu_details')
			 ->multipart()
			 ->id('form_submit')
			 ->open();

		$select_details_to_edit_box = $ui->box()
                                             ->uiType('primary')
                                             ->solid()
                                             ->title('Enter the Student Id')// and Select the Form')
                                             ->open();

                $student_admn_no = $ui->row()
                                      ->open();

                        $student_details_1_1 = $ui->col()
                                                  ->width(3)
                                                  ->open();

                        $student_details_1_1->close();

                        $ui->input()
                           ->label('Admission No.')
                           ->uiType('primary')
                           ->id('stu_id')
                           ->width(6)
                           ->name('stu_id')
                           ->show();

                        /*$ui->select()
                           ->label('Select Form')
                           ->name('select_form')
                           ->options(array($ui->option()->value('0')->text('Change Profile Picture'),
                                           $ui->option()->value('1')->text('Edit Basic Details'),
                                           $ui->option()->value('2')->text('Edit Education Details')))
                           ->width(6)
                           ->show();*/

                $student_admn_no->close();

                $student_details_row_2 = $ui->row()
                                              ->open();

                        $student_details_2_1 = $ui->col()
                                                  ->width(6)
                                                  ->open();

                            $student_details_2_1->close();

                            $ui->button()
                               ->submit(true)
                               ->value('Submit')
                               ->uiType('primary')
                               ->id('submit_button_id')
                               ->width(2)
                               ->show();

                    $student_details_row_2->close();

            $select_details_to_edit_box->close();

    $form->close();

            $rejected_students_list_box = $ui->box()
                                             ->uiType('primary')
                                             ->id('rejectedUsersBox')
                                             ->solid()
                                             ->title('List of Rejected Students')// and Select the Form')
                                             ->open();

                $table = $ui->table()
				            ->hover()
				            ->id('rejectedUsers')
				            ->bordered()
				            ->striped()
				            ->responsive()
				            ->paginated()
				            ->searchable()
				            ->sortable()
				            ->condensed()
				            ->open();
?>
				    <thead>
			            <tr>
			                <th>User ID</th>
			                <th>Reason For Rejection</th>
							<th>Edit the Details</th>
			            </tr>
					</thead>
					
					<? $count_rejected = count($rejected_users);
						for($i =0 ; $i < $count_rejected; $i++) 
						{ ?>
							<tr>
								<td>
									<? echo $rejected_users[$i]->id; ?>
								</td>
								<td>
									<? echo $rejected_users[$i]->reason; ?>
								</td>
								<td><a class="btn btn-primary" data-toggle="modal" value="<?php echo $rejected_users[$i]->id; ?>" id="rv" onclick="send_data_to_edit('<?php echo $rejected_users[$i]->id; ?>')" >Edit</a>
									<? //echo '<input type="button" value="Edit" id="validation_button" onclick="send_data_to_edit('.$rejected_users[$i]->id.');"/>';
										//$ui->button->value('Edit')->extras('onclick="send_data_to_edit('.$rejected_users[$i]->id.')"'); ?>
								</td>
							</tr>
					<? } ?>
			        <tfoot>
			            <tr>
			                <th>User ID</th>
			                <th>Reason For Rejection</th>
			            </tr>
			        </tfoot>
<?
				$table->close();

            $rejected_students_list_box->close();

?>