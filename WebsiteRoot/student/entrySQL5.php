<?php
	require_once("../Includes/Auth.php");
	auth('deo');
	require_once("connectDB.php");
	
	function generate_random_string($name_length = 8) 
	{
		$alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		return substr(str_shuffle($alpha_numeric), 0, $name_length);
	}
	
	$res=mysql_query("SELECT * FROM  stu_current_entry");
	$row=mysql_fetch_array($res);
	$stu_id=$row[0];
	
	
	if(isset($_POST['submit']))
	{
		$AuthId='stu';
		$date=date("Y-m-d H:i:s",time()+(19800));
		$pass="p";
		mysql_query("UPDATE users SET
					password='".encode_password($pass, $date)."',
					created_date='$date'
					WHERE id='$stu_id'");
		//mysql_query("INSERT INTO users
		//				VALUES ('$stu_id','".encode_password($pass, $date)."','$AuthId','$date')");
		
		#email the user and pass
		$email_query=mysql_query("SELECT email FROM user_details WHERE id='".$stu_id."'");
		$row=mysql_fetch_row($email_query);
			$to = $row[0];
			$subject = "Registration on Online ISM MIS Portal";
			$message = "You are registered on the Online ISM MIS Portal. Your Username and password are \n Username:".$stu_id ."\n Password:".$pass;
			$from = "xyz@example.com";
			$headers = "From:" . $from;
//			mail($to,$subject,$message,$headers);
			echo "Mail Sent";
		
		$_SESSION['STU_CURRSTEP'] = 5;
		header('Location: index.php?success='.$stu_id.'&pass='.$pass);
		$next_step="DELETE FROM stu_current_entry";
		mysql_query($next_step);
	}
	else
	{
		echo mysql_error();		
	}
	mysql_close();
?>