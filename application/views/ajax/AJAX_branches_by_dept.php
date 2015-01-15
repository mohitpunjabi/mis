<?php
	require_once("../Includes/Auth.php");
	auth('deo');
	require_once("connectDB.php");
	
	$dept=$_GET['dept'];
	//$stuquery=mysql_query("select id,name from branches where dept_id='".$dept."'");
	$stuquery=mysql_query("select id,name from courses where dept_id='".$dept."'");
	if(mysql_num_rows($stuquery)==0)
	{
		echo '<td>No Branches in the Department</td>';
	}
	else
	{
		echo '<td><select id="branch_id" name="branch_id" onchange="options_of_courses();">';
		echo '<option disabled="disabled" selected="selected">Select Branch</option>';
		while($row=mysql_fetch_row($stuquery))
		{
			echo '<option value="'.$row[0].'">'.$row[1].'</option>';
		}
		echo '</select></td>';
	}
	mysql_close();
?>