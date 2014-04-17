<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	auth("est_ar");
	require_once("connectDB.php");
	
	
	//new user query
	$newuser_query=$mysqli->query("select * from users where id='".$_SESSION['EMP_VALIDATE']."' and password='' and auth_id='emp'");

	//Approved
	if(isset($_POST['approve0']))
	{
		$approve0_query=$mysqli->query("update emp_validation_details set profile_pic_status='approved' where id='".$_SESSION['EMP_VALIDATE']."'");
		$check_reject0_query=$mysqli->query("delete from emp_reject_reason where id='".$_SESSION['EMP_VALIDATE']."' and step=0");
		if($newuser_query->num_rows==0)	//old user
			notify($_SESSION['EMP_VALIDATE'], "Validation Request Approved", "Your validation request for profile picture have been approved.", "show_emp.php?form_name=0","success");
	}
	if(isset($_POST['approve1']))
	{
		$approve1_query=$mysqli->query("update emp_validation_details set basic_details_status='approved' where id='".$_SESSION['EMP_VALIDATE']."'");
		$check_reject1_query=$mysqli->query("delete from emp_reject_reason where id='".$_SESSION['EMP_VALIDATE']."' and step=1");
		if($newuser_query->num_rows==0)	//old user
			notify($_SESSION['EMP_VALIDATE'], "Validation Request Approved", "Your validation request for basic details have been approved.", "show_emp.php?form_name=0","success");
	}
	if(isset($_POST['approve2']))
	{
		$approve2_query=$mysqli->query("update emp_validation_details set prev_exp_status='approved' where id='".$_SESSION['EMP_VALIDATE']."'");
		$check_reject2_query=$mysqli->query("delete from emp_reject_reason where id='".$_SESSION['EMP_VALIDATE']."' and step=2");
		if($newuser_query->num_rows==0)	//old user
			notify($_SESSION['EMP_VALIDATE'], "Validation Request Approved", "Your validation request for previous employment details have been approved.", "show_emp.php?form_name=1","success");
	}
	if(isset($_POST['approve3']))
	{
		$approve3_query=$mysqli->query("update emp_validation_details set family_details_status='approved' where id='".$_SESSION['EMP_VALIDATE']."'");
		$check_reject3_query=$mysqli->query("delete from emp_reject_reason where id='".$_SESSION['EMP_VALIDATE']."' and step=3");
		if($newuser_query->num_rows==0)	//old user
			notify($_SESSION['EMP_VALIDATE'], "Validation Request Approved", "Your validation request for dependent family member details have been approved.", "show_emp.php?form_name=2","success");
	}
	if(isset($_POST['approve4']))
	{
		$approve4_query=$mysqli->query("update emp_validation_details set educational_status='approved' where id='".$_SESSION['EMP_VALIDATE']."'");
		$check_reject4_query=$mysqli->query("delete from emp_reject_reason where id='".$_SESSION['EMP_VALIDATE']."' and step=4");
		if($newuser_query->num_rows==0)	//old user
			notify($_SESSION['EMP_VALIDATE'], "Validation Request Approved", "Your validation request for educational details have been approved.", "show_emp.php?form_name=3","success");
	}
	if(isset($_POST['approve5']))
	{
		$approve5_query=$mysqli->query("update emp_validation_details set stay_status='approved' where id='".$_SESSION['EMP_VALIDATE']."'");
		$check_reject5_query=$mysqli->query("delete from emp_reject_reason where id='".$_SESSION['EMP_VALIDATE']."' and step=5");
		if($newuser_query->num_rows==0)	//old user
			notify($_SESSION['EMP_VALIDATE'], "Validation Request Approved", "Your validation request for last 5 year stay details have been approved.", "show_emp.php?form_name=4","success");
	}
	$date=date("Y-m-d H:i:s",time()+(19800));	
	//Rejected
	if(isset($_POST['reject0']))
	{
		$reject0_query=$mysqli->query("select * from emp_reject_reason where id='".$_SESSION['EMP_VALIDATE']."' and step=0");
		if($reject0_query->num_rows==0)
			$reject0_query_insert=$mysqli->query("insert into emp_reject_reason values ('".$_SESSION['EMP_VALIDATE']."',0,'".$_POST['reason0']."','$date')");
		else
			$reject0_query_update=$mysqli->query("update emp_reject_reason set reason='".$_POST['reason0']."', created_date='$date' where id='".$_SESSION['EMP_VALIDATE']."' and step=0");
			
		$update_reject0=$mysqli->query("update emp_validation_details set profile_pic_status='rejected' where id='".$_SESSION['EMP_VALIDATE']."'");
		if($newuser_query->num_rows==0)	//old user
			notify($_SESSION['EMP_VALIDATE'], "Validation Request Rejected", "Your validation request for profile picture have been rejected. Contact the Establishment Section for the same.", "show_emp.php?form_name=0","error");
		//for both old or new user
		$deoquery=$mysqli->query("select id from deo_modules where module_id='employee'");
		$deo=$deoquery->fetch_assoc();
		notify($deo['id'], "Validation Request Rejected", "Validation request for employee ".$_SESSION['EMP_VALIDATE']." profile picture have been rejected.", "validate.php","error");
	}
	
	if(isset($_POST['reject1']))
	{
		$reject1_query=$mysqli->query("select * from emp_reject_reason where id='".$_SESSION['EMP_VALIDATE']."' and step=1");
		if($reject1_query->num_rows==0)
			$reject1_query_insert=$mysqli->query("insert into emp_reject_reason values ('".$_SESSION['EMP_VALIDATE']."',1,'".$_POST['reason1']."','$date')");
		else
			$reject1_query_update=$mysqli->query("update emp_reject_reason set reason='".$_POST['reason1']."', created_date='$date' where id='".$_SESSION['EMP_VALIDATE']."' and step=1");
			
		$update_reject1=$mysqli->query("update emp_validation_details set basic_details_status='rejected' where id='".$_SESSION['EMP_VALIDATE']."'");
		if($newuser_query->num_rows==0)	//old user
			notify($_SESSION['EMP_VALIDATE'], "Validation Request Rejected", "Your validation request for basic details have been rejected. Contact the Establishment Section for the same.", "show_emp.php?form_name=0","error");
		//for both old or new user
		$deoquery=$mysqli->query("select id from deo_modules where module_id='employee'");
		$deo=$deoquery->fetch_assoc();
		notify($deo['id'], "Validation Request Rejected", "Validation request for employee ".$_SESSION['EMP_VALIDATE']." basic details have been rejected.", "validate.php","error");
	}
	
	if(isset($_POST['reject2']))
	{
		$reject2_query=$mysqli->query("select * from emp_reject_reason where id='".$_SESSION['EMP_VALIDATE']."' and step=2");
		if($reject2_query->num_rows==0)
			$reject2_query_insert=$mysqli->query("insert into emp_reject_reason values ('".$_SESSION['EMP_VALIDATE']."',2,'".$_POST['reason2']."','$date')");
		else
			$reject2_query_update=$mysqli->query("update emp_reject_reason set reason='".$_POST['reason2']."', created_date='$date' where id='".$_SESSION['EMP_VALIDATE']."' and step=2");
			
		$update_reject2=$mysqli->query("update emp_validation_details set prev_exp_status='rejected' where id='".$_SESSION['EMP_VALIDATE']."'");
		if($newuser_query->num_rows==0)	//old user
			notify($_SESSION['EMP_VALIDATE'], "Validation Request Rejected", "Your validation request for previous employment details have been rejected. Contact the Establishment Section for the same.", "show_emp.php?form_name=1","error");
		//for both old or new user
		$deoquery=$mysqli->query("select id from deo_modules where module_id='employee'");
		$deo=$deoquery->fetch_assoc();
		notify($deo['id'], "Validation Request Rejected", "Validation request for employee ".$_SESSION['EMP_VALIDATE']." previous employment details have been rejected.", "validate.php","error");
	}
	
	if(isset($_POST['reject3']))
	{
		$reject3_query=$mysqli->query("select * from emp_reject_reason where id='".$_SESSION['EMP_VALIDATE']."' and step=3");
		if($reject3_query->num_rows==0)
			$reject3_query_insert=$mysqli->query("insert into emp_reject_reason values ('".$_SESSION['EMP_VALIDATE']."',3,'".$_POST['reason3']."','$date')");
		else
			$reject3_query_update=$mysqli->query("update emp_reject_reason set reason='".$_POST['reason3']."', created_date='$date' where id='".$_SESSION['EMP_VALIDATE']."' and step=3");
			
		$update_reject3=$mysqli->query("update emp_validation_details set family_details_status='rejected' where id='".$_SESSION['EMP_VALIDATE']."'");
		if($newuser_query->num_rows==0)	//old user
			notify($_SESSION['EMP_VALIDATE'], "Validation Request Rejected", "Your validation request for dependent family member details have been rejected. Contact the Establishment Section for the same.", "show_emp.php?form_name=2","error");
		//for both old or new user
		$deoquery=$mysqli->query("select id from deo_modules where module_id='employee'");
		$deo=$deoquery->fetch_assoc();
		notify($deo['id'], "Validation Request Rejected", "Validation request for employee ".$_SESSION['EMP_VALIDATE']." dependent family member details have been rejected.", "validate.php","error");
	}
	
	if(isset($_POST['reject4']))
	{
		$reject4_query=$mysqli->query("select * from emp_reject_reason where id='".$_SESSION['EMP_VALIDATE']."' and step=4");
		if($reject4_query->num_rows==0)
			$reject4_query_insert=$mysqli->query("insert into emp_reject_reason values ('".$_SESSION['EMP_VALIDATE']."',4,'".$_POST['reason4']."','$date')");
		else
			$reject4_query_update=$mysqli->query("update emp_reject_reason set reason='".$_POST['reason4']."', created_date='$date' where id='".$_SESSION['EMP_VALIDATE']."' and step=4");
			
		$update_reject4=$mysqli->query("update emp_validation_details set educational_status='rejected' where id='".$_SESSION['EMP_VALIDATE']."'");
		if($newuser_query->num_rows==0)	//old user
			notify($_SESSION['EMP_VALIDATE'], "Validation Request Rejected", "Your validation request for educational details have been rejected. Contact the Establishment Section for the same.", "show_emp.php?form_name=3","error");
		//for both old or new user
		$deoquery=$mysqli->query("select id from deo_modules where module_id='employee'");
		$deo=$deoquery->fetch_assoc();
		notify($deo['id'], "Validation Request Rejected", "Validation request for employee ".$_SESSION['EMP_VALIDATE']." educational details have been rejected.", "validate.php","error");
	}
	
	if(isset($_POST['reject5']))
	{
		$reject5_query=$mysqli->query("select * from emp_reject_reason where id='".$_SESSION['EMP_VALIDATE']."' and step=5");
		if($reject5_query->num_rows==0)
			$reject5_query_insert=$mysqli->query("insert into emp_reject_reason values ('".$_SESSION['EMP_VALIDATE']."',5,'".$_POST['reason5']."','$date')");
		else
			$reject5_query_update=$mysqli->query("update emp_reject_reason set reason='".$_POST['reason5']."', created_date='$date' where id='".$_SESSION['EMP_VALIDATE']."' and step=5");
			
		$update_reject5=$mysqli->query("update emp_validation_details set stay_status='rejected' where id='".$_SESSION['EMP_VALIDATE']."'");
		if($newuser_query->num_rows==0)	//old user
			notify($_SESSION['EMP_VALIDATE'], "Validation Request Rejected", "Your validation request for last 5 year details have been rejected. Contact the Establishment Section for the same.", "show_emp.php?form_name=4","error");
		//for both old or new user
		$deoquery=$mysqli->query("select id from deo_modules where module_id='employee'");
		$deo=$deoquery->fetch_assoc();
		notify($deo['id'], "Validation Request Rejected", "Validation request for employee ".$_SESSION['EMP_VALIDATE']." last 5 year details have been rejected.", "validate.php","error");
	}
	
	
	//If all approved
	$all_approved_query=$mysqli->query("delete from emp_validation_details where profile_pic_status='approved' and basic_details_status='approved' and prev_exp_status='approved' and family_details_status='approved' and educational_status='approved' and stay_status='approved'");
	$find_entry=$mysqli->query("select * from emp_validation_details where id='".$_SESSION['EMP_VALIDATE']."'");
	if($find_entry->num_rows!=0)
		header('Location: validate_step.php?emp='.$_SESSION['EMP_VALIDATE']);
	else
	{
		//for new user
		if($newuser_query->num_rows!=0)
		{
			$pass="p";
			$updating_users=$mysqli->query("UPDATE users
							SET password='".encode_password($pass, $date)."', created_date='$date'
							WHERE id='".$_SESSION['EMP_VALIDATE']."'");
		
			#email the user and pass
			/*
			$email_query=mysql_query("SELECT email FROM user_details WHERE id='".$emp_id."'");
			$row=mysql_fetch_row($email_query);
			$to = $row[0];
			$subject = "Registration on Online ISM MIS Portal";
			$message = "You are registered on the Online ISM MIS Portal. Your Username and password are \n Username:".$emp_id ."\n Password:".$pass;
			$from = "xyz@example.com";
			$headers = "From:" . $from;
	//		mail($to,$subject,$message,$headers);
			echo "Mail Sent";
			*/
		}
		header('Location: validate.php');
	}
	mysql_close();
?>