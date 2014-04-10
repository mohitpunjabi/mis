<table align="center">
	<?php
	
 	
 	$q=$_GET["q"];
	$count=0;
 	require('connect.php'); 
	
	
	
	
	$extract = mysql_query("SELECT * from cselib_books where book_name like '%$q%' or author_name like '%$q%' or book_publication like '%$q%' ") or die(mysql_error());
	
	if(mysql_num_rows($extract)==0 )
	{
		echo "<tr><td><center>No Book Found</center></td></tr>";
	}
	else
{

		
	echo "<h3>Search Results : </h3><br><br>";			
	echo " 
  			<tr>
		    
			<th width=200>Sr No.</td>
    		<th width=200>Book Name</th>
    		<th width=200>Book No.</th>
   			<th width=200>Author</th>
   			<th width=200>Publication</th>
			</tr>

 	";
	
	
	while($row=mysql_fetch_assoc($extract))
	{
		$count++;
		$book_no=$row['book_no'];
		$book_name=$row['book_name'];
		$author_name=$row['author_name'];
		$publication=$row['book_publication'];
		
		echo " 	<tr>
   
				<td><center>$count</center></td>
   			 	<td><center>$book_name</center></td>
  			 	<td><center>$book_no</center></td>
				<td><center>$author_name</center></td>
  			 	<td><center>$publication</center></td>
				 </tr> ";
	}
}
	?>
	</table>