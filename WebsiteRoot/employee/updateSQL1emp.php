<?php
	require_once("../Includes/Auth.php");
	auth('emp');
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	$picquery=mysql_query("select photopath from user_details where id='".$_POST['emp_id']."'");
	$picresult=mysql_fetch_row($picquery);
	$pic=$picresult[0];
	$qry="UPDATE user_details
			SET	salutation='".clean($_POST['salutation'])."',
				email='".clean($_POST['email'])."',
				marital_status='".clean(strtolower($_POST['mstatus']))."',
				physically_challenged='".clean(strtolower($_POST['pd']))."'
			WHERE id='".$_POST['emp_id']."'";
	$presult = mysql_query($qry);

	$qry="UPDATE user_other_details
			SET	hobbies='".clean(strtolower($_POST['hobbies']))."',
				fav_past_time='".clean(strtolower($_POST['favpast']))."',
				mobile_no='".clean($_POST['mobile'])."'
			WHERE id='".$_POST['emp_id']."'";

	$uresult = mysql_query($qry);

	if(isset($_POST['tstatus']) && $_POST['tstatus']!='ft')	$_POST['research_int']='NA';
	$qry="UPDATE emp_basic_details
			SET	post_concerned='".clean(strtolower($_POST['post']))."',
				office_no='".$_POST['office']."',
				fax='".$_POST['fax']."'
			WHERE id='".$_POST['emp_id']."'";
	$qresult = mysql_query($qry);
	
	$qry="UPDATE faculty_details
			SET research_interest='".clean(strtolower($_POST['research_int']))."'
			WHERE id='".$_POST['emp_id']."'";
	$sresult = mysql_query($qry);

	
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
			header('Location: edit_basic_detail_authemp.php?update='.$_POST['emp_id']);
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