<div id="content">
			
<table>


 <?php
 	$q=$_GET["q"];
 	$count=0;
	require("connect.php");
	$extract = mysql_query("SELECT student_id,book_name,student_name,date_donate FROM cselib_donated_book_student where student_name like '%$q%' order by date_donate") or die(mysql_error());
	if(mysql_num_rows($extract)==0)
	{
		echo "<tr><td>No enteries in this Section</td></tr>";
		
	}
	else
	{
	echo "<h3>Donated Books : </h3><br><br>";
	
	  

	echo "

		 	<tr>
		    
					<th width=200>Sr. No.</th>
					<th width=200>Date </th>
		    		<th width=200>Student Id </th>
		    		<th width=200>Student Name </th>
		   			<th width=200>Book Name</th>
		   
			</tr>

 	";
 
	
	
	while($row = mysql_fetch_assoc($extract))
	{
			$book_name=$row['book_name'];
			$student_name=$row['student_name'];
			$student_id=$row['student_id'];
			$date_donate=$row['date_donate'];
					
						$count=$count+1;
			echo " <tr>
   
						<td><center>$count.</center></td>
						<td><center>$date_donate</center></td>
						<td><center>$student_id</center></td>
					   	<td><center>$student_name</center></td>
						<td><center>$book_name</center></td>
    
   
  					</tr> ";
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