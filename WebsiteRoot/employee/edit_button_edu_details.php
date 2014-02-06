<?php
	require_once("../Includes/Auth.php");
	auth();

	require_once("connectDB.php");
	
	$emp=$_SESSION['EDIT_EMP'];
	$e=$_GET['e'];
	$edu_detail=mysql_query("select * 
							from emp_education_details 
							where id='".$emp."' and sno=".$e);
							
	if(mysql_num_rows($edu_detail)!=0)
	{
		$row=mysql_fetch_row($edu_detail);
	
			echo '	<td>'.$e.'</td>
					<td><input type="text" name="exam'.$e.'" id="exam'.$e.'" value="'.$row[2].'" /></td>
		            <td><input type="text" name="branch'.$e.'" id="branch'.$e.'" value="'.$row[3].'" /></td>
		            <td><input type="text" name="clgname'.$e.'" id="clgname'.$e.'" value="'.$row[4].'" /></td>
        		    <td><input type="text" name="year'.$e.'" id="year'.$e.'" value="'.$row[5].'" /></td>
		            <td><input type="text" name="grade'.$e.'" id="grade'.$e.'" value="'.$row[6].'" /></td>
		            <td><input type="text" name="div'.$e.'" id="div'.$e.'" value="'.$row[7].'" /></td>
					<td>
						<input type="button" name="save" value="Save" onClick="onclick_save('.$e.')">
						<input type="button" class="error" name="delete4[]" value="Delete" onClick="onclick_delete('.$e.');" >
					</td>';
	}
	mysql_close();
?>