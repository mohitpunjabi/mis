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



<script type="text/javascript" language="javascript"> 
<!--
// By Adam Khoury @ www.developphp.com
function validateMyForm ( ) { 
    var isValid = true;
	 if ( document.form.student_id.value == "") { 
	    alert ( "Please type valid student id" ); 
	    isValid = false;
    } 
	
   else if ( document.form.student_name.value == "" ) { 
	    alert ( "Please type student Name" ); 
	    isValid = false;
    }
	
	 else if ( document.form.book_name.value == "" ) { 
	    alert ( "Please type student Name" ); 
	    isValid = false;
    }
	else if ( document.form.author.value == "" ) { 
	    alert ( "Please type author Name" ); 
	    isValid = false;
    }
	
	else if ( document.form.publication.value == "" ) { 
	    alert ( "Please type publication Name" ); 
	    isValid = false;
    } 
	
	else if ( isNaN(document.form.amount.value) || document.form.amount.value=="" ) { 
            alert ( "Enter valid Amount" ); 
            isValid = false;
    } 
	return isValid;
}</script>


<script type="text/javascript">
	function loadformdoc(str)
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
  if(str=="FACULTY")
  {
  
   xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("display").innerHTML=xmlhttp.responseText;
    }
  }  
xmlhttp.open("GET","issue_faculty.php?q="+str,true);
xmlhttp.send();
}
else if(str=='STUDENT')
{
	xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("display").innerHTML=xmlhttp.responseText;
    }
  }  
xmlhttp.open("GET","issue_student.php?q="+str,true);
xmlhttp.send();
}
}

</script>


</head>


<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>


<center><h4>*Required</h4></center>

<form name="form" action="adddonatedbook.php" onsubmit="javascript:return validateMyForm();"  method="post">
  <center>
  <h2>Add Book</h2>
  <h4>Fill in the form completely to avoid errors.</h4>
  <br>
  </center>

   	<center>
	  	<table>
		<tr>
	      <td width="200px">*DESIGNATION</td>
		  <td width="269px">
		  <center>
	      	<select name="design" onchange="loadformdoc(this.value)">
		  		<option>SELECT</option>
				<option >FACULTY</option>
	        	<option >STUDENT</option>
	      	</select>
	      </center>
	      </td>
		</tr>
		</table>
		<div id="display"></div>
  	</center>

  	<center>
	    <table>
	    <tr>
	      <td><label for="author">*Book Name</label></td>
	      <td><input type="text" id="book_name" name="book_name"/></td>
	    </tr>
		<tr>
	      <td><label for="book_no.">*Publication</label></td>
	      <td><input type="text" id="publication" name="publication"/></td>
	    </tr>
	    <tr>
	      <td><label for="book_name">*Author</label></td>
	      <td><input type="text" id="author" name="author" /></td>
	    </tr>
		<tr>
	      <td><label for="book_name">*Amount</label></td>
	      <td><input type="text" id="amount" name="amount" /></td>
	      <td>
	      	<select name="currency">
	      		<option>Rupees</option>
	      		<option>Dollor</option>
	      		<option>Pound</option>
	      		<option>Euro</option>
	      	</select>
	      </td>
	    </tr>
	    <tr>
	      <td><label for="author">*Date</label></td>
	      <td><input type="date" size="12" id="date" name="date"/></td>
	    </tr>
	  </table>
	  <br>
	  <input type="submit" value="Submit" name="submit_form"/>
  </center>
</form>

<?php
drawFooter();
?>