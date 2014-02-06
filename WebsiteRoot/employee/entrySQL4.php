<?php	require_once("../Includes/Auth.php");
	auth();

	require_once("connectDB.php");
	
	$res=mysql_query("SELECT * FROM  emp_current_entry ");
	$row=mysql_fetch_array($res);
	$emp_id=$row[0];
	$count=count($_POST['clgname4']);
	$i=0;
	$result=true;
	while($_POST['clgname4'][$i]!=""  &&  $i<$count)
	{
		$sno=$i+1;
		$qry = "INSERT INTO emp_education_details 
				VALUES ('$emp_id','$sno',
						'".clean(strtolower($_POST['exam4'][$i]))."',
						'".clean(strtolower($_POST['branch4'][$i]))."',
						'".clean(strtolower($_POST['clgname4'][$i]))."',
						'".clean($_POST['year4'][$i])."',
						'".clean(strtolower($_POST['grade4'][$i]))."',
						'".clean(strtolower($_POST['div4'][$i]))."')";
		$result=mysql_query($qry);
		if(!$result)	break;
		$i++;
	}
	if($result)
	{
		$next_step="UPDATE emp_current_entry 
					SET curr_step = 4";
		mysql_query($next_step);
		header('Location: add_employee.php');
		$_SESSION['EMP_CURRSTEP'] = 4;
	}
	else
	{
		echo mysql_error();		
	}
	mysql_close();
?>