<?php
	require_once("../Includes/SessionAuth.php");
	require_once("../Includes/ConfigSQL.php");
	require_once("../Includes/FeedbackLayout.php");
	require_once("connectDB.php");
	drawHeader("Student Management");
	
	if(isset($_GET['success']))
		drawNotification("Student Added", "Student ".$_GET['success']." was successfully added.", "success");
	if(isset($_GET['update']))
		drawNotification("Student Details Edited", "Student ".$_GET['update']." was successfully edited.", "success");
		
		
	drawNotification("Please select an option", ""); 

	if($_SESSION['SESS_AUTH']=="DO")
	{
		echo '<h2><br><a href = "add_student.php">Add Student</a></h2>';
		$query=mysql_query("select * from stu_current_entry");
		if(mysql_num_rows($query)!=0)
		{
			$row=mysql_fetch_row($query);
			echo '(Continue with Student '.$row[0].')';
		}
	    echo '<br><h2><a href = "edit_stu.php">Edit Student Details</a><br></h2>';
	    echo '<h2><a href = "stu_view.php">View Student Details</a><br></h2>';
	}
    else
		echo '<br><h2><a href = "show_stu.php">View Student Details</a></h2>';

	mysql_close();
	drawFooter();
?>