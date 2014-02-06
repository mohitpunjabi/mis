<?php
	require_once("../Includes/SessionAuth.php");
	require_once("../Includes/AuthDo.php");
	require_once("../Includes/ConfigSQL.php");
	require_once("../Includes/FeedbackLayout.php");
	require_once("connectDB.php");
	drawHeader("Add Student Details");

	$result=mysql_query("SELECT * FROM  stu_current_entry ");
	$row_count=mysql_num_rows($result);

	if($row_count == 0) 
	{
		$_SESSION['STU_CURRSTEP'] = 0;
		header('Location: stu_detail.php');
	}
	else
	{
		$row=mysql_fetch_row($result);
		echo $_SESSION['ADD_STU_ID']=$row[0];
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