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
function copies(str)
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
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("no_books").innerHTML=xmlhttp.responseText;
    }
  }  
xmlhttp.open("GET","no_books.php?q="+str,true);
xmlhttp.send();
}

</script>


<script>
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
<script type="text/javascript" language="javascript">
<!--
<!--
// By Adam Khoury @ www.developphp.com
function validateMyForm ( ) { 
    var isValid = true; 
	if ( document.form.design.value == "SELECT" ) { 
	    alert ( "SELECT DESIGNATION" ); 
	    isValid = false;
    } 
	 
	else if ( document.form.student_id.value == "") { 
	    alert ( "Please type valid student id" ); 
	    isValid = false;
    } 
	 
	else if ( isNaN(document.form.no_copies.value) || document.form.no_copies.value=="" || document.form.no_copies.value==0 ) { 
            alert ( "Enter valid number of copies" ); 
            isValid = false;
    } 
	
	else if ( document.form.accession_no1.value.length !=5 || isNaN(document.form.accession_no1.value) ) { 
            alert ( "Enter valid accession number" ); 
            isValid = false;
    } 
	
	else if ( document.form.accession_no2.value.length !=5 || isNaN(document.form.accession_no2.value) ) { 
            alert ( "Enter valid accession number" ); 
            isValid = false;
    } 
	
	else if ( document.form.accession_no3.value.length !=5 || isNaN(document.form.accession_no3.value) ) { 
            alert ( "Enter valid accession number" ); 
            isValid = false;
    } 
	
	else if ( document.form.accession_no.value4.length !=5 || isNaN(document.form.accession_no4.value) ) { 
            alert ( "Enter valid accession number" ); 
            isValid = false;
    } 
		
	else if ( document.form.accession_no.value5.length !=5 || isNaN(document.form.accession_no5.value) ) { 
            alert ( "Enter valid accession number" ); 
            isValid = false;
    } 
	return isValid;
}


function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

</head>


<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>

<form action="issuebook.php"  method="post" enctype="multipart/form-data" name="form" onsubmit="javascript:return validateMyForm();">
  <h2>Issue Books</h2>
  <br>
  <h4>Fill in the form completely to avoid errors.</h4>
  <h4>*Required</h4>
  <br>
  <table>
	<tr>
      <td>DESIGNATION</td>
	  <td>
      	<select name="design" onchange="loadformdoc(this.value)">
	  		<option>SELECT</option>
			<option >FACULTY</option>
        	<option >STUDENT</option>
      	</select>
      </td>
	</tr>
	
	<div id="display" style="width:65%; float:right;"></div>
	
    <tr>
      	<td>No. of Books </td>
	  	<td>
	      	<select name="no_books" id="menu" onchange="copies(this.value)">
			  	<option>0</option>
		        <option>1</option>
		        <option>2</option>
		        <option>3</option>
		        <option>4</option>
		        <option>5</option>
	      	</select>
	   	</td>
	</tr>

	<div id="no_books" style="width:65%; float:right;">	</div>

	<tr>
		<td>
			<input class="button-style" type="submit" value="Submit" name="submit_form"/>
		</td>
	</tr>
	
</table>
</form>

</body>
</html>

<?php
drawFooter();
?>
