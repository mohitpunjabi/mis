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
  var divToPrint=document.getElementById("book_table");
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
 	require('connect.php'); 
 	$count=0;
 	$link=$_GET['link'];
	echo "<span class='style4'><h3>$link:</h3></span><br><br>";
	
	
	
	$extract = mysql_query("SELECT book_no,book_name,no_copies from cselib_books where category='$link'") or die(mysql_error());
	
	if(mysql_num_rows($extract)==0 )
	{
		echo "<tr><td width='800'><h3>NO ENTRY IN THIS SECTION</h3></td></tr>";
		
	}
	else
	{
	
	echo "<tr><th width='100' valign='left' align='center' > Sr. no. </th>
	<th width='900' valign='left' align='center' > BOOK NAME </th>
	<th width='125' valign='left' align='center' > AVAILABLE COPIES </th>
			
			</tr>";
	while($row1 = mysql_fetch_assoc($extract))
	{
			$count=$count+1;
			$book_name=$row1['book_name'];
			$no_copies=$row1['no_copies'];
			$book_no=$row1['book_no'];
		
			echo "<tr>
					<td><center>$count</center></td>
					<td><center> ". $book_name." (".$book_no.")</td>
				  <td><center> $no_copies</center></td>
			
			</tr>";
					
			
	}
	}
	?>

</table>
</div>
</div>
</body>
</html>

<?php
drawFooter();
?>