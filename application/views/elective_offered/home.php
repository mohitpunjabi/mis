<div id="container">
<?php
//echo "userid = ".	var_dump($batch);
//echo "FLAG = ".var_dump($flag);
	//echo "courses = ".$course['name'];
	//echo "branch = ".	var_dump($branch['name']);
	//echo "userid = ".	var_dump($session);
	
	echo form_open('elective_offered/elective_offered');
	echo '
		<table>
			<tr>
				<td>
					Choose Course
				</td>
				<td>';
					echo form_dropdown('course', $course['name'],'Select');
				echo ' 
				</td>
			</tr>
			<tr>
				<td>
					Choose Branch
				</td>
				<td>';
					echo form_dropdown('branch', $branch['name'],'Select');
				echo '
				</td>
			</tr>
			<tr>
				<td>
					Choose Batch
				</td>
				<td>';
					echo form_dropdown('batch', $batch,'Select');
				echo '
				</td>
			</tr>
			<tr>
				<td>
					Choose Semester
				</td>
				<td>';
					echo form_dropdown('semester', $semester,'Select');
				echo '
				</td>
			</tr>
			<tr>
				<td colspan = "2">
					<input type = "submit" value = "Submit" />
				</td>
			</tr>
		</table>
	';

?>
</div>