<?php 

	require('connect.php'); 
 	if(isset($_GET['req_num']) && isset($_GET['status']))
	{
		$req_num=$_GET['req_num'];
		$status=$_GET['status'];
		$extract = mysql_query("DELETE * from request_temp where request_num='$req_num' ") or die(mysql_error());
		header( 'Location: add_books.php' ) ;
	
	
	}
	else
	header( 'Location: display_requests.php' ) ;
		

?>