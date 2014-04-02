<?php
	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	$emp=$_SESSION['EDIT_EMP'];
	$s=$_GET['s'];
	$qry=mysql_query("DELETE FROM emp_education_details WHERE id='".$emp."' AND sno=".$s);
	notify($emp, "Details Edited", "Your educational details have been successfully edited by Data Entry Operator ".$_SESSION['id'], "show_emp.php?form_name=3","success");
	$i=1;
	$edu_detail=mysql_query("select * 
							from emp_education_details
							where id='".$emp."'");

	if(mysql_num_rows($edu_detail)!=0)
	{
		echo '<tr>
					 <th>S no.</th>
				     <th>Examination</th>
				     <th>Course(Specialization)</th>
				   	 <th>College/University/Institute</th>
				     <th>Year</th>
				     <th>Percentage/Grade</th>
				     <th>Class/Division</th>
					 <th>Edit/Delete</th>
				</tr>';
				
		while($row=mysql_fetch_row($edu_detail))
		{
			echo '<tr name="row[]" align="center">
						<td>'.$i.'</td>
				    	<td>'.strtoupper($row[2]).'</td>
				    	<td>'.strtoupper($row[3]).'</td>
				    	<td>'.strtoupper($row[4]).'</td>
				    	<td>'.$row[5].'</td>
				    	<td>'.strtoupper($row[6]).'</td>
				    	<td>'.ucwords($row[7]).'</td>
						<td>
							<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$i.')">
							<input type="button" class="error" name="delete4[]" value="Delete" onClick="onclick_delete('.$i.');" >
						</td>
				    </tr>';
			mysql_query("update emp_education_details set sno=".$i." where id='".$emp."' and exam='".$row[2]."' and branch='".$row[3]."' and institute='".$row[4]."' and year='".$row[5]."' and grade='".$row[6]."' and division='".$row[7]."'");
			$i++;
		}
	}
	mysql_close();
?>