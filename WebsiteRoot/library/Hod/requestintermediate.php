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
</head>

<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>

<div id="content">
<div class="formarea">
<div class="subfieldsset">
  <?php
  echo "
<div class='information'>";
 
 
 
require("connect.php");

 
//book details
	@session_start();
	$empid=$_SESSION['SESS_USERNAME'];
	
	$book_name=$_REQUEST['book_name'];
	$author=$_REQUEST['author'];
	$publication=$_REQUEST['publication'];
	$edition=$_REQUEST['edition'];
	$source=$_REQUEST['source'];
	$date=date("Ymd");
	$no_copies=$_REQUEST['no_copies'];
	$price=$_REQUEST['price'];
	$currency=$_REQUEST['currency'];
	
	$select=mysql_query("SELECT first_name,last_name,middle_name from user_details where id='$empid'") or die(mysql_error());
	$select5=mysql_query("SELECT designation from emp_basic_details where id='$empid'") or die(mysql_error());
	
	$row=mysql_fetch_assoc($select);
	$row5=mysql_fetch_assoc($select5);
	$first=$row['first_name'];
	$middle=$row['middle_name'];
	$last=$row['last_name'];
	$name=$first." ".$middle." ".$last; 
	$design=$row5['designation'];
	
	
	
	
	/*
	$extract=mysql_query("SELECT dept,design from feedback_faculty where emp_id='$empid'");
	$row=mysql_fetch_assoc($extract);
	$design=$row['design'];
	$dept=$row['dept'];*/
	$extract=mysql_query("SELECT date_request from cselib_request_temp where date_request='$date'") or die(mysql_error());
	$count=mysql_num_rows($extract);
	$count=$count+1;
	$req_num="R".$date."N".$count;
	
	
$select=mysql_query("INSERT INTO cselib_request_temp
 values('$req_num','$empid','$name','$design','Computer Science & Engineering','$book_name','$author','$publication','$edition','$source','$no_copies','$price','$currency','$date','0','')") 
 or die(mysql_error());
 
 if($select)

		echo "<h3><center>Database Updated</center></h3>";


echo "
 </div>
 <br>
 <br>
 <div> <a href='request.php'><h3><center>Request more Books</center></h3><br><br></a></div>
 <div> <a href='request_print.php?req_num=$req_num'><h3><center>Print the request form</center></h3><br><br></a></div>
 <br>";
?>
</div>
</div>
</div>
</div>

</body>
</html>

<?php
drawFooter();
?>