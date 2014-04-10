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
 	require('connect.php'); 
 	$count=0;
 	$link=$_GET['link'];
	echo "<span><h3>$link<br><br></h3></span>";
	
	
	
	$extract = mysql_query("SELECT book_no,book_name,no_copies from cselib_books where category='$link'") or die(mysql_error());
	
	if(mysql_num_rows($extract)==0 )
	{
		echo "<tr><td>No entry in this section<br><br></td></tr>";
		
	}
	else
	{
	
	echo "<tr><th> Sr. No. </th>
	<th> BOOK NAME </th>
				  <th>Available Copies</th>
			
			</tr>";
	while($row1 = mysql_fetch_assoc($extract))
	{
			$count=$count+1;
			$book_name=$row1['book_name'];
			$no_copies=$row1['no_copies'];
			$book_no=$row1['book_no'];
		
			echo "<tr>
					<td><center>$count</center></td>
					<td><center>". $book_name." (".$book_no.")</center></td>
				  <td><center>$no_copies</center></td>
			
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