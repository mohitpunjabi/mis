<div id="container">
	<h1>Welcome to Course Structure Page!</h1>
  <center><h3>Course Structure for  
  <?php
 
    $course_name=$CS_session['course_name'];
    $course_duration=$CS_session['duration'];
    $branch_name=$CS_session['branch_name'];
    $aggr_id= $CS_session['aggr_id'];
    $session=$CS_session['session'];
    echo $CS_session['course_name']." ";
    echo "(".$branch_name.")"."<br>";
    echo "Applicable for the Session "."20".$session[0].$session[1]."-20".$session[2].$session[3];
  ?>
  </h3>
  <?php
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
        echo "<h3>Subjects for Semester". $semester."<br></h3>";
  ?>
  <table border="1">
    <tr>
      <th style = "width:15px;">Sl. No</th>
      <th style = "width:70px;">Subject ID</th>
      <th style = "width:80px;">Subject Name</th>
      <th>Lecture</th>
      <th>Tutorial</th>
      <th>Practical</th>
      <th style = "width:15px;">Credit Hours</th>
      <th style = "width:15px;">Contact Hours</th>
      <th>Elective</th>
      <th style = "width:15px;">Type</th>
      <th style = "width:15px;">Edit</th>
    </tr>
  		<?php
        for($i=1;$i<=$subjects["count"][$semester];$i++)
        {
            if(isset($subjects["group_details"][$semester][$i]->group_id))
			{
				echo "<tr><td colspan='10' style = 'text-align:center;font-size:16px;font-weight:bold;'>".$subjects["group_details"][$semester][$i]
				->elective_name."</td></tr>";
				$group_id = $subjects["group_details"][$semester][$i]->group_id;
				for($j = 0;$j<$subjects["elective_count"][$group_id];$j++)
				{
					
		?>
        			<?php
						$seq_no = intval($i)+intval($j);
                    	echo 
						'<tr>
							<td>';
								echo $subjects["sequence_no"][$semester][$i+$j];
								echo '
							</td>
							<td>
								<input disabled style = "width:70px;" type = "text" name = "subjectid_'.$semester.'_'.$seq_no.'" value = "'.
								$subjects["subject_details"][$semester][$i+$j]->subject_id.'"></input>
							</td>
							<td>
								<input disabled style = "width:120px;" type = "text" name = "subjectname_'.$semester.'_'.$seq_no.'" value = "'.
								$subjects["subject_details"][$semester][$i+$j]->name.'"></input>
							</td>
							<td>
								<input disabled type = "text" name = "subjectL_'.$semester.'_'.$seq_no.'" value = "'.$subjects["subject_details"][
								$semester][$i+$j]->lecture.'"></input>
							</td>
							<td>
								<input disabled type = "text" name = "subjectT_'.$semester.'_'.$seq_no.'" value = "'.$subjects["subject_details"][
								$semester][$i+$j]->tutorial.'" ></input>
							</td>
							<td>
								<input disabled type = "text" name = "subjectP_'.$semester.'_'.$seq_no.'" value = "'.$subjects["subject_details"][
								$semester][$i+$j]->practical.'" ></input>
							</td>
							<td>
								<input disabled type = "text" name = "subjectcredithours_'.$semester.'_'.$seq_no.'" value = "'.$subjects[
								"subject_details"][$semester][$i+$j]->credit_hours.'" ></input>
							</td>
							<td>
								<input disabled type = "text" name = "subjectcontacthours_'.$semester.'_'.$seq_no.'" value = "'.$subjects[
								"subject_details"][$semester][$i+$j]->contact_hours.'"></input>
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
							<td>';
								$seq_no = intval($i)+intval($j);
						echo '
								<input id = "editbutton_'.$semester.'_'.$seq_no.'" type = "button" name = "editbutton()" value = "Edit" style = 
								"width:50px;" onclick = EditSubject("'.$semester.'","'.$seq_no.'")></input>
							</td>		
						</tr>';	
				}//for closed..
				$i = $j+$i-1;
				}//if closed.
				else
				{
					if(isset($subjects["subject_details"][$semester]))
					{
						echo '
							<tr>
								<td>';
									echo $subjects["sequence_no"][$semester][$i];
									echo '
								</td>
								<td>
									<input disabled style = "width:70px;" type = "text" name = "subjectid_'.$semester.'_'.$i.'" value = "'.$subjects[
									"subject_details"][$semester][$i]->subject_id.'" ></input>
								</td>
								<td>
									<input disabled style = "width:120px;" type = "text" name = "subjectname_'.$semester.'_'.$i.'" value = "'.$subjects[
									"subject_details"][$semester][$i]->name.'"></input>
								</td>
								<td>
									<input disabled type = "text" name = "subjectL_'.$semester.'_'.$i.'" value = "'.$subjects["subject_details"][$semester
									][$i]->lecture.'"></input>
								</td>
								<td>
									<input disabled type = "text" name = "subjectT_'.$semester.'_'.$i.'" vlaue = "'.$subjects["subject_details"][$semester
									][$i]->tutorial.'"></input>
								</td>
								<td>
									<input disabled type = "text" name = "subjectP_'.$semester.'_'.$i.'" value = "'.$subjects["subject_details"][$semester
									][$i]->practical.'"></input>
								</td>
								<td>
									<input disabled type = "text" name = "subjectcredithours_'.$semester.'_'.$i.'" value = "'.$subjects["subject_details"][
									$semester][$i]->credit_hours.'"></input>
								</td>
								<td>
									<input disabled type = "text" name = "subjectcontacthours_'.$semester.'_'.$i.'" value = "'.$subjects["subject_details"
									][$semester][$i]->contact_hours.'"></input>
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
								<td>
										<input id = "editbutton_'.$semester.'_'.$i.'" type = "button" name = "editbutton()" value = "Edit" style = "width:50px;" onclick = 
										EditSubject("'.$semester.'","'.$i.'")></input>
								</td>		
							</tr>';
					}
				}//else closed
           }//inner for loop 
		   $aggr_id = $CS_session['aggr_id'];
	echo '
					<tr>
						<td>
							<input type = "button" onclick = DeleteSemester("'.$semester.'","'.$aggr_id.'") value = "Delete" ></input>
						</td>
					</tr>
  	</table>';
      }
  ?>
  </table>
  </center>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
