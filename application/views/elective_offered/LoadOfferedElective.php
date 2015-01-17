<div id="container">
	<h1>Select Electives to offer</h1>
    <?php
	$form_attrinutes = array("id"=>"add_course_form");
    echo form_open('elective_offered/elective_offered/CreateMapping',$form_attrinutes);
    	echo '
			<table>';
				foreach($group_id as $key=>$val)
				{
					echo '
						<tr>
							<th colspan = "8">';
								echo $elective_name[$key];	
							echo '
							</th>
						</tr>
						<tr>
							<th>						
							</th>
							<th>
								Subject ID
							</th>
							<th>
								Subject Name
							</th>
							<th>
								Lecture
							</th>
							<th>
								Tutorial
							</th>
							<th>
								Practical
							</th>
							<th>
								Credit Hours
							</th>
							<th>
								Contact Hours
							</th>
						</tr>';
						
							for($i = 0;$i<$subject[$val]['count'];$i++)
							{
								echo '
						<tr>
							<td>
								<input type = "checkbox" name = "checkbox[]" value = "'.$subject[$val]['id'][$i].'" />							
							</td>
							<td>';
								echo $subject[$val]['subject_id'][$i];
							echo '	
							</td>
							<td>';
								echo $subject[$val]['subject_name'][$i];
							echo '
							</td>
							<td>';
								echo $subject[$val]['lecture'][$i];
							echo '
							</td>
							<td>';
								echo $subject[$val]['tutorial'][$i];
							echo '
							</td>
							<td>';
								echo $subject[$val]['practical'][$i];
							echo '
							</td>
							<td>';
								echo $subject[$val]['credit_hours'][$i];
							echo '
							</td>
							<td>';
								echo $subject[$val]['contact_hours'][$i];
							echo '
							</td>
						</tr>';	
							}
						
				}
			echo '
				<tr>
					<td colspan = "8">
						<input type = "submit" value = "Select Elective" />
					</td>
				</tr>
			</table>
		';
    echo form_close();
	?>
</div>