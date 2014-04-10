<div id="content">
			
<table align="center">


 <?php
 	$count=0;
 	$q=$_GET["q"];
	require("connect.php");
	echo "
			<tr>
				<th width=70>Sr. No.</th>
	    		<th width=350>Category</th>
	  		</tr>";

		
	$extract = mysql_query("SELECT category,no_copies from cselib_categories_books where category like '%$q%' group by category ") or die(mysql_error());
	if(mysql_num_rows($extract)==0)
	{
		echo "<tr><td width='800'>No entry in this Section</td></tr>";
		
	}
	else
	{
		while($row1 = mysql_fetch_assoc($extract))
		{
				$count=$count+1;
				$sumcopies=$row1['no_copies'];
				$categories=$row1['category'];
				echo "	<tr>
								<td><center>$count.</center></td>
								<td><center><a href='display_categories.php?link=".$categories." '> ".$categories."</a>&emsp;(".$sumcopies.")</center></td>
						<tr>";		
				
		}
	}
	?>

</table>
</div>