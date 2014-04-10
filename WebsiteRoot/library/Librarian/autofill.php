<?php
 require("connect.php");

$qry=mysql_query("SELECT author,publication from cselib_request_details where book_name = '".$_GET['q']."'  ");
$row=mysql_fetch_row($qry);

	if(mysql_num_rows($qry)==1)
		echo '<tr>
      <td><label for="author">*Author</label></td>
      <td><input type="text" id="author" name="author" value="'.$row[0].'" /></td>
      </tr>  
    
	    <tr> 
      <td><label for="book_no.">*Publication</label></td>
      <td><input type="text" id="publication" name="publication" value="'.$row[1].'" /></td>
      </tr>';
     else
     {
     	echo '<tr>
      <td><label for="author">*Author</label></td>
      <td><input type="text" id="author" name="author"/></td>
      </tr>  
    
	    <tr> 
      <td><label for="book_no.">*Publication</label></td>
      <td><input type="text" id="publication" name="publication"/></td>
      </tr>';
     }

 ?>