<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	auth();
	require_once("connectDB.php");
	drawHeader("Reject Reason");
	if(isset($_GET['step']))
	{
		$step=$_GET['step'];
		$rejected1_query=$mysqli->query("select reason from emp_reject_reason where step=".$step." and id='".$_SESSION['id']."'");
		$rejectrow1=$rejected1_query->fetch_assoc();
		echo "<table align=\"center\"><tr><th>Reason behind Rejection</th></tr><tr><td>".$rejectrow1['reason']."</td></tr></table>";
	}
	else
		drawNotification("","The request has been approved.");
	drawFooter();
	mysql_close();
?>
	
	