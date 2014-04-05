<?php
	require_once("../Includes/SessionAuth.php");
	require_once("connectDB.php");
	
	$stu_id=$_POST['student_id'];

	
	$qry = "UPDATE stu_details SET
			enrollment_no='$_POST[enroll_no]',
			enrollment_year='$_POST[enroll_year]',
			admn_based_on='$_POST[adm_on]',
			type='$_POST[stu_type]',
			session='$_POST[session]',
			parent_mobile_no='$_POST[parent_mob]',
			parent_landline_no='$_POST[parent_lan]',
			alternate_email_id='$_POST[alternate_email_id]',
			migration_cert='$_POST[migration_certificate]'
			WHERE admn_no='$stu_id'";
	$result = mysql_query($qry);

	if($_POST['pay_mode']=='ob')
	{
		$qry = "UPDATE stu_fee_details SET
				id='$stu_id',
				fee_mode='$_POST[pay_mode]',
				fee_reciept_no='$_POST[transac_id]',
				fee_date='$_POST[fee_date]',
				fee_amount='$_POST[fees_paid]',
				fee_in_favour='$_POST[fee_favour]',
				payment_made_on='$_POST[ob_payment_date]',
				bank_name='$_POST[bank]',
				transaction_id='$_POST[receipt_no]'
				WHERE id='$stu_id'";
		$obresult = mysql_query($qry);
		$ddresult=true;
	}
	else
	{
		$qry = "UPDATE stu_fee_details SET
				id='$stu_id',
				fee_mode='$_POST[pay_mode]',
				fee_reciept_no='$_POST[dd_c_no]',
				fee_date='$_POST[fee_date]',
				fee_amount='$_POST[fees_paid]',
				fee_in_favour='$_POST[fee_favour]',
				payment_made_on='$_POST[dd_payment_date]',
				bank_name='$_POST[bank]',
				transaction_id='$_POST[receipt_no]'
				WHERE id='$stu_id'";
		$ddresult = mysql_query($qry);
		$obresult=true;
	}
			if($result && $ddresult && $obresult)
				header('Location: index.php?update='.$_POST['student_id']);
			else
				echo mysql_error();

	mysql_close();
?>