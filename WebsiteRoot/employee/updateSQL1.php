<?php
	require_once("../Includes/Auth.php");
	auth();
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	$picquery=mysql_query("select photopath from user_details where id='".$_POST['emp_id']."'");
	$picresult=mysql_fetch_row($picquery);
	$pic=$picresult[0];

	$qry="UPDATE user_details
			SET	salutation='".clean($_POST['salutation'])."',
				first_name='".clean(strtolower($_POST['firstname']))."',
				middle_name='".clean(strtolower($_POST['middlename']))."',
				last_name='".clean(strtolower($_POST['lastname']))."',
				sex='".clean(strtolower($_POST['sex']))."',
				category='".$_POST['category']."',
				dob='".$_POST['dob']."',
				email='".clean($_POST['email'])."',
				photopath='".$pic."',
				marital_status='".clean(strtolower($_POST['mstatus']))."',
				physically_challenged='".clean(strtolower($_POST['pd']))."',
				dept_id='".$_POST['department']."'
			WHERE id='".$_POST['emp_id']."'";
	$presult = mysql_query($qry);

	$qry="UPDATE user_other_details
			SET	religion='".clean(strtolower($_POST['religion']))."',
				nationality='".clean(strtolower($_POST['nationality']))."',
				kashmiri_immigrant='".$_POST['kashmiri']."',
				hobbies='".clean(strtolower($_POST['hobbies']))."',
				fav_past_time='".clean(strtolower($_POST['favpast']))."',
				birth_place='".clean(strtolower($_POST['pob']))."',
				mobile_no='".clean($_POST['mobile'])."',
				father_name='".clean(strtolower($_POST['father']))."',
				mother_name='".clean(strtolower($_POST['mother']))."'
			WHERE id='".$_POST['emp_id']."'";

	$uresult = mysql_query($qry);

	if($_POST['tstatus']!='ft')	$_POST['research_int']='NA';
	$qry="UPDATE emp_basic_details
			SET	auth_id='".$_POST['tstatus']."',
				designation='".clean(strtolower($_POST['designation']))."',
				post_concerned='".clean(strtolower($_POST['post']))."',
				office_no='".$_POST['office']."',
				fax='".$_POST['fax']."',
				joining_date='".$_POST['entrance_age']."',
				retirement_date='".$_POST['retire']."',
				employment_nature='".clean(strtolower($_POST['empnature']))."'
			WHERE id='".$_POST['emp_id']."'";
	$qresult = mysql_query($qry);

	$qry="UPDATE faculty_details
			SET research_interest='".clean(strtolower($_POST['research_int']))."'
			WHERE id='".$_POST['emp_id']."'";
	$sresult = mysql_query($qry);
	
	$aqry = "UPDATE emp_pay_details
			SET pay_code='".$_POST['gradepay']."',
			 	basic_pay='".$_POST['basicpay']."'
			WHERE id='".$_POST['emp_id']."'";
	$rresult = mysql_query($aqry);

	if($presult && $uresult && $qresult && $rresult)
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
	
			if(is_auth('deo'))
			{
				notify($_POST['emp_id'], "Details Edited", "Your basic details have been successfully edited by Data Entry Operator ".$_SESSION['id'], "show_emp.php?form_name=0","success");
				header('Location: index.php?update='.$_POST['emp_id']);
			}
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