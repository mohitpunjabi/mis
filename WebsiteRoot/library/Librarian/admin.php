<?php
	require_once("../../Includes/Auth.php");
	auth();
	require_once("../../Includes/Layout.php");

	drawHeader("Account Functions");
?>

<?php

@session_start();
//$emp_id=$_REQUEST['emp_id'];
$emp_id="0230";
$_SESSION['emp_id']=$emp_id;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>


<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>
<p>&nbsp;&nbsp;</p>

<center>
	<form method="post" action="search.php">
	<input type="text" size=100 name="textfield" placeholder="Search For A Book Here ..." onkeyup="search_as_you_type(this.value)">
	<input type="submit" value="Search" />
	</form>
</center>

<p>&nbsp;&nbsp;</p>

<div id="ajx" style="padding:30px;"></div>

</body>
</html>

<?php
drawFooter();
?>