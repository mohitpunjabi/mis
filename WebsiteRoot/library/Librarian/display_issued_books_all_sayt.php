<div id="content">

<table align="center">


 <?php
 	$q=$_GET["q"];
 	$count=0;
	require("connect.php");
	$extract = mysql_query("SELECT * FROM cselib_issued_book_faculty where emp_name like '%$q%' order by emp_name");
	if(mysql_num_rows($extract)==0)
	{
		echo "<tr><td>No Books issued to Faculty</td></tr>";
		
	}
	else
	{
	
	echo "<h3>Books Issued to <b>Faculty</b> : <h3><br><br>";

	echo "

 	<tr>
    
			<th width=250>Sr. No.</th>
    		<th width=250>Faculty Name</th>
    		<th width=250>Book Name</th>
   			<th width=250>Accession No.</th>
   
	</tr>

 	";
 
	
	
	while($row = mysql_fetch_assoc($extract))
	{
			$emp_id=$row['emp_id'];
			$emp_name=$row['emp_name'];
			$book_no=$row['book_no'];
			$class_no=$row['class_no'];
			$accession_no=$row['accession_no'];
			
			//$select=mysql_query("Select emp_name from faculty_data where emp_id="$emp_id"");
			
			$select1=mysql_query("SELECT book_name from cselib_books where book_no='$book_no' and call_no='$class_no'");
			$row=mysql_fetch_assoc($select1);
			$book_name=$row['book_name'];			
			$count=$count+1;
		echo  "
		 		 <tr>
		  		  
					<td><center>$count</center></td>
		  			<td><center>$emp_name</center></td>
		   			<td><center>$book_name</center></td>
		   			<td><center>$accession_no</center></td>
		   
				</tr>";
		}
	
	}
	?>

</table>

</div>

<br>
<br>

<center>
	<input class="button-style" type="button" value="PRINT" onclick="printDiv()"/>
</center>