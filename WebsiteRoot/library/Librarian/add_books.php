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
  xmlhttp.onreadystatechange=function()
    {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
      document.getElementById("accession").innerHTML=xmlhttp.responseText;
      }
    }
  xmlhttp.open("GET","accession.php?q="+str,true);
  xmlhttp.send();
  }
</script>


<script type="text/javascript" language="javascript"> 
<!--
// By Adam Khoury @ www.developphp.com
function validateMyForm ( ) { 
    var isValid = true;
	 if ( document.form.book_no.value == "" ) { 
	    alert ( "Please type valid book number" ); 
	    isValid = false;
    } 
	else if ( document.form.class_no.value=="" ) { 
            alert ( "Enter valid class number" ); 
            isValid = false;
    }
	
   else if ( document.form.book_name.value == "" ) { 
	    alert ( "Please type book Name" ); 
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
	
	 else if ( document.form.accession_no1.value.length !=5 || isNaN(document.form.accession_no1.value) ) { 
            alert ( "Enter valid accession number" ); 
            isValid = false;
    } 
	
	 else if ( document.form.accession_no2.value.length !=5 || isNaN(document.form.accession_no2.value) ) { 
            alert ( "Enter valid accession number" ); 
            isValid = false;
    } 
	 else if ( document.form.accession_no.value3.length !=5 || isNaN(document.form.accession_no3.value) ) { 
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
		 else if ( isNaN(document.form.no_copies.value) || document.form.no_copies.value=="" || document.form.no_copies.value==0 ) { 
            alert ( "Enter valid number of copies" ); 
            isValid = false;
    } 
	return isValid;
}</script>

<script type="text/javascript">

    function otherCategory(str)
    {
    var xmlhttp;
    if (str!="Other")
      { 
      document.getElementById("otherCat").innerHTML="";
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
    if(str=="Other")
      {
      xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
        document.getElementById("otherCat").innerHTML=xmlhttp.responseText;
        }
      }
    xmlhttp.open("GET","other_category.php?q=''",true);
    xmlhttp.send();
    }
    }

</script>

</head>


<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>

	<form name="form" action="addbooks.php" onsubmit="javascript:return validateMyForm();"  method="post">
  	<h2>Add Book</h2>
  	<h4>Fill in the form completely to avoid errors.</h4>
    <h4>The fields marked  ' <font color="red" size="4">*</font> '  must be necessarily filled.</h4>

    <table>
     <center>
      <tr>
      <td><label for="book_no"><font color="red" size="4">*</font>Book No.</label></td>
      <td><input type="text" id="book_no" name="book_no"/></td>
      </tr>

      <tr>	
      <td><label for="book_name"><font color="red" size="4">*</font>Class No.</label></td>
      <td><input type="text" id="class_no" name="class_no"/></td>
      </tr>
	
      <tr>
      <td><label for="book_name"><font color="red" size="4">*</font>Book Name</label></td>
      <td><input type="text" id="book_name" name="book_name"/></td>
      </tr>
    
      <tr>
      <td><label for="author"><font color="red" size="4">*</font>Author</label></td>
      <td><input type="text" id="author" name="author"/></td>
      </tr>  
    
	    <tr> 
      <td><label for="book_no."><font color="red" size="4">*</font>Publication</label></td>
      <td><input type="text" id="publication" name="publication"/></td>
      </tr>
    
      <tr>
      <td><label for="no_books"><font color="red" size="4">*</font>No. of Copies </label></td>
      <td><select name="no_copies" id="menu" onchange="loadformdoc(this.value)">
	     	<option>0</option>
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
		    <option>6</option>
        <option>7</option>
        <option>8</option>
        <option>9</option>
        <option>10</option>
      </select></td>
	    </tr> 

   
      <tr>
      <td><label for="author"><font color="red" size="4">*</font>Date of Arrival</label></td>
      <td><input type="date" size="12" id="date_arrival" name="date_arrival"/></td>
      </tr>

	<div id="accession" style="width:50%; float:right; padding:55px;"></div>
	

  <?php
  require("connect.php");
  $select=mysql_query("SELECT category from cselib_categories_books") or die(mysql_error());
  echo"   
          <tr>
          <td><label for='author'><font color='red' size='4'>*</font>Category</label></td>
          <td><label>
          <select name='category' onchange='otherCategory(this.value)' >
          <option>Select</option>
      ";
    
  while($row=mysql_fetch_assoc($select))
  {
    $cat=$row['category'];
    echo "   
      <option>$cat</option>";       
  }


   echo " <option>Other</option>
          </select>
          </label></td>
          </tr>
        ";
?>

<div id="otherCat" style="width:50%; float:right; padding:55px;"></div>

	<br>
	
   
    <tr>
    <td><input type="submit" value="Submit" name="submit_form"></td>
    </tr>
  <br />
  <br>

  </table>
</form>

</body>
</html>

<?php
drawFooter();
?>