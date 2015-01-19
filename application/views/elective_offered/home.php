<div id="container">
<?php
	$course_count = 0;
	$branch_count = 0;
	$batch_count = 0;
	$sem_count = 0;
	foreach($course['name'] as $key=>$val)
		$course_count++;
	/*foreach($branch['name'] as $key=>$val)
		$branch_count++;
	foreach($batch as $key=>$val)
		$batch_count++;
	foreach($semester as $key=>$val)
		$sem_count++;*/
	
	//echo $batch_count;
	echo form_open('elective_offered/elective_offered');
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

						for($i = 0;$i<$course_count;$i++)
						{
							echo '<option data-duration="'.$course['duration'][$i].'" value = "'.$course['id'][$i].'">'.$course['name'][$i].'</option>';	
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