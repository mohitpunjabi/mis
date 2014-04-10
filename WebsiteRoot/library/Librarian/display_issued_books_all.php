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

<script type="text/javascript">
	function showAllFac()
		{
		var xmlhttp;
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
		    document.getElementById("allFac").innerHTML=xmlhttp.responseText;
		    }
		  }
		xmlhttp.open("GET","display_issued_books_all_faculty.php?q=''",true);
		xmlhttp.send();
		}

		function search_fac(str)
		{
		var xmlhttp;
		if (str.length==0)
		  { 
		  document.getElementById("sayt").innerHTML="";
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
		    document.getElementById("sayt").innerHTML=xmlhttp.responseText;
		    }
		  }
		xmlhttp.open("GET","display_issued_books_all_sayt.php?q="+str,true);
		xmlhttp.send();
		}
		
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

<center>
	<table>
		<tr>
			<td>
				<input type="text" size="50" onkeyup="search_fac(this.value)" placeholder="Search By Faculty Here ...">
			</td>
			<td>
				<input type="button" value="Show All" onclick="showAllFac()" />
			</td>
		</tr>
	</table>
</center>

<div id="sayt" style="padding:35px;"></div>

<div id="allFac" style="padding:35px;"></div>


<?php
drawFooter();
?>