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
<title>Untitled </title>
</head>

<script type="text/javascript" language="javascript"> 
<!--
// By Adam Khoury @ www.developphp.com
function validateMyForm ( ) { 
    var isValid = true;
	if ( document.form.book_name.value == "" ) { 
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
	else if ( document.form.edition.value == "" ) { 
	    alert ( "Please type Edtion" ); 
	    isValid = false;
    } 
	else if(document.form.source.value=="")
	{ 
	    alert ( "Please check the source" ); 
	    isValid = false;
    } 
	 else if ( isNaN(document.form.no_copies.value) || document.form.no_copies.value=="" || document.form.no_copies.value==0 ) { 
            alert ( "Enter valid number of copies" ); 
            isValid = false;
    } 
	else if ( isNaN(document.form.price.value) || document.form.price.value=="" || document.form.no_copies.value==0 ) { 
            alert ( "Enter valid price" ); 
            isValid = false;
    } 
	
	
	return isValid;
}</script>
<h1 class="page-head">Computer Science & Engineering</h1>
<h2>Department Library</h2>

<table width=100%>
	<div id="content">
	<div class="formarea">
	<div class="requiredfld"><span class="required"></span><h3>*Required</h3><br><br></div>

	<form name='form' action='requestintermediate.php?q' onsubmit='javascript:return validateMyForm();'  method='post'>
  	<h2>Book Requisition Form<br><br></h2>
  	<div class="subfieldsset">
  
  	<div class="information"><h4>Fill in the form completely to avoid errors.</h4><br><br></div>
	<tr>
		<div>
			<td><label for="book_name"><span class="required">*</span> Book Name</label></td>
			<td><input type="text" size="50" id="book_name" name="book_name"/></td>
		</div>
	</tr>
	<tr>
    <div>
		<td><label for="author"><span class="required">*</span>Author</label></td>
		<td><input type="text" size="50" class="required" id="author" name="author"/></td>
    </div>
	</tr>
	<tr>
	<div>
      <td><label for="publication"><span class="required">*</span>Publication</label></td>
      <td><input type="text" size="50" id="publication" name="publication"/></td>
    </div>
	</tr>
	
	<tr>
    <div>
      <td><label for="edition"><span class="required">*</span> Edition</label></td>
      <td><input type="text" size="50" id="edition" name="edition"/></td>
    </div>
	</tr>
	
	<tr>
	<div>
      <td><label for="source"><span class="required">*</span> Source of Selection</label></td>
      <td><div style="float:right; width:70%;">
      <input type="radio" name="source" value="publisher catalog" />
      Publisher's Catalog
      <input type="radio" name="source" value="internet" />
      Internet
      <input type="radio" name="source" value="others" />
      Others</div>
	</div></td>
	</tr>
   
   
	<div id="accession" style="width:65%; float:right;">	</div>
	
	
   
   <tr>
   <div>
       <td><label for="no_copies"><span class="required">*</span>No.of Copies </label></td>
       <td><input type="text" size="12" id="no_copies" name="no_copies"/></td>
    </div>
	</tr>
	
	
	<tr>
	<div>
       <td><label for="unit_price"><span class="required">*</span>Unit Price</label></td>
	   <td><input type="text" size="12" id="price" name="price"/>
	   <select name="currency" id="menu">
	  	<option>Rs</option>
        <option>US Dollars</option>
        <option>Euro</option>
        <option>Pound</option>
        
		  </select></td>
	</div>
	</tr>

	<br>
 </div>

</table>
<br>
<br>
<center><input class="button-style" type="submit" value="Submit" name="submit_form"/></center>
	
  
</form>

</body>
</html>

<?php
drawFooter();
?>