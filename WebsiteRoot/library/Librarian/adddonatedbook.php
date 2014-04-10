<?php
	require_once("../../Includes/Auth.php");
	auth();
	require_once("../../Includes/Layout.php");

	drawHeader("Account Functions");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>


<div class="notification">

 <?php
 
 
require("connect.php");
$design=$_POST['design'];

if($design=="FACULTY")
{
	
	//get emp_id
    $name= $_POST['name'];
	$l='(';
	$r=')';
	$f=strpos($name,$l);
	$m=strpos($name,$r);
	$len=$m-$f;
	$id=substr($name,$f+1,$len-1);
	$extract=mysql_query("select first_name,middle_name,last_name from user_details where id='$id' ") or die(mysql_error());
	$row=mysql_fetch_assoc($extract);

	$first=$row['first_name'];
	$middle=$row['middle_name'];
	$last=$row['last_name'];

	$emp_name=$first." ".$middle." ".$last."(".$id.")";
	$author=$_REQUEST['author'];
	$publication=$_REQUEST['publication'];
	$book_name=$_REQUEST['book_name'];
	$amount=$_REQUEST['amount'];
	$currency=$_REQUEST['currency'];
	$date=$_REQUEST['date'];

	$insert=mysql_query("INSERT INTO cselib_donated_book_faculty VALUES('$id','$emp_name','$book_name','$author','$publication','$date','$amount')")  or die("$insert".mysql_error());
	echo "<h2>Database Updated</h2>";

}

if($design=="STUDENT")
{

	$student_id= $_REQUEST['student_id'];

	//$extract=mysql_query("select first_name,middle_name,last_name,branch_id from feedback_studentpersonal where admn_no='$student_id' ") or die(mysql_error());
	$extract=mysql_query("select first_name,middle_name,last_name from feedback_studentpersonal where admn_no='$student_id' ") or die(mysql_error());
	$row=mysql_fetch_assoc($extract);

	//$branch=$row['branch_id'];
	$first=$row['first_name'];
	$middle=$row['middle_name'];
	$last=$row['last_name'];
		
	/*
	if($branch!="CSE")
	{
		echo "<h2>student does not belong to CSE</h2>";
		exit;
	}
	*/

	$student_name=$first." ".$middle." ".$last;
	$author=$_REQUEST['author'];
	$publication=$_REQUEST['publication'];
	$book_name=$_REQUEST['book_name'];
	$amount=$_REQUEST['amount'];
	$currency=$_REQUEST['currency'];
	$date=$_REQUEST['date'];


	$insert=mysql_query("INSERT INTO cselib_donated_book_student VALUES('$student_id','$student_name','$book_name','$author','$publication','$date','$amount')")  or die("$insert".mysql_error());


	echo "<h2>Database Updated</h2>";
}

?>
 </div>
 <br>
 <h3><a href="add_donated_book.php">Add more books</a></h3>
 <br>
</body>
</html>

<?php
drawFooter();
?>