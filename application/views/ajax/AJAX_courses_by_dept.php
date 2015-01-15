<?php
	require_once("../Includes/Auth.php");
	auth('deo');
	require_once("connectDB.php");
	
	$dept=$_GET['dept']; // this is used to select courses offered by the selected department
	
	//$stuquery=mysql_query("select id,name from branches where dept_id='".$dept."'");
	$stuquery=mysql_query("select course_id,course_name from course where dept_id='".$dept."'");
	if(mysql_num_rows($stuquery)==0)
	{
		echo '<td> Department does not run any course </td>';
	}
	else
	{
		echo '<td><select id="course_id" name="course_id" onchange="options_of_branches();">';
		echo '<option disabled="disabled" selected="selected">Select Course</option>';
		while($row=mysql_fetch_row($stuquery))
		{
			echo '<option value="'.$row[0].'">'.$row[1].'</option>';
		}
		echo '</select></td>';
	}
	mysql_close();
?>