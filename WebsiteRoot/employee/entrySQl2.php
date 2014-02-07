<?php
	require_once("../Includes/Auth.php");
	auth();

	require_once("connectDB.php");
	
	$res=mysql_query("SELECT * FROM  emp_current_entry ");
	$row=mysql_fetch_array($res);
	$emp_id=$row[0];
	$count=count($_POST['designation2']);
	$i=0;
	$result=true;
	while($_POST['designation2'][$i]!=""  &&  $i<$count)
	{
		$sno=$i+1;
		$qry = "INSERT INTO emp_prev_exp_details 
				VALUES ('$emp_id','$sno','".clean(strtolower($_POST['designation2'][$i]))."','".$_POST['from2'][$i]."',
						'".$_POST['to2'][$i]."','".clean(strtolower($_POST['payscale2'][$i]))."','".clean(strtolower($_POST['addr2'][$i]))."','".clean(strtolower($_POST['reason2'][$i]))."')";
		$result=mysql_query($qry);
		if(!$result)	break;
		$i++;
	}
	if($result)
	{
		$next_step="UPDATE emp_current_entry 
					SET curr_step = 2";
		mysql_query($next_step);
		header('Location: add_employee.php');
		$_SESSION['EMP_CURRSTEP'] = 2;
	}
	else
	{
		echo mysql_error();		
	}
	mysql_close();
?>