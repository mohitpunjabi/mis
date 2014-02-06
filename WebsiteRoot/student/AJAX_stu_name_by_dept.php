<?php	require_once("../Includes/Auth.php");
	auth();

	require_once("connectDB.php");
	
	$dept=$_GET['dept'];
	echo '<th>Student name</th>';
	$stuquery=mysql_query("select id,first_name,middle_name from user_details NATURAL JOIN users where dept_id='".$dept."' and auth_id='stu' ");
	if(mysql_num_rows($stuquery)==0)
	{
		echo '<td>No Student in this department</td>';
	}
	else
	{
		echo '<td><select id="stu_name_id" onchange="onclick_stu_nameid();">';
		echo '<option disabled="disabled" selected="selected">Select Student</option>';
		while($row=mysql_fetch_row($stuquery))
		{
			echo '<option value="'.$row[0].'">'.$row[1].' '.$row[2].'('.$row[0].')</option>';
		}
		echo '</select></td>';
	}
	mysql_close();
?>