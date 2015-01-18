<?php
	switch($form)
	{
		case 2: $emp_prev_exp_details = $this->emp_prev_exp_details_model->getEmpPrevExpById($emp_id);
				if($emp_prev_exp_details)
				{
					echo '<tr>
							<th rowspan="2">S no.</th>
					        <th rowspan="2">Full address of Employer</th>
							<th rowspan="2">Position held</th>
					        <th colspan="2">Organization</th>
					        <th rowspan="2">Pay Scale</th>
					        <th rowspan="2">Remarks</th>
			    		    <th rowspan="2">Edit/Delete</th>
						</tr>
						<tr>
							<th>From</th>
							<th>To</th>
						</tr>';
					$i=1;
					foreach($emp_prev_exp_details as $row)
					{
						if($row->remarks == "")	$remarks='';
						else	$remarks = $row->remarks;
						echo '<tr name="row[]" align="center">
								<td>'.$i.'</td>
								<td>'.ucwords($row->address).'</td>
			    				<td>'.ucwords($row->designation).'</td>
			    				<td>'.date('d M Y', strtotime($row->from)).'</td>
			    				<td>'.date('d M Y', strtotime($row->to)).'</td>
			    				<td>'.$row->pay_scale.'</td>
		    					<td>'.ucfirst($remarks).'</td>
								<td>
									<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$i.',\''.$row->from.'\',\''.$row->to.'\',\''.$joining_date.'\')">
									<input type="button" class="error" name="delete2[]" value="Delete" onClick="onclick_delete('.$i.');" >
								</td>
			    			</tr>';
			    		$this->emp_prev_exp_details_model->update_record(array('sno'=>$i),array('id'=>$emp_id,
			    																				'designation'=>$row->designation,
			    																				'from'=>$row->from,
			    																				'to'=>$row->to,
			    																				'pay_scale'=>$row->pay_scale,
			    																				'address'=>$row->address,
			    																				'remarks'=>$row->remarks));
						$i++;
					}
				}
				else
					$this->notification->drawNotification("Empty","No previous employment details found.","error");
				break;

		case 4: $emp_education_details = $this->emp_education_details_model->getEmpEduById($emp_id);
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
				break;
	}

?>

