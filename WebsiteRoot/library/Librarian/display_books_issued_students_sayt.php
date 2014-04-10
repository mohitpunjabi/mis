<div id="content">

<table>


 <?php
 	$q=$_GET["q"];
 	$count=0;
	require("connect.php");
	$extract = mysql_query("SELECT * FROM cselib_issued_book_student where student_name like '%$q%' order by student_name");
	if(mysql_num_rows($extract)==0)
	{
		echo "<tr><td >No Books issued to Students</td></tr>";
		
	}
	else
	{
	
	echo "<h3>Books Issued to <b>Students</b> : </h3><br><br>";

	echo "

		 	<tr>
		    
					<th width=240>Sr. No.</th>
					<th width=240>Student Id</th>
		    		<th width=240>Student Name</th>
		    		<th width=240>Book Name</th>
		   			<th width=240>Accession No.</th>
		   
			</tr>

 	";
 
	
	
	while($row = mysql_fetch_assoc($extract))
	{
			$student_id=$row['student_id'];
			$student_name=$row['student_name'];
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
					<td><center>$student_id</center></td>
		  			<td><center>$student_name</center></td>
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