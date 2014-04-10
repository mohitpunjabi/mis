<?php
	require_once("../../Includes/Auth.php");
	auth();
	require_once("../../Includes/Layout.php");

	drawHeader("Account Functions");
?>

<?php 

	require('connect.php'); 
 	if(isset($_GET['req_num']) && isset($_GET['status']))
	{
		$req_num=$_GET['req_num'];
		$status=$_GET['status'];
		$insert=mysql_query("INSERT into cselib_request_details(select request_num,emp_id,emp_name,design,dept,book_name,author,publication,edition,source,no_copies,price_unit,currency,date_request from cselib_request_temp where request_num='$req_num')") or die(mysql_error());
		$extract = mysql_query("delete from cselib_request_temp where status=1 ") or die(mysql_error());
		header( 'Location: add_books.php' ) ;
	
	
	}
	else
	header( 'Location: display_requests.php' ) ;
		

?>

<?php
drawFooter();
?>