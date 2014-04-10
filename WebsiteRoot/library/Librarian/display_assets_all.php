<div id="content">
			
<table align="center">


 <?php
 	$count=0;
	require("connect.php");
	$extract = mysql_query("SELECT sum(no_copies) as sumcopies from cselib_categories_books") or die(mysql_error());
	if(mysql_num_rows($extract)==0)
	{
		echo "<tr><td width='800'>No entry in this Section</td></tr>";
		
	}
	else
	{
	while($row = mysql_fetch_assoc($extract))
	{
			$total_assets=$row['sumcopies'];			
			echo "
			
			<h3><center>Total assets of the library [No. of books]  = $total_assets</center></h3><br><br>";		
	}
	
	
	echo "
			<tr>
				<th width=70>Sr. No.</th>
	    		<th width=350>Category</th>
	  		</tr>";

		
	$extract1 = mysql_query("SELECT category,no_copies from cselib_categories_books group by category ") or die(mysql_error());
	
	
	while($row1 = mysql_fetch_assoc($extract1))
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

<center>
	<input class="button-style" type="button" value="PRINT" onclick="printDiv()"/>
</center>