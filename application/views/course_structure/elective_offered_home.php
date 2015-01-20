<div id="container">
<?php
	$course_count = 0;
	$branch_count = 0;
	$batch_count = 0;
	$sem_count = 0;
	//echo "dept _ id = ".($dept_id);
	//var_dump($result_dept_course);
	//echo "curr session = ".$curr_session;
	foreach($course['name'] as $key=>$val)
		$course_count++;
		
	echo "course _count = ".$course_count;
	echo form_open('course_structure/elective_offered');
	echo '
		<table id="form_table">
			<tr>
				<td>
					Choose Course
				</td>
				<td>
					<select id="course" name = "course">
						<option value="0">Select Course</option>
					';

						for($i = 0;$i<4;$i++)
						{
							echo '<option  value = "'.$course['id'][$i].'">'.$course['name'][$i].'</option>';	
						}
					echo '
					</select>	
				</td>
			</tr>
			
		</table>
		<input type = "submit" value = "Submit" />
	';

?>
</div>

<!-- <tr>
				<td>
					Choose Branch
				</td>
				<td>
					<select name = "branch">';
						for($i = 0;$i<$branch_count;$i++)
						{
							echo '<option value = "'.$branch['id'][$i].'">'.$branch['name'][$i].'</option>';	
						}
					echo '
				</td>
			</tr>
			<tr>
				<td>
					Choose Batch
				</td>
				<td>
					<select name = "batch">';
						for($i = 0;$i<$batch_count;$i++)
						{
							echo '<option value = "'.$batch[$i].'">'.$batch[$i].'</option>';	
						}
					echo '
				</td>
			</tr>
			<tr>
				<td>
					Choose Semester
				</td>
				<td>
					<select name = "semester">';
						for($i = 0;$i<$sem_count;$i++)
						{
							echo '<option value = "'.$semester[$i].'">'.$semester[$i].'</option>';	
						}
					echo '
				</td>
			</tr> -->