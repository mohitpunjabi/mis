<?php	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	$emp=$_SESSION['EDIT_EMP'];
	$sno=$_GET['s'];
	$addr=$_GET['a'];
	$designation=$_GET['d'];
	$from=$_GET['f'];
	$to=$_GET['t'];
	$payscale=$_GET['p'];
	$reason=$_GET['r'];
	
	$updateprev_detail=mysql_query("update emp_prev_exp_details 
									set 
									designation='".clean(strtolower($designation))."' ,
									`from`='".$from."' ,
									`to`='".$to."' ,
									pay_scale='".clean(strtolower($payscale))."' ,
									address='".clean(strtolower($addr))."' ,
									remarks='".clean(strtolower($reason))."' 
									where id='".$emp."' and sno=".$sno);
	if($updateprev_detail)
	{
		$date=date("Y-m-d H:i:s",time()+(19800));
		//sending for validation
		$find_entry=$mysqli->query("select * from emp_validation_details where id='".$emp."'");
		if($find_entry->num_rows!=0)
			$v_query=$mysqli->query("update emp_validation_details set prev_exp_status='pending' where id='".$emp."'");
		else
			$v_query=$mysqli->query("INSERT INTO emp_validation_details VALUES ('".$emp."','approved','approved','pending','approved','approved','approved','".$date."')");

		//notify employee
		//new user query
		$newuser_query=$mysqli->query("select * from users where id='".$emp."' and password='' and auth_id='emp'");
		if($newuser_query->num_rows==0)	//old user
			notify($emp, "Details Edited", "Your previous employment details have been successfully edited by Data Entry Operator ".$_SESSION['id']." and sent for validation.", "show_emp.php?form_name=1");
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
	
	$prev_detail=mysql_query("select * 
							from emp_prev_exp_details 
							where id='".$emp."' and sno=".$sno);
							
	if(mysql_num_rows($prev_detail)!=0)
	{
			$prev_emp=mysql_fetch_assoc($prev_detail);
			echo '	<td>'.$sno.'</td>
					<td>'.ucwords($prev_emp['address']).'</td>
			    	<td>'.ucwords($prev_emp['designation']).'</td>
			    	<td>'.date('d M Y', strtotime($prev_emp['from'])).'</td>
			    	<td>'.date('d M Y', strtotime($prev_emp['to'])).'</td>
			    	<td>'.$prev_emp['pay_scale'].'</td>
			    	<td>'.ucfirst($prev_emp['remarks']).'</td>
					<td>
						<input type="button" name="edit[]" value="Edit" onClick="onclick_edit('.$sno.')">
						<input type="button" class="error" name="delete2[]" value="Delete" onClick="onclick_delete('.$sno.');" >
					</td>';
	}
	mysql_close();
?>