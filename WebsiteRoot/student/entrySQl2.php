<?php
	require_once("../Includes/SessionAuth.php");
	require_once("connectDB.php");
	
	$res=mysql_query("SELECT * FROM  stu_current_entry ");
	$row=mysql_fetch_array($res);
	$stu_id=$row[0];
	$result=true;
	
	$qry = "UPDATE stu_details SET
			enrollment_no='$_POST[enroll_no]',
			enrollment_year='$_POST[enroll_year]',
			admn_based_on='$_POST[adm_on]',
			type='$_POST[stu_type]',
			session='$_POST[session]',
			parent_mobile_no='$_POST[parent_mob]',
			parent_landline_no='$_POST[parent_lan]',
			alternate_email_id='$_POST[alternate_email_id]',
			migration_cert='$POST[migration_certificate]'
			WHERE admn_no='$stu_id'";
	$result = mysql_query($qry);

	if($_POST['pay_mode']=='ob')
	{
		$qry = "INSERT INTO stu_fee_details
				VALUES('".$stu_id."',
						'".$_POST['pay_mode']."',
						'".$_POST['transac_id']."',
						'".$_POST['fee_date']."',
						'".$_POST['fees_paid']."',
						'".$_POST['fee_favour']."',
						'".$_POST['ob_payment_date']."',
						'".$_POST['bank']."',
						'".$_POST['receipt_no']."')";
		$result = mysql_query($qry);
	}
	else
	{
		$qry = "INSERT INTO stu_fee_details
				VALUES('".$stu_id."',
						'".$_POST['pay_mode']."',
						'".$_POST['dd_c_no']."',
						'".$_POST['fee_date']."',
						'".$_POST['fees_paid']."',
						'".$_POST['fee_favour']."',
						'".$_POST['dd_payment_date']."',
						'".$_POST['bank']."',
						'".$_POST['receipt_no']."')";
		$result = mysql_query($qry);
	}
	
	if($result)
	{
		$next_step="UPDATE stu_current_entry 
					SET curr_step = 2";
		mysql_query($next_step);
		header('Location: add_student.php');
		$_SESSION['STU_CURRSTEP'] = 2;
	}
	else
	{
		echo mysql_error();		
	}
	mysql_close();
?>