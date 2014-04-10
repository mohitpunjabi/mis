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
<script>
function printDiv()
{
  var divToPrint=document.getElementById("content");
  newWin= window.open("");
  newWin.document.write(divToPrint.outerHTML);
  newWin.print();
  newWin.close();
}
</script>

<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>
<div id="content">
<table width=100%>


 <?php
 	@session_start();
	$emp_id=$_SESSION['SESS_USERNAME'];
 	$count=0;
	require("connect.php");
	$extract = mysql_query("SELECT * FROM cselib_issued_book_faculty where emp_id='$emp_id'");
	if(mysql_num_rows($extract)==0)
	{
		echo "<span>No Books issued under your name<br><br></span>";
		
	}
	else
	{
	$select=mysql_query("SELECT first_name,last_name,middle_name from user_details where id='$emp_id'") or die(mysql_error());
	
	$row=mysql_fetch_assoc($select);
	$first=$row['first_name'];
	$middle=$row['middle_name'];
	$last=$row['last_name'];
	$name=$first." ".$middle." ".$last;
	
	echo "<span><h3>Books Issued<br><br></h3></span>";
	
	
	 

	echo "

 
  
  
  	<tr>
    
			<th>Sr. No.</th>
    		<th>Faculty Name</th>
    		<th>Book Name</th>
   			 <th>Accession No.</th>
   
	</tr>

 	";
 
	
	
	while($row = mysql_fetch_assoc($extract))
	{
			$emp_id=$row["emp_id"];
			$book_no=$row["book_no"];
			$class_no=$row["class_no"];
			$accession_no=$row["accession_no"];

			//$select=mysql_query("Select emp_name from faculty_data where emp_id="$emp_id"");
			
			$select1=mysql_query("SELECT book_name from cselib_books where book_no='$book_no' and call_no='$class_no'");
			$row=mysql_fetch_assoc($select1);
			$book_name=$row['book_name'];			
			$count=$count+1;
		echo  "
 		 <tr>
  		  
			<td><center>$count</center></td>
  			  <td>$name</td>
   			 <td>$book_name</td>
   			 <td>$accession_no</td>
   
		</tr>";
		}
	
	}
	?>
</table>	
</div>

<br>
<br>
<center><input class="button-style" type="button" value="PRINT" onclick="printDiv()"/></center>
	
</body>
</html>

<?php
drawFooter();
?>