<?php	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	$emp=$_SESSION['EDIT_EMP'];
	$sno=$_GET['s'];
	$exam=$_GET['e'];
	$branch=$_GET['b'];
	$clgname=$_GET['c'];
	$year=$_GET['y'];
	$grade=$_GET['g'];
	$div=$_GET['d'];
	
	$updateedu_detail=mysql_query("update emp_education_details 
									set 
									exam='".clean(strtolower($exam))."',
									branch='".clean(strtolower($branch))."',
									institute='".clean(strtolower($clgname))."' ,
									year='".clean(strtolower($year))."' ,
									grade='".clean(strtolower($grade))."' ,
									division='".clean(strtolower($div))."' 
									where id='".$emp."' and sno=".$sno);

	if($updateedu_detail)
	{	
		$date=date("Y-m-d H:i:s",time()+(19800));
		//sending for validation
		$find_entry=$mysqli->query("select * from emp_validation_details where id='".$emp."'");
		if($find_entry->num_rows!=0)
			$v_query=$mysqli->query("update emp_validation_details set educational_status='pending' where id='".$emp."'");
		else
			$v_query=$mysqli->query("INSERT INTO emp_validation_details VALUES ('".$emp."','approved','approved','approved','approved','pending','approved','".$date."')");

		//notify employee
		//new user query
		$newuser_query=$mysqli->query("select * from users where id='".$emp."' and password='' and auth_id='emp'");
		if($newuser_query->num_rows==0)	//old user
			notify($emp, "Details Edited", "Your educational details have been successfully edited by Data Entry Operator ".$_SESSION['id']." and sent for validation.", "show_emp.php?form_name=3");
		$emp_name_query=$mysqli->query("select salutation,first_name,last_name from user_details where id='".$emp."'");
		$emp_name_row=$emp_name_query->fetch_assoc();
		$emp_name=$emp_name_row['salutation'].' '.$emp_name_row['first_name'].' '.$emp_name_row['last_name'];
		//notify nodal officer
		$nodal_query=$mysqli->query("SELECT id FROM user_auth_types WHERE auth_id='est_ar'");
		while($no=$nodal_query->fetch_assoc())
		{
			notify($no['id'], "Validation Request", "Please validate ".$emp_name." details", "validate_step.php?emp=".$emp);
		}
	}
	$edu_detail=mysql_query("select * 
							from emp_education_details 
							where id='".$emp."' and  sno=".$sno);
							
	if(mysql_num_rows($edu_detail)!=0)
	{
		$row=mysql_fetch_row($edu_detail);
			echo '	<td>'.$sno.'</td>
			    	<td>'.strtoupper($row[2]).'</td>
			    	<td>'.strtoupper($row[3]).'</td>
			    	<td>'.strtoupper($row[4]).'</td>
			    	<td>'.$row[5].'</td>
			    	<td>'.strtoupper($row[6]).'</td>
			    	<td>'.ucwords($row[7]).'</td>
					<td>
						<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$sno.')">
						<input type="button" class="error" name="delete4[]" value="Delete" onClick="onclick_delete('.$sno.');" >
					</td>';
	}
	mysql_close();
?>