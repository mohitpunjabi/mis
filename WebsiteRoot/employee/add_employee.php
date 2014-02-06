<?php
	require_once("../Includes/Auth.php");
	require_once("../Includes/Layout.php");
	auth("deo");
	
	require_once("connectDB.php");
	drawHeader("Add Employee Details");

	$result=mysql_query("SELECT * FROM  emp_current_entry ");
	$row_count=mysql_num_rows($result);

	if($row_count == 0) 
	{
		$_SESSION['EMP_CURRSTEP'] = 0;
		header('Location: emp_detail.php');
	}
	else
	{
		$row=mysql_fetch_row($result);
		$_SESSION['ADD_EMP_ID']=$row[0];
		switch($row[1])
		{
			case 1:	header('Location: emp_prev_exp_details.php');break;
			case 2:	header('Location: family_details.php');break;
			case 3:	header('Location: educational_details.php');break;
			case 4: header('Location: lastfive.php');break;
		}
	}
	
	mysql_close();
	drawFooter();
?>