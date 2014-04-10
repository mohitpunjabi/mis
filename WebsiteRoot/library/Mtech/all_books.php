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

<script type="text/javascript">
function search_as_you_type(str)
		{
		var xmlhttp;
		if (str.length==0)
		  { 
		  document.getElementById("ajx").innerHTML="";
		  return;
		  }
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }
		xmlhttp.onreadystatechange=function()
		  {
		  if(xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
		    document.getElementById("ajx").innerHTML=xmlhttp.responseText;
		    }
		  }
		xmlhttp.open("GET","search_ajx.php?q="+str,true);
		xmlhttp.send();
		}
	</script>

</head>

<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>
<p>&nbsp;&nbsp;</p>

<center>
<form method="post" action="search.php">
<input type="text" size=100 name="textfield" placeholder="Search For A Book Here ..." onkeyup="search_as_you_type(this.value)">
<input type="submit" name="Submit" value="Search" class="button-style"/>
</form>
</center>

<p>&nbsp;&nbsp;</p>
<div id="ajx" style="padding:30px;"></div>

<div id="content">
			
<table>


 <?php
 	$count=0;
	require("connect.php");
	$extract = mysql_query("SELECT book_name,author_name,no_copies FROM cselib_books") or die(mysql_error());
	if(mysql_num_rows($extract)==0)
	{
		echo "<tr><td width='800'>NO ENTRY IN THIS SECTION</td></tr>";
		
	}
	else
	{
	echo "<h3>Available Books:</h3><br><br>";

	echo "

 
  
  
  	<tr>
    
			<th width='100' valign='left' align='center' >Sr. no.</th>
    		<th width='400' valign='left' align='center' >Book Name</th>
    		<th width='400' valign='left' align='center' >Author(s)</th>
   			 <th width='100' valign='left' align='center' >No. Copies</th>
   
	</tr>

 	";
 
	
	
	while($row = mysql_fetch_assoc($extract))
	{
			$book_name=$row['book_name'];
			$author_name=$row['author_name'];
			$no_copies=$row['no_copies'];
			
			if($no_copies==0)
			continue;
			$count=$count+1;
			echo " <tr>
   
	<td><center>$count.</td>
    <td><center>$book_name</td>
    <td><center>$author_name</td>
    <td><center>$no_copies</td>
   
  </tr> ";
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