<?php	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	$emp=$_SESSION['EDIT_EMP'];
	$sno=$_GET['s'];
	$prof=$_GET['p'];
	$addr=$_GET['a'];
	$dob=$_GET['d'];
	$active=$_GET['act'];
	if($active=="Active")
		$style="background:#DFD";
	else
		$style="background:#FDD";
	$updatefam_detail=mysql_query("update emp_family_details 
									set profession='".clean(strtolower($prof))."' , present_post_addr='".clean(strtolower($addr))."' , dob='".$dob."' , active_inactive='".$active."'
									where id='".$emp."' and sno=".$sno);
	if($updatefam_detail)
	{
		$date=date("Y-m-d H:i:s",time()+(19800));
		//sending for validation
		$find_entry=$mysqli->query("select * from emp_validation_details where id='".$emp."'");
		if($find_entry->num_rows!=0)
			$v_query=$mysqli->query("update emp_validation_details set family_details_status='pending' where id='".$emp."'");
		else
			$v_query=$mysqli->query("INSERT INTO emp_validation_details VALUES ('".$emp."','approved','approved','approved','pending','approved','approved','".$date."')");

		//notify employee
		$newuser_query=$mysqli->query("select * from users where id='".$emp."' and password='' and auth_id='emp'");
		if($newuser_query->num_rows==0)	//old user
			notify($emp, "Details Edited", "Your dependent family member details have been successfully edited by Data Entry Operator ".$_SESSION['id']." and sent for validation.", "show_emp.php?form_name=2");
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
	
	$fam_detail=mysql_query("select * 
							from emp_family_details 
							where id='".$emp."' and sno=".$sno);
							
	if(mysql_num_rows($fam_detail)!=0)
	{
		$row=mysql_fetch_row($fam_detail);
			echo '	<td>'.$sno.'</td>
			    	<td>'.ucwords($row[2]).'</td>
				    <td>'.$row[3].'</td>
					<td>'.date('d M Y', strtotime($row[7])).'<br>(Age: '.floor((time() - strtotime($row[7]))/(365*24*60*60)).' years)</td>
				    <td>'.ucwords($row[4]).'</td>
				   	<td>'.$row[5].'</td>
					<td style="'.$style.'">'.$row[8].'</td>
			    	<td><img src="Images/'.$emp.'/'.$row[6].'" name="image3[]" width="145" height="150"/></td>
					<td>
						<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$sno.')"><br>
					</td>';
	}
	mysql_close();
?>