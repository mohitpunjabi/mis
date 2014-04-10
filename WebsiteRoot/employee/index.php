<?php	require_once("../Includes/Auth.php");
	auth();

	require_once("../Includes/ConfigSQL.php");	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	drawHeader("Employee Management");
	

	if(isset($_GET['validation']))
		drawNotification("Validation Request Sent","Details of Employee ".$_GET['validation']." was successfully sent for validation.", "success");
	if(isset($_GET['update']))
		drawNotification("Validation Request Sent", "Employee ".$_GET['update']." was successfully edited and sent for validation.");
	if(isset($_GET['error']))
		drawNotification("Not sent for Validation", "Employee ".$_GET['error']." was successfully added. Their password is '<b>".$_GET['pass']."</b>.' But not sent for validation since no authorization is provided for nodal officer.", "error");
	
		
	drawNotification("Please select an option", ""); 

	if(is_auth("deo"))
	{
		echo '<h2><br><a href = "add_employee.php">Add Employee</a></h2>';
		$query=mysql_query("select * from emp_current_entry");
		if(mysql_num_rows($query)!=0)
		{
			$row=mysql_fetch_row($query);
			echo '(Continue with Employee '.$row[0].')';
		}
	    echo '<br><h2><a href = "edit_employee.php">Edit Employee Details</a><br></h2>';
	    echo '<h2><a href = "emp_view.php">View Employee Details</a><br></h2>';
		echo '<h2><a href = "validate.php">Employee Validation Requests</a><br></h2>';
	}
    else
		echo '<br><h2><a href = "show_emp.php">View Employee Details</a></h2>';

	mysql_close();
	drawFooter();
?>