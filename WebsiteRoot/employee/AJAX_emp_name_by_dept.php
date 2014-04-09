<?php
	require_once("../Includes/Auth.php");
	auth();
	require_once("connectDB.php");
	
	$dept=$_GET['dept'];
	echo '<th>Employee name</th>';
	$empquery=mysql_query("select id,first_name,last_name,auth_id from user_details natural join users where dept_id='".$dept."' and auth_id='emp'");
	if(mysql_num_rows($empquery)==0)
	{
		echo '<td>No Employee in this department</td>';
	}
	else
	{
		echo '<td><select id="emp_name_id" onchange="onclick_emp_nameid();">';
		echo '<option disabled="disabled" selected="selected">Select Employee</option>';
		while($row=mysql_fetch_row($empquery))
		{
			echo '<option value="'.$row[0].'">'.$row[1].' '.$row[2].'('.$row[0].')</option>';
		}
		echo '</select></td>';
	}
	mysql_close();
?>