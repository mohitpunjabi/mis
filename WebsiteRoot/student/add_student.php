<?php
	require_once("../Includes/Auth.php");
	require_once("../Includes/Layout.php");
	auth('deo');
	require_once("connectDB.php");
	drawHeader("Add Student Details");

	$result=mysql_query("SELECT * FROM  stu_current_entry ");
	$row_count=mysql_num_rows($result);

	if($row_count == 0)
	{
		$_SESSION['STUDENT_CURRSTEP'] = 0;
		header('Location: stu_detail.php');
	}
	else
	{
		$row=mysql_fetch_row($result);
		echo $_SESSION['ADD_STUDENT_ID']=$row[0];
		$_SESSION['STUDENT_CURRSTEP']=$row[1];
		switch($row[1])
		{
			case 1:	header('Location: student_other_details.php');break;
			case 2:	header('Location: student_type_details.php?success');break;
			//case 3:	header('Location: educational_details.php');break;
			//case 4: header('Location: lastfive.php');break;
		}
	}
	
	mysql_close();
	drawFooter();
?>