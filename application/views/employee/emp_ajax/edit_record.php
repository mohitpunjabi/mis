<?php $ui = new UI();
	switch($form)
	{
		case 2: if($emp_prev_exp_details)
				{
					$form = $ui->form()->id('edit_prev_emp_details')->action('employee/edit/update_old_prev_emp_details/'.$sno)->extras('onSubmit="return onclick_save('.$sno.');"')->open();
						$row = $ui->row()->open();
							$col = $ui->col()->open();
								$box = $ui->box()->uiType('primary')->style('margin-bottom:0')->open();
									$ui->textarea()->label('Full address of Employer')->name('edit_addr'.$sno)->id('edit_addr'.$sno)->value($emp_prev_exp_details->address)->show();
									$ui->input()->label('Position Held')->name('edit_designation'.$sno)
										->id('edit_designation'.$sno)->value($emp_prev_exp_details->designation)
										->show();
									$ui->datePicker()->name('edit_from'.$sno)->id('edit_from'.$sno)
		                                    ->dateFormat('dd-mm-yyyy')->addonRight($ui->icon("calendar"))
		                                    ->label('From')
		                                    ->extras('max="'.date('d-m-Y',strtotime($joining_date)).'"') //max not working
		                                    ->value(date('d-m-Y',strtotime($emp_prev_exp_details->from)))
		                                    ->show();
                    				$ui->datePicker()->name('edit_to'.$sno)->id('edit_to'.$sno)
		                                    ->dateFormat('dd-mm-yyyy')
		                                    ->addonRight($ui->icon("calendar"))
		                                    ->label('To')
		                                    ->extras('max="'.date('d-m-Y',strtotime($joining_date)).'"') //max not working
		                                    ->value(date('d-m-Y',strtotime($emp_prev_exp_details->to)))->show();
                                 	$ui->input()->name("edit_payscale".$sno)->id("edit_payscale".$sno)
                                 	        ->label('Pay Scale')->value($emp_prev_exp_details->pay_scale)->show();
									$ui->input()->name('edit_reason'.$sno)->id('edit_reason'.$sno)
											->value($emp_prev_exp_details->remarks)->label('Remarks')->show();
										echo '<center>';
										$ui->button()->uiType('primary')->flat()->submit()
											->name('save')->value('Save')->icon($ui->icon('floppy-o'))->show();
										$ui->button()->uiType('danger')->flat()
											->name('cancel')->value('Cancel')
											->extras('onClick="closeframe();"')->icon($ui->icon('times'))->show();
										echo '</center>';
								$box->close();
							$col->close();
						$row->close();
					$form->close();
				}
				break;

		case 3: if($emp_family_details)
				{
					$form = $ui->form()->id('edit_emp_family_details')->multipart()
					->action('employee/edit/update_old_fam_details/'.$sno)
					->extras('onSubmit="return onclick_save('.$sno.');"')->open();
						$row = $ui->row()->open();
							$col = $ui->col()->open();
								$box = $ui->box()->uiType('primary')->style('margin-bottom:0')->open();

									$ui->input()->name('edit_name'.$sno)->id('edit_name'.$sno)->label('Name')
									    ->value($emp_family_details->name)->show();

                    				$ui->select()->name('edit_relationship'.$sno)->id('edit_relationship'.$sno)->label('Relationship')
                                       ->options(array($ui->option()->value("")->text("Choose One")->disabled(),
                                    					$ui->option()->value("Father")->text("Father")
                                    					   ->selected($emp_family_details->relationship=="Father"),
                                    					$ui->option()->value("Mother")->text("Mother")
                                    					   ->selected($emp_family_details->relationship=="Mother"),
                                    					$ui->option()->value("Spouse")->text("Spouse")
                                    					   ->selected($emp_family_details->relationship=="Spouse"),
                                    					$ui->option()->value("Son")->text("Son")
                                    					   ->selected($emp_family_details->relationship=="Son"),
                                    					$ui->option()->value("Daughter")->text("Daughter")
                                    					   ->selected($emp_family_details->relationship=="Daughter")))
                                       ->show();

                    				$ui->datePicker()->name('edit_dob'.$sno)
                    					->id('edit_dob'.$sno)
	                                    ->dateFormat('dd-mm-yyyy')
	                                    ->addonRight($ui->icon("calendar"))
	                                    ->value(date('d-m-Y',strtotime($emp_family_details->dob)))
	                                    ->label('DOB')->show();

									$ui->input()->name("edit_profession",$sno)
										        ->id("edit_profession",$sno)
										        ->label('Profession')
										        ->value($emp_family_details->profession)->show();

                    				$status = $ui->input()->name('edit_active'.$sno)
                    					        ->id('edit_active'.$sno)
                    					        ->label('Active/Inactive')
                    					        ->value($emp_family_details->active_inactive);
                    				if($emp_family_details->active_inactive == 'Active')
                                        $status->addonRight($ui->button()->icon($ui->icon('check')->id('icon'))->id('edit_status_toggle')->uiType('success'));
                                    else
                                    	$status->addonRight($ui->button()->icon($ui->icon('times')->id('icon'))->id('edit_status_toggle')->uiType('danger'));
                                    $status->extras('readonly')->width(3)->t_width(3)->show();

                    				$ui->input()->name("edit_addr".$sno)->id("edit_addr".$sno)
                    					->value($emp_family_details->present_post_addr)
                    					->label('Present Postal Address')->show();

                    				$ui->imagePicker()->label("Photograph")->containerId('edit_photo_container'.$sno)->id('edit_photo'.$sno)->name('edit_photo'.$sno)->show();

									echo '<center>';
									$ui->button()->uiType('primary')->flat()->submit()
										->name('save')->value('Save')->icon($ui->icon('floppy-o'))->show();
									$ui->button()->uiType('danger')->flat()
										->name('cancel')->value('Cancel')
										->extras('onClick="closeframe();"')->icon($ui->icon('times'))->show();
									echo '</center>';
								$box->close();
							$col->close();
						$row->close();
					$form->close();
				}
				break;
		/*case 4: $emp_education_details = $this->emp_education_details_model->getEmpEduById($emp_id);
				if($emp_education_details)
				{
					echo '<tr>
							 <th>S no.</th>
						     <th>Examination</th>
						     <th>Course(Specialization)</th>
						   	 <th>College/University/Institute</th>
						     <th>Year</th>
						     <th>Percentage/Grade</th>
						     <th>Class/Division</th>
							 <th>Edit/Delete</th>
						</tr>';
					$i=1;
					foreach($emp_education_details as $row)
					{
						echo '<tr name="row[]" align="center">
								<td>'.$i.'</td>
				    			<td>'.strtoupper($row->exam).'</td>
				    			<td>'.strtoupper($row->branch).'</td>
				    			<td>'.strtoupper($row->institute).'</td>
				    			<td>'.$row->year.'</td>
				    			<td>'.strtoupper($row->grade).'</td>
				    			<td>'.ucwords($row->division).'</td>
								<td>
									<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$i.')">
									<input type="button" class="error" name="delete4[]" value="Delete" onClick="onclick_delete('.$i.');" >
								</td>
				    		</tr>';
			    		$this->emp_education_details_model->update_record(array('sno'=>$i),array('id'=>$emp_id,
			    																				'exam'=>$row->exam,
			    																				'branch'=>$row->branch,
			    																				'institute'=>$row->institute,
			    																				'year'=>$row->year,
			    																				'grade'=>$row->grade,
			    																				'division'=>$row->division));
						$i++;
					}
				}
				else
					$this->notification->drawNotification("Empty","No educational qualifications found.","error");
				break;

		case 5: $date = date("Y-m-d", time());
				$newdate = strtotime('-5 year',strtotime ($date )) ;
				$newdate = date("Y-m-d", $newdate);

				$emp_last5yrstay_details = $this->emp_last5yrstay_details_model->getEmpStayById($emp_id);
				if($emp_last5yrstay_details)
				{
					echo '<tr>
							<th rowspan=2>S no.</th>
							<th colspan=2>Duration</th>
							<th rowspan=2>Residential Address</th>
							<th rowspan=2>Name of District Headquarters</th>
							<th rowspan=2>Edit/Delete</th>
						</tr>
						<tr>
						    <th>From</th>
						    <th>To</th>
						</tr>';
					$i=1;
					foreach($emp_last5yrstay_details as $row)
					{
						echo '<tr name=row[] align="center">
								<td>'.$i.'</td>
			    				<td>'.date('d M Y', strtotime($row->from)).'</td>
			    				<td>'.date('d M Y', strtotime($row->to)).'</td>
			    				<td>'.$row->res_addr.'</td>
			    				<td>'.ucwords($row->dist_hq_name).'</td>
								<td>
									<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$i.',\''.$row->from.'\',\''.$row->to.'\',\''.$date.'\',\''.$newdate.'\')">
									<input type="button" class="error" name="delete5[]" value="Delete" onClick="onclick_delete('.$i.');" >
								</td>
			    			</tr>';
			    		$this->emp_last5yrstay_details_model->update_record(array('sno'=>$i),array('id'=>$emp_id,
			    																	'from'=>$row->from,
			    																	'to'=>$row->to,
		    																		'res_addr'=>$row->res_addr,
		    																		'dist_hq_name'=>$row->dist_hq_name));
						$i++;
					}
				}
				else
					$this->notification->drawNotification("Empty","No last five year stay detais found.","error");
				break;*/
	}

?>