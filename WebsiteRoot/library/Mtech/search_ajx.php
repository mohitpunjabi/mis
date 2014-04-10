<table width=100%>
	<?php
	
 	require('connect.php'); 
	$count=0;
	$q=$_GET["q"];
 	
	
	
	
	
	$extract = mysql_query("SELECT * from cselib_books where book_name like '%$q%' or author_name like '%$q%' or book_publication like '%$q%' ") or die(mysql_error());
	
	if(mysql_num_rows($extract)==0 )
	{
		echo "<tr><td><h3>NO BOOK FOUND<br><br></h3></td></tr>";
	}
	else
	{

		
	echo "<span><h3>Search Results<br><br></h3></span>";			
	echo " 
  			<tr>
		    
			<th>Sr. No.</th>
    		<th>Book Name</th>
    		<th>Book No.</th>
   			<th>Author(s)</th>
   			<th>Publication</th>
			</tr>

 	";
	
	
	while($row=mysql_fetch_assoc($extract))
	{
		$count++;
		$book_no=$row['book_no'];
		$book_name=$row['book_name'];
		$author_name=$row['author_name'];
		$publication=$row['book_publication'];
		$no_copies=$row['no_copies'];
		
		if($no_copies==0)
			continue;
			$count=$count+1;

		echo " <tr>
   
				<td><center>$count</center></td>
   			 	<td><center>$book_name</td>
  			 	 <td><center>$book_no</td>
				 <td><center>$author_name</td>
  			 	 <td><center>$publication</td>
		
				 
				
   
  </tr> ";
	}
}
	?>
	</table>