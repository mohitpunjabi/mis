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
	
	function showHint(str)
		{
		var xmlhttp;
		if (str.length==0)
		  { 
		  document.getElementById("txtHint").innerHTML="";
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
		    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		    }
		  }
		xmlhttp.open("GET","display_approved_request_sayt.php?q="+str,true);
		xmlhttp.send();
		}

	function showAll()
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
		    document.getElementById("showAllreq").innerHTML=xmlhttp.responseText;
		    }
		  }
		xmlhttp.open("GET","display_approved_request_all.php?q=''",true);
		xmlhttp.send();
		}

</script>

</head>

<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>


<center>
	<table>
		<tr>
			<td>
				<input type="text" size="50" onkeyup="showHint(this.value)" placeholder="Search By Faculty Here ...">
			</td>
			<td>
				<input type="button" value="Show All" onclick="showAll()" />
			</td>
		</tr>
	</table>
</center>

<div id="txtHint" style="padding:40px;" ></div>
<div id="showAllreq" style="padding:40px;" ></div>

<?php
drawFooter();
?>