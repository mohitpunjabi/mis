<?php
	require_once('../Includes/Auth.php');
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	auth();
	drawHeader("Reason for Rejection");
?>

<h2 align="center">Reason for Rejection</h2><br>
<br>

<?php
	$issue_id=$_GET['issue'];
	
	$reason=mysql_query("select reason from stockandinventory_reject_reason where valid_no=".$issue_id);
	$row=mysql_fetch_row($reason);
	drawNotification("$row[0]","","");
?>