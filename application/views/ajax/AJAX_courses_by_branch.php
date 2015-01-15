<?php
	require_once("../Includes/Auth.php");
	auth('deo');
	require_once("connectDB.php");
	
	$course=$_GET['course'];
	//$branch=$_GET['branch']; 
	//echo $course;
	//die();
	//$stuquery=mysql_query("select courses.id,courses.name from courses,course_branch where courses.id=course_branch.course_id AND course_branch.branch_id='".$branch."'");
	//$stuquery=mysql_query("select branch_id, branch_name from branch where course_id='".$course."')");
	$stuquery=mysql_query("select branch_id, branch_name from branch where course_id='".$course."'");
	//$stuquery=mysql_query("select branch_id, branch_name from branch where course_id='btcse'");
	if(mysql_num_rows($stuquery)==0)
	{
		echo '<td>The Department is not running any branch of the selected course at present </td>';
	}
	else
	{
		echo '<td><select id="branch_id" name="branch_id">';
		echo '<option disabled="disabled" selected="selected">Select Branch</option>';
		while($row=mysql_fetch_row($stuquery))
		{
			echo '<option value="'.$row[0].'">'.$row[1].'</option>';
		}
		echo '</select></td>';
	}
	mysql_close();
?>