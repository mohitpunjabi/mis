<?php
	require_once("../Includes/Auth.php");
	auth();

	require_once("connectDB.php");
	
	// not using this function
	function generate_random_string($name_length = 8) 
	{
		$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		return substr(str_shuffle($alpha_numeric), 0, $name_length);
	}
	
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
		
		$_SESSION['EMP_CURRSTEP'] = 5;
		header('Location: index.php?success='.$emp_id.'&pass='.$pass);
		$next_step="DELETE FROM emp_current_entry";
		mysql_query($next_step);
	}
	else
	{
		echo mysql_error();		
	}
	mysql_close();
?>