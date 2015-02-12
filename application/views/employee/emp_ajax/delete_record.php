<?php $ui = new UI();
	switch($form)
	{
		case 2: $emp_prev_exp_details = $this->emp_prev_exp_details_model->getEmpPrevExpById($emp_id);
				if($emp_prev_exp_details)
				{
					echo '<thead valign="middle" ><tr align="center">
	                        <th rowspan="2" >S no.</th>
	                        <th rowspan="2">Full address of Employer</th>
	                        <th rowspan="2">Position held</th>
	                        <th colspan="2">Organization</th>
	                        <th rowspan="2">Pay Scale</th>
	                        <th rowspan="2">Remarks</th>
	                        <th rowspan="2">Edit/Delete</th>
	                    </tr>
	                    <tr align="center">
	                        <th>From</th>
	                        <th>To</th>
	                    </tr></thead><tbody>';
	                    $i=1;
	                    foreach($emp_prev_exp_details as $row) {
	                        if($row->remarks == "") $remarks='NA';
	                        else    $remarks = $row->remarks;
	                        echo '<tr name="row[]" align="center">
	                                <td>'.$i.'</td>
	                                <td>'.ucwords($row->address).'</td>
	                                <td>'.ucwords($row->designation).'</td>
	                                <td>'.date('d M Y', strtotime($row->from)).'</td>
	                                <td>'.date('d M Y', strtotime($row->to)).'</td>
	                                <td>'.$row->pay_scale.'</td>
	                                <td>'.ucfirst($remarks).'</td>
	                        		<td>';
	                                    $ui->button()->flat()->id('edit'.$i)->name("edit[]")->uiType("primary")->value("Edit")->icon($ui->icon("pencil"))->extras('onClick="onclick_edit('.$i.',\''.$row->from.'\',\''.$row->to.'\',\''.$joining_date.'\')"')->show();
	                                    $ui->button()->flat()->id('delete2'.$i)->name("delete2[]")->uiType("danger")->value("Delete")->icon($ui->icon("trash-o"))->extras('onClick="onclick_delete('.$i.');"')->show();
	                        echo   '</td></tr>';

	                    	$this->emp_prev_exp_details_model->update_record(array('sno'=>$i),array('id'=>$emp_id,
			    																				'designation'=>$row->designation,
			    																				'from'=>$row->from,
			    																				'to'=>$row->to,
			    																				'pay_scale'=>$row->pay_scale,
			    																				'address'=>$row->address,
			    																				'remarks'=>$row->remarks));
							$i++;
						}
						echo '</tbody>';
				}
				else
					$ui->callout()->title('Empty')->desc('No Employment Details Found.')->uiType('danger')->show();
				break;

		case 4: $emp_education_details = $this->emp_education_details_model->getEmpEduById($emp_id);
				if($emp_education_details)
				{
					echo '<thead valign="middle" ><tr align="center">
	                        <th align="center">S no.</th>
	                        <th>Examination</th>
	                        <th>Course(Specialization)</th>
	                        <th>College/University/Institute</th>
	                        <th>Year</th>
	                        <th>Percentage/Grade</th>
	                        <th>Class/Division</th>
	                        <th>Edit/Delete</th>
	                        </tr>
	                        </thead><tbody>';
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
	                            	<td>';
	                                	$ui->button()->flat()->id('edit'.$i)->name("edit[]")->uiType("primary")->value("Edit")->icon($ui->icon("pencil"))->extras('onClick="onclick_edit('.$i.')"')->show();
	                                    $ui->button()->flat()->id('delete4'.$i)->name("delete4[]")->uiType("danger")->value("Delete")->icon($ui->icon("trash-o"))->extras('onClick="onclick_delete('.$i.');"')->show();
	                    echo   '</td></tr>';

			    		$this->emp_education_details_model->update_record(array('sno'=>$i),array('id'=>$emp_id,
			    																				'exam'=>$row->exam,
			    																				'branch'=>$row->branch,
			    																				'institute'=>$row->institute,
			    																				'year'=>$row->year,
			    																				'grade'=>$row->grade,
			    																				'division'=>$row->division));
						$i++;
					}
					echo '</tbody>';
				}
				else
					$ui->callout()->title('Empty')->desc('No Educational Qualifications Found.')->uiType('danger')->show();
				break;

		case 5: $emp_last5yrstay_details = $this->emp_last5yrstay_details_model->getEmpStayById($emp_id);
				if($emp_last5yrstay_details)
				{
					echo '<thead valign="middle" ><tr align="center">
				              	<th rowspan=2>S no.</th>
								<th colspan=2>Duration</th>
								<th rowspan=2>Residential Address</th>
								<th rowspan=2>Name of District Headquarters</th>
								<th rowspan=2>Edit/Delete</th>
	                    	</tr>
	                    	<tr align="center">
	                        	<th>From</th>
	                        	<th>To</th>
	                    	</tr></thead><tbody>';
					$i=1;
					foreach($emp_last5yrstay_details as $row)
					{
						echo '<tr name=row[] align="center">
								<td>'.$i.'</td>
			    				<td>'.date('d M Y', strtotime($row->from)).'</td>
			    				<td>'.date('d M Y', strtotime($row->to)).'</td>
			    				<td>'.$row->res_addr.'</td>
			    				<td>'.ucwords($row->dist_hq_name).'</td>
								<td>';
	                                	$ui->button()->flat()->id('edit'.$i)->name("edit[]")->uiType("primary")->value("Edit")->icon($ui->icon("pencil"))->extras('onClick="onclick_edit('.$i.')"')->show();
	                                    $ui->button()->flat()->id('delete5'.$i)->name("delete5[]")->uiType("danger")->value("Delete")->icon($ui->icon("trash-o"))->extras('onClick="onclick_delete('.$i.');"')->show();
	                    echo   '</td></tr>';

			    		$this->emp_last5yrstay_details_model->update_record(array('sno'=>$i),array('id'=>$emp_id,
			    																	'from'=>$row->from,
			    																	'to'=>$row->to,
		    																		'res_addr'=>$row->res_addr,
		    																		'dist_hq_name'=>$row->dist_hq_name));
						$i++;
					}
					echo '</tbody>';
				}
				else
					$ui->callout()->title('Empty')->desc('No Stay Details Found.')->uiType('danger')->show();
				break;
	}

?>