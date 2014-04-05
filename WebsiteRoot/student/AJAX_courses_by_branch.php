<?php
	require_once("../Includes/Auth.php");
	auth('deo');
	require_once("connectDB.php");
	
	$branch=$_GET['branch'];
	//echo $branch;
	//die();
	//$stuquery=mysql_query("select courses.id,courses.name from courses,course_branch where courses.id=course_branch.course_id AND course_branch.branch_id='".$branch."'");
	$stuquery=mysql_query("select id,name from courses where id=(select course_id from course_branch where branch_id='".$branch."')");
	if(mysql_num_rows($stuquery)==0)
	{
		echo '<td>No Courses in the Department</td>';
	}
	else
	{
		echo '<td><select id="course_id" name="course_id">';
		echo '<option disabled="disabled" selected="selected">Select Course</option>';
		while($row=mysql_fetch_row($stuquery))
		{
			echo '<option value="'.$row[0].'">'.$row[1].'</option>';
		}
		echo '</select></td>';
	}
	mysql_close();
?>