<?php
	$course_name=$CS_session['course_name'];
    $course_duration=$CS_session['duration'];
    $branch_name=$CS_session['branch_name'];
    $aggr_id= $CS_session['aggr_id'];
    $session=$CS_session['session'];
    echo $CS_session['course_name']." ";
    echo "(".$branch_name.") Applicable from the Session ".$session;
	if($CS_session["semester"] != 0)
	{
		$start_semester = $CS_session["semester"];
		$course_duration = 1;
		$end_semester = $start_semester;
	}
	else
	{
		$start_semester = 1;
		$end_semester = 2*$course_duration;
	}	
    for($semester=$start_semester;$semester<=$end_semester;$semester++)
	{
		
		$elective_name = 1;
		$ui = new UI();
		echo "<h3>Subjects for Semester". $semester."<br></h3>";	
		$table = $ui->table()->responsive()->hover()->bordered()->open();
			echo '
				<tr>
				  <th>Sl. No</th>
				  <th>Subject ID</th>
				  <th>Subject Name</th>
				  <th>Lecture</th>
				  <th>Tutorial</th>
				  <th>Practical</th>
				  <th>Credit Hours</th>
				  <th>Contact Hours</th>
				  <th>Elective</th>
				  <th style = "width:15px;">Type</th>
				</tr>';
				
			for($i=1;$i<=$subjects["count"][$semester];$i++)
			{
				if(isset($subjects["group_details"][$semester][$i]->group_id))
				{
				echo '
				<tr>
					<td colspan="10" align="center">';
						echo "Elective ".$elective_name++;
						//echo $subjects["group_details"][$semester][$i]->elective_name;
						$group_id = $subjects["group_details"][$semester][$i]->group_id;
				echo'
					</td>
				</tr>';
				for($j = 0;$j<$subjects["elective_count"][$group_id];$j++)
				{
					$seq_no = intval($i)+intval($j);
				echo 
				'<tr>
					<td>';
						echo $subjects["sequence_no"][$semester][$i+$j];
						echo '
					</td>
					<td>';
						echo $subjects["subject_details"][$semester][$i+$j]->subject_id;
				echo '
					</td>
					<td>';
						echo $subjects["subject_details"][$semester][$i+$j]->name;
				echo '
					</td>
					<td>';
						echo $subjects["subject_details"][$semester][$i+$j]->lecture;
				echo '
					</td>
					<td>';
						echo $subjects["subject_details"][$semester][$i+$j]->tutorial;
				echo '
					</td>
					<td>';
						echo $subjects["subject_details"][$semester][$i+$j]->practical;
				echo '
					</td>
					<td>';
						echo $subjects["subject_details"][$semester][$i+$j]->credit_hours;
				echo '
					</td>
					<td>';
						echo $subjects["subject_details"][$semester][$i+$j]->contact_hours;
				echo '
					</td>
					<td>';
						  if($subjects["subject_details"][$semester][$i+$j]->elective==0) 
							 echo "No";
						  else 
							echo "Yes";
				echo '
					</td>
					<td>';
					  if($subjects["subject_details"][$semester][$i+$j]->type=="Theory") echo "Theory";
					  if($subjects["subject_details"][$semester][$i+$j]->type=="Practical") echo "Practical";
					  if($subjects["subject_details"][$semester][$i+$j]->type=="Sessional") echo "Sessional";
					  if($subjects["subject_details"][$semester][$i+$j]->type =="Non-Contact") echo "Non-Contact";
				echo '
					</td>			
				</tr>';	
				}//for closed..
				//adding extra row to differtiate between elective and core subjects.
				echo '<tr><td colspan = "10"></td></tr>';
					$i = $j+$i-1;
				}//if closed.
				else
				{
					//if(isset($subjects["subject_details"][$semester]))
					//{
				echo '
				<tr>
					<td>';
						echo $subjects["sequence_no"][$semester][$i];
						echo '
					</td>
					<td>';
						echo $subjects["subject_details"][$semester][$i]->subject_id;
					echo '
					</td>
					<td>';
						echo $subjects["subject_details"][$semester][$i]->name;
					echo '
					</td>
					<td>';
						echo $subjects["subject_details"][$semester][$i]->lecture;
					echo '
					</td>
					<td>';
						echo $subjects["subject_details"][$semester][$i]->tutorial;
					echo '
					</td>
					<td>';
						echo $subjects["subject_details"][$semester][$i]->practical;
					echo '
					</td>
					<td>';
						echo $subjects["subject_details"][$semester][$i]->credit_hours;
					echo '
					</td>
					<td>';
						echo $subjects["subject_details"][$semester][$i]->contact_hours;
					echo '
					</td>
					<td>';
					 
						  if($subjects["subject_details"][$semester][$i]->elective==0) 
							 echo "No";
						  else 
							echo "Yes";
				echo '
					</td>
					<td>';
					  if($subjects["subject_details"][$semester][$i]->type=="Theory") echo "Theory";
					  if($subjects["subject_details"][$semester][$i]->type=="Practical") echo "Practical";
					  if($subjects["subject_details"][$semester][$i]->type=="Sessional") echo "Sessional";
					  if($subjects["subject_details"][$semester][$i]->type =="Non-Contact") echo "Non-Contact";
				echo '
					</td>			
				</tr>';
			//}
				}//else closed
			}//inner for loop 
				   $aggr_id = $CS_session['aggr_id'];
		$table->close();
	}
  
?>