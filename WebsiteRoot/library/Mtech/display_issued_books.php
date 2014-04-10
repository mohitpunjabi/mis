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
</head>

<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>
<div id="content">
			
<table>


 <?php
 	@session_start();
	$student_id=$_SESSION['SESS_USERNAME'];
 	$count=0;
	require("connect.php");
	$extract = mysql_query("SELECT * FROM issued_book_student where student_id='$student_id'");
	if(mysql_num_rows($extract)==0)
	{
		echo "<h3>No Books issued under your name</h3>";
		
	}
	else
	{
	echo "<h3>Books Issued:</h3><br><br>";
	
	
	echo "
	<tr>
    
			<th width='100' valign='left' align='center' >Sr. no.</th>
    		<th width='300' valign='left' align='center' >Student Name</th>
    		<th width='300' valign='left' align='center' >Book Name</th>
   			 <th width='300' valign='left' align='center' >Accession No.</th>
   
	</tr>

 	";
 
	while($row = mysql_fetch_assoc($extract))
	{
			$student_id=$row["student_id"];
			$book_no=$row["book_no"];
			$class_no=$row["class_no"];
			$accession_no=$row["accession_no"];
			$student_name=$row['student_name'];

			//$select=mysql_query("Select emp_name from faculty_data where emp_id="$emp_id"");
			
			$select1=mysql_query("SELECT book_name from cselib_books where book_no='$book_no' and call_no='$class_no'");
			$row=mysql_fetch_assoc($select1);
			$book_name=$row['book_name'];			
			$count=$count+1;
		echo  "
 		 <tr>
  		  
			<td width='200' valign='left' align='center' >$count</td>
  			  <td width='200' valign='left' align='center' >$student_name</td>
   			 <td width='200' valign='left' align='center'>$book_name</td>
   			 <td width='200' valign='left' align='center' >$accession_no</td>
   
		</tr>";
		}
	
	}
	?>

</table>
</div>

	
	<br>
	
	
	<div id="print">
		<td height="36">&nbsp;</td>
  		<center> <td valign="top"><input class="button-style" type="button" value="PRINT" onclick="printDiv()"/></td>
 		</tr>
    </div>	
		
</div>
</body>
</html>

<?php
drawFooter();
?>