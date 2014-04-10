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
<br>
			
<table >


 <?php
 	//session_start();
	//$student_id=$_SESSION['student_id'];
 	$count=0;
	require("connect.php");
	$extract = mysql_query("SELECT * FROM donated_book where student_id='$student_id'") or die(mysql_error());
	
	if(mysql_num_rows($extract)==0)
	{
		echo "<tr><td width='800px' >NO BOOK DONATED</td></tr>";
		
	}
	else
	{
	echo "<span class='style4'><u>DONATED BOOKS</u></span><br><br>";
	
	
	 

	echo "

 
  
  
  	<tr>
    
			<td width='270' valign='left' align='left' ><u>Sr. no.</u> </td>
    		<td width='270' valign='left' align='left' ><u>Book Name</u> </td>
			<td width='260' valign='left' align='left' ><u>Dated</u></td>
    		
   			 
   
	</tr>

 	";
 
	$extract1 = mysql_query("SELECT sum(amount) as sumamount from donated_book where student_id='$student_id'") or die(mysql_error());
	
	$row1= mysql_fetch_assoc($extract1);
	
	$total_amount=$row1['sumamount'];
	
	
	while($row = mysql_fetch_assoc($extract))
	{
			$book_name=$row['book_name'];
			$student_name=$row['student_name'];
			$cost=$row['amount'];
			$date=$row['date_donate'];
						$count=$count+1;
			echo " <tr>
   
	<td width='270' valign='top' align='left'><span class='style7'>$count.</span></td>
	
   
	
   
	 <td width='270' valign='top' align='left'><span class='style7'>$book_name</span></td>
	 <td width='260' valign='top' align='left'><span class='style7'>$date</span></td>
	  
  </tr> ";
  
  
	}
	}
	?>

</table>
</div>
	
	
	
	
	
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