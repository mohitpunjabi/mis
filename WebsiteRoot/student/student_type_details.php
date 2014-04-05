<html>
<?php
	require_once("../Includes/Auth.php");
	auth('deo');
	require_once("../Includes/ConfigSQL.php");
	require_once("../Includes/Layout.php");
	require_once("connectDB.php");
	
	
	drawHeader("Add Admission Details");
	$res=mysql_query("SELECT * FROM  stu_current_entry ");
	$row=mysql_fetch_array($res);
	$stu_id=$row[0];

	if(isset($_GET['success']))
		drawNotification("Student Added", "Student ".$_GET['success']." was successfully added.", "success");
	if(isset($_GET['update']))
		drawNotification("Student Details Edited", "Student ".$_GET['update']." was successfully edited.", "success");

?>

<body>
<form action='entrySQL5.php' method="post" >
<input type="submit" name='submit' value="OK ! Move to Home Page"></input>
</form>

<?php
	drawFooter();
?>
</body>
</html>