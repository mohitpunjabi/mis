<?php
	require_once("../Includes/Auth.php");
	require_once("../Includes/Layout.php");
	auth();

	require_once("connectDB.php");
	
	// not using this function
	/*
	function generate_random_string($name_length = 8) 
	{
		$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		return substr(str_shuffle($alpha_numeric), 0, $name_length);
	}
	*/
	
	$res=mysql_query("SELECT * FROM  emp_current_entry ");
	$row=mysql_fetch_array($res);
	$emp_id=$row[0];
	$count=count($_POST['from5']);
	$i=0;
	$result=true;
	while($_POST['from5'][$i]!=""  &&  $i<$count)
	{
		$sno=$i+1;
		$qry = "INSERT INTO emp_last5yrstay_details 
				VALUES ('$emp_id','$sno','".$_POST['from5'][$i]."','".$_POST['to5'][$i]."',
						'".clean($_POST['addr5'][$i])."','".clean(strtolower($_POST['dist5'][$i]))."')";
		$result=mysql_query($qry);
		if(!$result)	break;
		$i++;
	}
	if($result)
	{
		/* this work will be done by nodal officer
		$AuthId='emp';
		$date=date("Y-m-d H:i:s",time()+(19800));
		$pass="p";
		mysql_query("UPDATE users
						SET password='".encode_password($pass, $date)."', created_date='$date'
						WHERE id='$emp_id'");
		
		#email the user and pass
		$email_query=mysql_query("SELECT email FROM user_details WHERE id='".$emp_id."'");
		$row=mysql_fetch_row($email_query);
			$to = $row[0];
			$subject = "Registration on Online ISM MIS Portal";
			$message = "You are registered on the Online ISM MIS Portal. Your Username and password are \n Username:".$emp_id ."\n Password:".$pass;
			$from = "xyz@example.com";
			$headers = "From:" . $from;
//			mail($to,$subject,$message,$headers);
			echo "Mail Sent";
		*/
		$date=date("Y-m-d H:i:s",time()+(19800));
		
		$nodal_query=$mysqli->query("SELECT id FROM user_auth_types WHERE auth_id='est_ar'");
		if($nodal_query->num_rows==0)
		{
			echo 'Who will provide validation? There is no nodal officer in user_auth_types (auth_id=\'est_ar\')';
			$pass="p";
			mysql_query("UPDATE users
						SET password='".encode_password($pass, $date)."', created_date='$date'
						WHERE id='$emp_id'");
			$_SESSION['EMP_CURRSTEP'] = 5;
			header('Location: index.php?error='.$emp_id.'&pass='.$pass);
			mysql_query("DELETE FROM emp_current_entry");
		}
		else
		{
			$emp_name_query=$mysqli->query("select salutation,first_name,last_name from user_details where id='$emp_id'");
			$emp_name_row=$emp_name_query->fetch_assoc();
			$emp_name=$emp_name_row['salutation'].' '.$emp_name_row['first_name'].' '.$emp_name_row['last_name'];
			while($no=$nodal_query->fetch_assoc())
			{
				notify($no['id'], "Validation Request", "Please validate ".$emp_name." details", "validate_step.php?emp=".$emp_id);
			}
			
			//check for optional steps i.e previous_exp,family,stay details
			$prev_query=$mysqli->query("select count(*) from emp_prev_exp_details where id='$emp_id'");
			$prev_row=$prev_query->fetch_row();
			if($prev_row[0]==0)
				$prev='approved';
			else
				$prev='pending';
				
			$fam_query=$mysqli->query("select count(*) from emp_family_details where id='$emp_id'");
			$fam_row=$fam_query->fetch_row();
			if($fam_row[0]==0)
				$fam='approved';
			else
				$fam='pending';
				
			$stay_query=$mysqli->query("select count(*) from emp_last5yrstay_details where id='$emp_id'");
			$stay_row=$stay_query->fetch_row();
			if($stay_row[0]==0)
				$stay='approved';
			else
				$stay='pending';
				
			$v_query=$mysqli->query("INSERT INTO emp_validation_details VALUES ('".$emp_id."','pending','pending','".$prev."','".$fam."','pending','".$stay."','".$date."')");
			
			$_SESSION['EMP_CURRSTEP'] = 5;
			header('Location: index.php?validation='.$emp_id);
			mysql_query("DELETE FROM emp_current_entry");
		}
	}
	else
	{
		echo mysql_error();		
	}
	mysql_close();
?>