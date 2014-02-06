<?php	require_once("../Includes/Auth.php");
	auth();

	require_once("connectDB.php");

	$picquery=mysql_query("select photopath from user_details where id='".$_POST['emp_id']."'");
	$picresult=mysql_fetch_row($picquery);
	$pic=$picresult[0];

    mysql_query("DELETE FROM user_details WHERE id='".$_POST['emp_id']."'");
	$qry = "INSERT INTO user_details
			VALUES ('".clean(strtolower($_POST['emp_id']))."',
					'".clean($_POST['salutation'])."',
					'".clean(strtolower($_POST['firstname']))."',
					'".clean(strtolower($_POST['middlename']))."',
					'".clean(strtolower($_POST['lastname']))."',
					'".clean(strtolower($_POST['sex']))."',
					'".$_POST['category']."',
					'".$_POST['dob']."',
					'".clean($_POST['email'])."',
					'".$pic."',
					'".clean(strtolower($_POST['mstatus']))."',
					'".clean(strtolower($_POST['pd']))."',
					'".$_POST['department']."')";		
	$presult = mysql_query($qry);
    mysql_query("DELETE FROM user_other_details WHERE id='".$_POST['emp_id']."'");
	$qry = "INSERT INTO user_other_details
			VALUES ('".clean(strtolower($_POST['emp_id']))."',
					'".clean(strtolower($_POST['religion']))."',
					'".clean(strtolower($_POST['nationality']))."',
					'".$_POST['kashmiri']."',
					'".clean(strtolower($_POST['hobbies']))."',
					'".clean(strtolower($_POST['favpast']))."',
					'".clean(strtolower($_POST['pob']))."',
					'".clean($_POST['mobile'])."',
					'".clean(strtolower($_POST['father']))."',
					'".clean(strtolower($_POST['mother']))."')";
	$uresult = mysql_query($qry);

   	mysql_query("DELETE FROM emp_basic_details WHERE id='".$_POST['emp_id']."'");
	if($_POST['tstatus']!='ft')	$_POST['research_int']='NA';
	$qry = "INSERT INTO emp_basic_details
			VALUES ('".clean(strtolower($_POST['emp_id']))."',
					'".$_POST['tstatus']."',
					'".clean(strtolower($_POST['designation']))."',
					'".clean(strtolower($_POST['post']))."',
					'".clean(strtolower($_POST['research_int']))."',
					'".$_POST['office']."',
					'".$_POST['fax']."',
					'".$_POST['entrance_age']."',
					'".$_POST['retire']."',
					'".clean(strtolower($_POST['empnature']))."')";
	$qresult = mysql_query($qry);
	
	$qry = "UPDATE emp_pay_details
			SET pay_code='".clean($_POST['payscale'])."'
			WHERE id='".$_POST['emp_id']."'";
	$qresult = mysql_query($qry);

	if($presult && $uresult && $qresult)
	{
		$qry = "UPDATE user_address
				SET line1='".$_POST['line11']."',
					line2='".$_POST['line21']."',					
				    city='".$_POST['city1']."',
					state='".$_POST['state1']."',
					pincode='".$_POST['pincode1']."',
					country='".$_POST['country1']."',
					contact_no='".$_POST['contact1']."' 
				WHERE	id='".$_POST['emp_id']."' AND type='present'";
		$result1 = mysql_query($qry);
		
		if($result1)
		{
			header('Location: index.php?update='.$_POST['emp_id']);
		}
		else
		{
			echo mysql_error();		
		}
	}
	else
	{
		echo mysql_error();		
	}
	mysql_close();
?>